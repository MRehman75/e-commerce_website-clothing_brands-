<?php

namespace App\Livewire\UserManagement;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Spatie\Activitylog\Models\Activity;
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
        $query = Activity::with('causer')
            ->when($this->search, fn($q) => $q->where('description', 'like', "%{$this->search}%"))
            ->when($this->filterUser, fn($q) => $q->where('causer_id', $this->filterUser))
            ->when($this->filterAction, fn($q) => $q->where('event', $this->filterAction))
            ->latest();

        return view('livewire.user-management.user-activity-log', [
            'logs' => $query->paginate($this->perPage),
            'users' => User::orderBy('name')->get(),
            'actions' => Activity::distinct()->pluck('event'),
        ]);
    }

    public function clearLogs()
    {
        Activity::truncate();
        session()->flash('success', 'All logs cleared!');
    }
}