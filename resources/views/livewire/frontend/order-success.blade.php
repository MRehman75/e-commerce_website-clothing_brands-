@extends('layouts.frontend')

@section('title', 'Order Success')

@push('styles')
@endpush

<x-slot name="slot">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm text-center p-5">
                <div class="mb-4">
                    <div class="rounded-circle bg-success d-inline-flex align-items-center justify-content-center mb-3"
                         style="width:80px;height:80px;">
                        <i class="fas fa-check fa-2x text-white"></i>
                    </div>
                    <h2 class="fw-bold text-success">Order Place Ho Gaya!</h2>
                    <p class="text-muted">Shukriya! Aapka order successfully receive ho gaya.</p>
                </div>

                <div class="card bg-light border-0 p-4 mb-4 text-start">
                    <h5 class="fw-bold mb-3"><i class="fas fa-receipt me-2"></i>Order Details</h5>
                    <div class="row g-2">
                        <div class="col-6">
                            <small class="text-muted">Order Number</small>
                            <p class="fw-bold mb-0">{{ $order->order_number }}</p>
                        </div>
                        <div class="col-6">
                            <small class="text-muted">Status</small>
                            <p class="fw-bold mb-0 text-warning">{{ ucfirst($order->status) }}</p>
                        </div>
                        <div class="col-6">
                            <small class="text-muted">Customer</small>
                            <p class="fw-bold mb-0">{{ $order->customer_name }}</p>
                        </div>
                        <div class="col-6">
                            <small class="text-muted">Payment Method</small>
                            <p class="fw-bold mb-0">{{ ucfirst($order->payment_method) }}</p>
                        </div>
                        <div class="col-6">
                            <small class="text-muted">Total Amount</small>
                            <p class="fw-bold mb-0 text-primary">Rs. {{ number_format($order->total, 2) }}</p>
                        </div>
                        <div class="col-6">
                            <small class="text-muted">Date</small>
                            <p class="fw-bold mb-0">{{ $order->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>

                @if($order->items->count() > 0)
                <div class="card border-0 p-4 mb-4 text-start">
                    <h5 class="fw-bold mb-3"><i class="fas fa-box me-2"></i>Ordered Items</h5>
                    @foreach($order->items as $item)
                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                        <div>
                            <p class="mb-0 fw-semibold">{{ $item->product_name }}</p>
                            <small class="text-muted">Qty: {{ $item->quantity }}</small>
                        </div>
                        <p class="mb-0 fw-bold">Rs. {{ number_format($item->total, 2) }}</p>
                    </div>
                    @endforeach
                    <div class="d-flex justify-content-between mt-3">
                        <strong>Total</strong>
                        <strong class="text-primary">Rs. {{ number_format($order->total, 2) }}</strong>
                    </div>
                </div>
                @endif

                <div class="d-flex gap-3 justify-content-center">
                    <a href="{{ route('products') }}" class="btn btn-primary">
                        <i class="fas fa-shopping-bag me-2"></i>Shopping Continue Karein
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</x-slot>