<div>
    {{-- Header --}}
    <div class="card border-0 text-white p-3 mb-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-0 text-white"><i class="fas fa-history me-2"></i>User Activity Log</h4>
                <small class="text-white-50">Track all user activities</small>
            </div>
            <button wire:click="clearLogs" class="btn btn-danger btn-sm"
                    onclick="return confirm('Clear all logs?')">
                <i class="fas fa-trash me-1"></i> Clear All
            </button>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    {{-- Filters --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <input wire:model.live="search" type="text"
                           class="form-control" placeholder="Search description...">
                </div>
                <div class="col-md-3">
                    <select wire:model.live="filterUser" class="form-select">
                        <option value="">All Users</option>
                        @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select wire:model.live="filterAction" class="form-select">
                        <option value="">All Actions</option>
                        @foreach($actions as $action)
                        <option value="{{ $action }}">{{ ucfirst($action) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select wire:model.live="perPage" class="form-select">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="font-size:0.82rem;">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Action</th>
                            <th>Description</th>
                            <th>IP Address</th>
                            <th>Date & Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                        <tr>
                            <td>{{ $log->id }}</td>
                            <td>
                                @if($log->causer)
<strong>{{ $log->causer->name }}</strong><br>
<small class="text-muted">{{ explode(' ', $log->causer->email)[0] }}</small>
<!-- <small class="text-muted">{{ $log->causer->email }}</small> -->
@else
<span class="text-muted">System</span>
@endif
                               <!--  @if($log->user)
                                <strong>{{ $log->user->name }}</strong><br>
                                <small class="text-muted">{{ $log->user->email }}</small>
                                @else
                                <span class="text-muted">System</span>
                                @endif -->
                            </td>
                            <td>
                                <span class="badge bg-{{
                                    $log->action == 'create' ? 'success' :
                                    ($log->action == 'update' ? 'warning' :
                                    ($log->action == 'delete' ? 'danger' : 'info'))
                                }}">
                                    {{ ucfirst($log->action) }}
                                </span>
                            </td>
                            <td>{{ str_replace('System --> ', '', $log->description) }}</td>
                            <!-- <td>{{ $log->description }}</td> -->
                            <td><small>{{ $log->ip_address ?? 'N/A' }}</small></td>
                            <td><small>{{ $log->created_at->format('d M Y H:i') }}</small></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fas fa-history fa-2x mb-2 d-block"></i>
                                No activity logs found!
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($logs->hasPages())
        <div class="card-footer">
            {{ $logs->links() }}
        </div>
        @endif
    </div>
</div>