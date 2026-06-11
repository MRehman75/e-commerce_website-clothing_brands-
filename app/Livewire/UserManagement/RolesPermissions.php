<?php
namespace App\Livewire\UserManagement;
use Livewire\Component;
use App\Models\Role;
use App\Models\Permission;

class RolesPermissions extends Component
{
    public $showRoleModal = false;
    public $showPermModal = false;
    public $editingRoleId = null;
    public $confirmingDeleteId = null;

    public $roleName = '';
    public $roleSlug = '';
    public $roleDescription = '';
    public $selectedPermissions = [];

    public $permName = '';
    public $permSlug = '';
    public $permModule = '';
    public $permDescription = '';

    public function getRolesProperty()
    {
        return Role::withCount('permissions')->with('permissions')->get();
    }

    public function getPermissionsProperty()
    {
        return Permission::orderBy('module')->get()->groupBy('module');
    }

    public function openCreateRole()
    {
        $this->reset(['roleName', 'roleSlug', 'roleDescription', 'selectedPermissions', 'editingRoleId']);
        $this->showRoleModal = true;
    }

    public function openEditRole($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        $this->editingRoleId       = $id;
        $this->roleName            = $role->name;
        $this->roleSlug            = $role->slug;
        $this->roleDescription     = $role->description;
        $this->selectedPermissions = $role->permissions->pluck('id')->toArray();
        $this->showRoleModal       = true;
    }

    public function saveRole()
    {
        $this->validate([
            'roleName' => 'required|string|max:255',
            'roleSlug' => 'required|string|max:255',
        ]);

        if ($this->editingRoleId) {
            $role = Role::findOrFail($this->editingRoleId);
            $role->update([
                'name'        => $this->roleName,
                'slug'        => $this->roleSlug,
                'description' => $this->roleDescription,
            ]);
        } else {
            $role = Role::create([
                'name'        => $this->roleName,
                'slug'        => $this->roleSlug,
                'description' => $this->roleDescription,
            ]);
        }

        $role->permissions()->sync($this->selectedPermissions);
        $this->showRoleModal = false;
        session()->flash('success', 'Role saved!');
    }

    public function confirmDelete($id)
    {
        $this->confirmingDeleteId = $id;
    }

    public function deleteRole()
    {
        Role::findOrFail($this->confirmingDeleteId)->delete();
        $this->confirmingDeleteId = null;
        session()->flash('success', 'Role deleted!');
    }

    public function openCreatePerm()
    {
        $this->reset(['permName', 'permSlug', 'permModule', 'permDescription']);
        $this->showPermModal = true;
    }

    public function savePerm()
    {
        $this->validate([
            'permName'   => 'required|string|max:255',
            'permSlug'   => 'required|string|max:255|unique:permissions,slug',
            'permModule' => 'required|string|max:255',
        ]);

        Permission::create([
            'name'        => $this->permName,
            'slug'        => $this->permSlug,
            'module'      => $this->permModule,
            'description' => $this->permDescription,
        ]);

        $this->showPermModal = false;
        session()->flash('success', 'Permission added!');
    }

    public function render()
    {
        return view('livewire.user-management.roles-permissions', [
            'roles'       => $this->roles,
            'permissions' => $this->permissions,
        ])->layout('layouts.admin');
    }
}