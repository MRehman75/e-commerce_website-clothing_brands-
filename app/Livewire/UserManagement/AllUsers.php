<?php
namespace App\Livewire\UserManagement;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Role;

class AllUsers extends Component
{
    use WithPagination;

    public $search = '';
    public $filterRole = '';
    public $sortBy = 'created_at';
    public $sortDir = 'desc';
    public $perPage = 10;

    public $showModal = false;
    public $editingId = null;
    public $confirmingDeleteId = null;

    public $name = '';
    public $email = '';
    public $password = '';
    public $role_id = '';

    protected $paginationTheme = 'bootstrap';

    public function getStatsProperty()
    {
        return [
            'total'  => User::count(),
            'admins' => User::whereHas('roles', fn($q) => $q->where('slug', 'admin'))->count(),
            'recent' => User::whereDate('created_at', '>=', now()->subDays(7))->count(),
        ];
    }

    public function getUsersProperty()
    {
        return User::query()
            ->when($this->search, fn($q) =>
                $q->where('name', 'like', '%'.$this->search.'%')
                  ->orWhere('email', 'like', '%'.$this->search.'%')
            )
            ->when($this->filterRole, fn($q) =>
                $q->whereHas('roles', fn($q) => $q->where('id', $this->filterRole))
            )
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);
    }

    public function getRolesProperty()
    {
        return Role::orderBy('name')->get();
    }

    public function openCreate()
    {
        $this->reset(['name', 'email', 'password', 'role_id', 'editingId']);
        $this->showModal = true;
    }

    public function openEdit($id)
    {
        $user = User::findOrFail($id);
        $this->editingId = $id;
        $this->name      = $user->name;
        $this->email     = $user->email;
        $this->role_id   = $user->roles->first()?->id ?? '';
        $this->showModal = true;
    }

    public function save()
    {
        $rules = [
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . ($this->editingId ?? 'NULL'),
        ];

        if (!$this->editingId) {
            $rules['password'] = 'required|min:8';
        }

        $this->validate($rules);

        if ($this->editingId) {
            $user = User::findOrFail($this->editingId);
            $user->update(['name' => $this->name, 'email' => $this->email]);
        } else {
            $user = User::create([
                'name'     => $this->name,
                'email'    => $this->email,
                'password' => bcrypt($this->password),
            ]);
        }

        if ($this->role_id) {
            $user->roles()->sync([$this->role_id]);
        }

        $this->showModal = false;
        session()->flash('success', 'User saved successfully!');
    }

    public function confirmDelete($id)
    {
        $this->confirmingDeleteId = $id;
    }

    public function delete()
    {
        User::findOrFail($this->confirmingDeleteId)->delete();
        $this->confirmingDeleteId = null;
        session()->flash('success', 'User deleted!');
    }

   public function render()
    {
        return view('livewire.user-management.all-users', [
            'users'  => $this->users,
            'stats'  => $this->stats,
            'roles'  => $this->roles,
        ])->layout('layouts.admin');
    }
}