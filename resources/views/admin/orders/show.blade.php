<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Order Details - ShopWave Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root { --blue: #1A56A0; --text: #1A1A2E; --text-muted: #6B7280; --bg: #F3F4F6; --card: #FFFFFF; --border: #E5E7EB; }
        body { font-family: 'DM Sans', sans-serif; background: var(--bg); color: var(--text); display: flex; min-height: 100vh; }
        .sidebar { width: 240px; background: var(--blue); color: #fff; padding: 1.5rem 0; flex-shrink: 0; display: flex; flex-direction: column; position: fixed; height: 100vh; }
        .sidebar-logo { font-size: 1.2rem; font-weight: 600; padding: 0 1.5rem 1.5rem; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar-logo span { font-size: 0.7rem; display: block; opacity: 0.7; font-weight: 400; }
        .sidebar-nav { padding: 1rem 0; flex: 1; }
        .sidebar-link { display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 1.5rem; color: rgba(255,255,255,0.8); text-decoration: none; font-size: 0.9rem; transition: all 0.2s; }
        .sidebar-link:hover, .sidebar-link.active { background: rgba(255,255,255,0.1); color: #fff; }
        .sidebar-bottom { padding: 1rem 1.5rem; border-top: 1px solid rgba(255,255,255,0.1); }
        .user-info { font-size: 0.8rem; opacity: 0.7; margin-bottom: 0.75rem; }
        .logout-btn { width: 100%; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: #fff; border-radius: 8px; padding: 0.5rem; font-size: 0.85rem; cursor: pointer; font-family: 'DM Sans', sans-serif; }
        .main { margin-left: 240px; flex: 1; padding: 2rem; }
        .page-header { margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center; }
        .page-header h1 { font-size: 1.5rem; font-weight: 600; }
        .back-link { font-size: 0.875rem; color: var(--blue); text-decoration: none; }
        .alert-success { background: #dcfce7; color: #16a34a; padding: 0.75rem 1rem; border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.875rem; }
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem; }
        .card { background: var(--card); border: 1px solid var(--border); border-radius: 12px; padding: 1.5rem; }
        .card h2 { font-size: 0.95rem; font-weight: 600; margin-bottom: 1rem; padding-bottom: 0.75rem; border-bottom: 1px solid var(--border); }
        .detail-row { display: flex; justify-content: space-between; font-size: 0.875rem; padding: 0.4rem 0; }
        .detail-label { color: var(--text-muted); }
        .detail-value { font-weight: 500; }
        .badge { padding: 0.25rem 0.65rem; border-radius: 100px; font-size: 0.75rem; font-weight: 500; }
        .badge-pending { background: #fef3c7; color: #d97706; }
        .badge-processing { background: #dbeafe; color: #2563eb; }
        .badge-shipped { background: #e0e7ff; color: #4f46e5; }
        .badge-delivered { background: #dcfce7; color: #16a34a; }
        .badge-cancelled { background: #fee2e2; color: #dc2626; }
        table { width: 100%; border-collapse: collapse; }
        th { background: var(--bg); padding: 0.75rem 1rem; text-align: left; font-size: 0.75rem; text-transform: uppercase; color: var(--text-muted); font-weight: 500; }
        td { padding: 0.875rem 1rem; font-size: 0.875rem; border-top: 1px solid var(--border); }
        .status-form { display: flex; gap: 0.75rem; align-items: center; margin-top: 1rem; }
        .status-select { border: 1px solid var(--border); border-radius: 8px; padding: 0.5rem 0.75rem; font-size: 0.875rem; font-family: 'DM Sans', sans-serif; outline: none; background: #fff; flex: 1; }
        .update-btn { background: var(--blue); color: #fff; border: none; border-radius: 8px; padding: 0.5rem 1.25rem; font-size: 0.875rem; cursor: pointer; font-family: 'DM Sans', sans-serif; font-weight: 500; }
        .update-btn:hover { background: #3B7DD8; }
        .total-row { font-weight: 600; color: var(--blue); }
    </style>
</head>
<body>
<aside class="sidebar">
    <div class="sidebar-logo">ShopWave <span>Admin Panel</span></div>
    <nav class="sidebar-nav">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link">📊 Dashboard</a>
        <a href="{{ route('admin.orders.index') }}" class="sidebar-link active">📦 Orders</a>
        <a href="{{ route('admin.products.index') }}" class="sidebar-link">🛍️ Products</a>
        <a href="{{ route('admin.categories.index') }}" class="sidebar-link">🗂️ Categories</a>
        <a href="{{ route('home') }}" class="sidebar-link">🌐 View Store</a>
    </nav>
    <div class="sidebar-bottom">
        <div class="user-info">{{ Auth::user()->name }}</div>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="logout-btn">Sign Out</button>
        </form>
    </div>
</aside>
<main class="main">
    <div class="page-header">
        <div>
            <h1>Order: {{ $order->order_number }}</h1>
            <p style="color:var(--text-muted);font-size:0.875rem;">Placed on {{ $order->created_at->format('F d, Y h:i A') }}</p>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="back-link">← Back to Orders</a>
    </div>

    @if(session('success'))
    <div class="alert-success">✅ {{ session('success') }}</div>
    @endif

    <div class="grid-2">
        <div class="card">
            <h2>👤 Customer Info</h2>
            <div class="detail-row"><span class="detail-label">Name</span><span class="detail-value">{{ $order->name }}</span></div>
            <div class="detail-row"><span class="detail-label">Email</span><span class="detail-value">{{ $order->email }}</span></div>
            <div class="detail-row"><span class="detail-label">Phone</span><span class="detail-value">{{ $order->phone }}</span></div>
        </div>
        <div class="card">
            <h2>🚚 Shipping Address</h2>
            <div class="detail-row"><span class="detail-label">Address</span><span class="detail-value">{{ $order->address }}</span></div>
            <div class="detail-row"><span class="detail-label">City</span><span class="detail-value">{{ $order->city }}</span></div>
            <div class="detail-row"><span class="detail-label">Province</span><span class="detail-value">{{ $order->province }}</span></div>
            <div class="detail-row"><span class="detail-label">ZIP</span><span class="detail-value">{{ $order->zip }}</span></div>
        </div>
        <div class="card">
            <h2>💳 Payment & Status</h2>
            <div class="detail-row"><span class="detail-label">Payment</span><span class="detail-value">{{ strtoupper($order->payment_method) }}</span></div>
            <div class="detail-row"><span class="detail-label">Status</span><span class="detail-value"><span class="badge badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span></span></div>
            <form class="status-form" method="POST" action="{{ route('admin.orders.update', $order) }}">
                @csrf @method('PATCH')
                <select class="status-select" name="status">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <button type="submit" class="update-btn">Update</button>
            </form>
        </div>
        <div class="card">
            <h2>💰 Order Summary</h2>
            <div class="detail-row"><span class="detail-label">Subtotal</span><span class="detail-value">₱{{ number_format($order->subtotal, 2) }}</span></div>
            <div class="detail-row"><span class="detail-label">Shipping</span><span class="detail-value">₱{{ number_format($order->shipping, 2) }}</span></div>
            <div class="detail-row total-row"><span>Total</span><span>₱{{ number_format($order->total, 2) }}</span></div>
            @if($order->notes)
            <div style="margin-top:0.75rem;padding-top:0.75rem;border-top:1px solid var(--border);font-size:0.85rem;color:var(--text-muted);">
                <strong>Notes:</strong> {{ $order->notes }}
            </div>
            @endif
        </div>
    </div>

    <div class="card">
        <h2 style="margin-bottom:1rem;">📋 Order Items</h2>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td style="font-weight:500;">{{ $item->product_name }}</td>
                    <td>₱{{ number_format($item->price, 2) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>₱{{ number_format($item->subtotal, 2) }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="3" style="text-align:right;font-weight:600;">Total</td>
                    <td style="font-weight:600;color:var(--blue);">₱{{ number_format($order->total, 2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</main>
</body>
</html>