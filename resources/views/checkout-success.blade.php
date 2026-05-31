@extends('layout')

@section('title', 'Order Confirmed - ShopWave')

@section('styles')
<style>
    .success-section { padding: 5rem 0; text-align: center; }
    .success-card {
        background: var(--card); border: 1px solid var(--border);
        border-radius: 16px; padding: 3rem 2rem;
        max-width: 600px; margin: 0 auto;
    }
    .success-icon {
        width: 80px; height: 80px; background: #dcfce7;
        border-radius: 50%; display: flex; align-items: center;
        justify-content: center; font-size: 2.5rem; margin: 0 auto 1.5rem;
    }
    .success-card h1 { font-size: 1.8rem; font-weight: 600; margin-bottom: 0.5rem; }
    .success-card p { color: var(--text-muted); margin-bottom: 0.5rem; }
    .order-number { font-size: 1.1rem; font-weight: 600; color: var(--blue); margin: 1rem 0; }

    .order-details { background: var(--bg); border-radius: 10px; padding: 1.25rem; margin: 1.5rem 0; text-align: left; }
    .detail-row { display: flex; justify-content: space-between; font-size: 0.875rem; padding: 0.5rem 0; border-bottom: 1px solid var(--border); }
    .detail-row:last-child { border-bottom: none; }
    .detail-label { color: var(--text-muted); }
    .detail-value { font-weight: 500; }

    .order-items { text-align: left; margin: 1.5rem 0; }
    .order-items h3 { font-size: 0.9rem; font-weight: 600; margin-bottom: 0.75rem; }
    .order-item { display: flex; justify-content: space-between; font-size: 0.875rem; padding: 0.4rem 0; color: var(--text-muted); }

    .success-btns { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; margin-top: 1.5rem; }

    .status-badge {
        display: inline-block; padding: 0.3rem 0.9rem;
        border-radius: 100px; font-size: 0.8rem; font-weight: 500;
        background: #fef3c7; color: #d97706;
    }
</style>
@endsection

@section('content')
<section class="success-section">
    <div class="container">
        <div class="success-card">
            <div class="success-icon">✅</div>
            <h1>Order Confirmed!</h1>
            <p>Thank you for shopping with ShopWave.</p>
            <p>Your order has been received and is being processed.</p>

            <div class="order-number">{{ $order->order_number }}</div>
            <span class="status-badge">⏳ {{ ucfirst($order->status) }}</span>

            <div class="order-details">
                <div class="detail-row">
                    <span class="detail-label">Customer</span>
                    <span class="detail-value">{{ $order->name }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Email</span>
                    <span class="detail-value">{{ $order->email }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Phone</span>
                    <span class="detail-value">{{ $order->phone }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Address</span>
                    <span class="detail-value">{{ $order->address }}, {{ $order->city }}, {{ $order->province }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Payment</span>
                    <span class="detail-value">{{ strtoupper($order->payment_method) }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Subtotal</span>
                    <span class="detail-value">₱{{ number_format($order->subtotal, 2) }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Shipping</span>
                    <span class="detail-value">₱{{ number_format($order->shipping, 2) }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label" style="font-weight:600;">Total</span>
                    <span class="detail-value" style="color:var(--blue);font-weight:600;">₱{{ number_format($order->total, 2) }}</span>
                </div>
            </div>

            @if($order->items->count())
            <div class="order-items">
                <h3>Items Ordered</h3>
                @foreach($order->items as $item)
                <div class="order-item">
                    <span>{{ $item->product_name }} x{{ $item->quantity }}</span>
                    <span>₱{{ number_format($item->subtotal, 2) }}</span>
                </div>
                @endforeach
            </div>
            @endif

            <div class="success-btns">
                <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
                <a href="{{ route('products') }}" class="btn btn-outline">Continue Shopping</a>
            </div>
        </div>
    </div>
</section>
@endsection