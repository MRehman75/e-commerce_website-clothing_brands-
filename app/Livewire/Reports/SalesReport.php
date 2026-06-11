<?php
namespace App\Livewire\Reports;
use Livewire\Component;
use App\Models\Order;
use Carbon\Carbon;

class SalesReport extends Component
{
    public $dateFrom = '';
    public $dateTo = '';
    public $period = 'monthly';

    public function mount()
    {
        $this->dateFrom = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->dateTo   = Carbon::now()->format('Y-m-d');
    }

    public function getStatsProperty()
    {
        $query = Order::query()
            ->when($this->dateFrom, fn($q) => $q->whereDate('created_at', '>=', $this->dateFrom))
            ->when($this->dateTo,   fn($q) => $q->whereDate('created_at', '<=', $this->dateTo));

        return [
            'total_orders'    => $query->count(),
            'total_revenue'   => $query->sum('total'),
            'delivered'       => $query->where('status', 'delivered')->count(),
            'cancelled'       => (clone $query)->where('status', 'cancelled')->count(),
            'avg_order_value' => $query->count() > 0 ? $query->sum('total') / $query->count() : 0,
            'pending'         => (clone $query)->where('status', 'pending')->count(),
        ];
    }

    public function getOrdersProperty()
    {
        return Order::query()
            ->when($this->dateFrom, fn($q) => $q->whereDate('created_at', '>=', $this->dateFrom))
            ->when($this->dateTo,   fn($q) => $q->whereDate('created_at', '<=', $this->dateTo))
            ->latest()
            ->take(20)
            ->get();
    }

    public function getChartDataProperty()
    {
        $labels = [];
        $data   = [];

        for ($i = 6; $i >= 0; $i--) {
            $date     = Carbon::now()->subDays($i);
            $labels[] = $date->format('d M');
            $data[]   = Order::whereDate('created_at', $date)->sum('total');
        }

        return ['labels' => $labels, 'data' => $data];
    }

    public function render()
    {
        return view('livewire.reports.sales-report', [
            'stats'     => $this->stats,
            'orders'    => $this->orders,
            'chartData' => $this->chartData,
        ])->layout('layouts.admin');
    }
}