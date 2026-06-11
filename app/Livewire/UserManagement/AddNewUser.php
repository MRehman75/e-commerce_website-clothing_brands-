<?php
namespace App\Livewire\UserManagement;
use Livewire\Component;
use App\Models\User;
use App\Models\Role;

class AddNewUser extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $role_id = '';
    public $success = false;

    protected function rules()
    {
        return [
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
            'role_id'               => 'nullable|exists:roles,id',
        ];
    }

    public function save()
    {
        $this->validate();

        $user = User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => bcrypt($this->password),
        ]);

        if ($this->role_id) {
            $user->roles()->sync([$this->role_id]);
        }

        $this->reset(['name', 'email', 'password', 'password_confirmation', 'role_id']);
        $this->success = true;
    }

    public function getRolesProperty()
    {
        return Role::orderBy('name')->get();
    }

    public function render()
    {
        return view('livewire.user-management.add-new-user', [
            'roles' => $this->roles,
        ])->layout('layouts.admin');
    }
}