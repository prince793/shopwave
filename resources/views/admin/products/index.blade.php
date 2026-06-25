<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Products - ShopWave Admin</title>
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
        .page-header p { color: var(--text-muted); font-size: 0.875rem; }
        .btn { display: inline-block; padding: 0.6rem 1.25rem; border-radius: 8px; font-size: 0.875rem; font-weight: 500; cursor: pointer; text-decoration: none; transition: all 0.2s; border: none; font-family: 'DM Sans', sans-serif; }
        .btn-primary { background: var(--blue); color: #fff; }
        .btn-primary:hover { background: #3B7DD8; }
        .alert-success { background: #dcfce7; color: #16a34a; padding: 0.75rem 1rem; border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.875rem; }
        .card { background: var(--card); border: 1px solid var(--border); border-radius: 12px; overflow: hidden; }
        .card-header { padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--border); }
        .card-header h2 { font-size: 1rem; font-weight: 600; }
        table { width: 100%; border-collapse: collapse; }
        th { background: var(--bg); padding: 0.75rem 1.5rem; text-align: left; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted); font-weight: 500; }
        td { padding: 0.875rem 1.5rem; font-size: 0.875rem; border-top: 1px solid var(--border); vertical-align: middle; }
        .product-img { width: 48px; height: 48px; border-radius: 8px; object-fit: cover; background: #E8F0FA; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; overflow: hidden; }
        .product-img img { width: 100%; height: 100%; object-fit: cover; }
        .badge { padding: 0.25rem 0.65rem; border-radius: 100px; font-size: 0.75rem; font-weight: 500; }
        .badge-active { background: #dcfce7; color: #16a34a; }
        .badge-inactive { background: #fee2e2; color: #dc2626; }
        .badge-featured { background: #fef3c7; color: #d97706; }
        .btn-sm { padding: 0.3rem 0.75rem; border-radius: 6px; font-size: 0.8rem; cursor: pointer; font-family: 'DM Sans', sans-serif; border: none; font-weight: 500; text-decoration: none; display: inline-block; }
        .btn-edit { background: #dbeafe; color: #2563eb; }
        .btn-edit:hover { background: #bfdbfe; }
        .btn-delete { background: #fee2e2; color: #dc2626; }
        .btn-delete:hover { background: #fecaca; }
        .actions { display: flex; gap: 0.5rem; }
        .empty-row { text-align: center; padding: 3rem; color: var(--text-muted); }
        .pagination { padding: 1rem 1.5rem; }
    </style>
</head>
<body>
<aside class="sidebar">
    <div class="sidebar-logo">ShopWave <span>Admin Panel</span></div>
    <nav class="sidebar-nav">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link">📊 Dashboard</a>
        <a href="{{ route('admin.orders.index') }}" class="sidebar-link">📦 Orders</a>
        <a href="{{ route('admin.products.index') }}" class="sidebar-link active">🛍️ Products</a>
        <a href="{{ route('admin.categories.index') }}" class="sidebar-link">🗂️ Categories</a>
        <a href="{{ route('home') }}" class="sidebar-link">🌐 View Store</a>
    </nav>
    <div class="sidebar-bottom">
        <div class="user-info">{{ Auth::user()->name }}</div>
        <form method="POST" action="{{'logout'}}">
            @csrf
            <button type="submit" class="logout-btn">Sign Out</button>
        </form>
    </div>
</aside>
<main class="main">
    <div class="page-header">
        <div>
            <h1>Products</h1>
            <p>Manage your store products.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Add Product</a>
    </div>
    @if(session('success'))
    <div class="alert-success">✅ {{ session('success') }}</div>
    @endif
    <div class="card">
        <div class="card-header">
            <h2>All Products ({{ $products->total() }})</h2>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>
                        <div style="display:flex;align-items:center;gap:0.75rem;">
                            <div class="product-img">
                                @if($product->image)
                                <img src="{{ $product->image }}" alt="{{ $product->name }}"/>
                                @else
                                📦
                                @endif
                            </div>
                            <div>
                                <div style="font-weight:500;">{{ $product->name }}</div>
                                @if($product->is_featured)
                                <span class="badge badge-featured">⭐ Featured</span>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td>{{ $product->category?->name ?? '—' }}</td>
                    <td>
                        <div style="font-weight:600;">₱{{ number_format($product->price, 2) }}</div>
                        @if($product->original_price)
                        <div style="font-size:0.78rem;color:var(--text-muted);text-decoration:line-through;">₱{{ number_format($product->original_price, 2) }}</div>
                        @endif
                    </td>
                    <td>
                        <span style="font-weight:500;color:{{ $product->stock > 0 ? '#16a34a' : '#dc2626' }}">
                            {{ $product->stock }}
                        </span>
                    </td>
                    <td><span class="badge {{ $product->is_active ? 'badge-active' : 'badge-inactive' }}">{{ $product->is_active ? 'Active' : 'Inactive' }}</span></td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn-sm btn-edit">Edit</a>
                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Delete this product?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-sm btn-delete">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="empty-row">No products yet. <a href="{{ route('admin.products.create') }}">Add one!</a></td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="pagination">{{ $products->links() }}</div>
    </div>
</main>
</body>
</html>