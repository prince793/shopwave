<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Orders - ShopWave Admin</title>
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
        .page-header { margin-bottom: 2rem; }
        .page-header h1 { font-size: 1.5rem; font-weight: 600; }
        .page-header p { color: var(--text-muted); font-size: 0.875rem; }
        .alert-success { background: #dcfce7; color: #16a34a; padding: 0.75rem 1rem; border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.875rem; }
        .card { background: var(--card); border: 1px solid var(--border); border-radius: 12px; overflow: hidden; }
        .card-header { padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--border); }
        .card-header h2 { font-size: 1rem; font-weight: 600; }
        table { width: 100%; border-collapse: collapse; }
        th { background: var(--bg); padding: 0.75rem 1.5rem; text-align: left; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted); font-weight: 500; }
        td { padding: 0.875rem 1.5rem; font-size: 0.875rem; border-top: 1px solid var(--border); vertical-align: middle; }
        .badge { padding: 0.25rem 0.65rem; border-radius: 100px; font-size: 0.75rem; font-weight: 500; }
        .badge-pending { background: #fef3c7; color: #d97706; }
        .badge-processing { background: #dbeafe; color: #2563eb; }
        .badge-shipped { background: #e0e7ff; color: #4f46e5; }
        .badge-delivered { background: #dcfce7; color: #16a34a; }
        .badge-cancelled { background: #fee2e2; color: #dc2626; }
        .btn-sm { padding: 0.3rem 0.75rem; border-radius: 6px; font-size: 0.8rem; cursor: pointer; font-family: 'DM Sans', sans-serif; border: none; font-weight: 500; text-decoration: none; display: inline-block; }
        .btn-view { background: var(--blue); color: #fff; }
        .btn-view:hover { background: #3B7DD8; }
        .empty-row { text-align: center; padding: 3rem; color: var(--text-muted); }
        .pagination { padding: 1rem 1.5rem; display: flex; gap: 0.5rem; }
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
        <form method="POST" action="{{ 'logout' }}">
            @csrf
            <button type="submit" class="logout-btn">Sign Out</button>
        </form>
    </div>
</aside>
<main class="main">
    <div class="page-header">
        <h1>Orders</h1>
        <p>Manage all customer orders.</p>
    </div>
    @if(session('success'))
    <div class="alert-success">✅ {{ session('success') }}</div>
    @endif
    <div class="card">
        <div class="card-header">
            <h2>All Orders ({{ $orders->total() }})</h2>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td style="font-weight:500;color:var(--blue);">{{ $order->order_number }}</td>
                    <td>
                        <div style="font-weight:500;">{{ $order->name }}</div>
                        <div style="font-size:0.8rem;color:var(--text-muted);">{{ $order->email }}</div>
                    </td>
                    <td>₱{{ number_format($order->total, 2) }}</td>
                    <td>{{ strtoupper($order->payment_method) }}</td>
                    <td><span class="badge badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span></td>
                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                    <td><a href="{{ route('admin.orders.show', $order) }}" class="btn-sm btn-view">View</a></td>
                </tr>
                @empty
                <tr><td colspan="7" class="empty-row">No orders yet.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="pagination">{{ $orders->links() }}</div>
    </div>
</main>
</body>
</html>