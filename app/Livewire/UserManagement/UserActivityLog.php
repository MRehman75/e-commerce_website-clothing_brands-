<?php
namespace App\Livewire\UserManagement;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\ActivityLog;
use App\Models\User;

#[Layout('layouts.admin')]
class UserActivityLog extends Component
{
    use WithPagination;

    public $search = '';
    public $filterUser = '';
    public $filterAction = '';
    public $perPage = 20;

    public function render()
    {
        $query = ActivityLog::with('user')
            ->when($this->search, fn($q) => $q->where('description', 'like', "%{$this->search}%"))
            ->when($this->filterUser, fn($q) => $q->where('user_id', $this->filterUser))
            ->when($this->filterAction, fn($q) => $q->where('action', $this->filterAction))
            ->latest();

        return view('livewire.user-management.user-activity-log', [
            'logs' => $query->paginate($this->perPage),
            'users' => User::orderBy('name')->get(),
            'actions' => ActivityLog::distinct()->pluck('action'),
        ]);
    }

    public function clearLogs()
    {
        ActivityLog::truncate();
        session()->flash('success', 'All logs cleared!');
    }
}