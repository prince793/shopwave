<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Edit Category - ShopWave Admin</title>
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
        .form-card { background: var(--card); border: 1px solid var(--border); border-radius: 12px; padding: 1.75rem; margin-bottom: 1.25rem; max-width: 600px; }
        .form-card h2 { font-size: 1rem; font-weight: 600; margin-bottom: 1.25rem; padding-bottom: 0.75rem; border-bottom: 1px solid var(--border); }
        .form-group { margin-bottom: 1rem; }
        .form-group label { display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 0.4rem; }
        .form-group input, .form-group textarea { width: 100%; border: 1px solid var(--border); border-radius: 8px; padding: 0.7rem 1rem; font-size: 0.9rem; font-family: 'DM Sans', sans-serif; outline: none; transition: border-color 0.2s; background: var(--bg); }
        .form-group input:focus, .form-group textarea:focus { border-color: var(--blue); background: #fff; }
        .form-group textarea { resize: vertical; min-height: 80px; }
        .error { color: #dc2626; font-size: 0.8rem; margin-top: 0.3rem; }
        .checkbox-group { display: flex; align-items: center; gap: 0.5rem; }
        .checkbox-group input { width: auto; }
        .checkbox-group label { font-size: 0.875rem; font-weight: 400; margin: 0; }
        .submit-btn { background: var(--blue); color: #fff; border: none; border-radius: 8px; padding: 0.875rem 2rem; font-size: 1rem; font-weight: 500; cursor: pointer; font-family: 'DM Sans', sans-serif; transition: background 0.2s; }
        .submit-btn:hover { background: #3B7DD8; }
    </style>
</head>
<body>
<aside class="sidebar">
    <div class="sidebar-logo">ShopWave <span>Admin Panel</span></div>
    <nav class="sidebar-nav">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link">📊 Dashboard</a>
        <a href="{{ route('admin.orders.index') }}" class="sidebar-link">📦 Orders</a>
        <a href="{{ route('admin.products.index') }}" class="sidebar-link">🛍️ Products</a>
        <a href="{{ route('admin.categories.index') }}" class="sidebar-link active">🗂️ Categories</a>
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
        <h1>Edit Category</h1>
        <a href="{{ route('admin.categories.index') }}" class="back-link">← Back to Categories</a>
    </div>
    <form method="POST" action="{{ route('admin.categories.update', $category) }}">
        @csrf @method('PUT')
        <div class="form-card">
            <h2>🗂️ Category Information</h2>
            <div class="form-group">
                <label>Category Name *</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}"/>
                @error('name')<div class="error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description">{{ old('description', $category->description) }}</textarea>
            </div>
            <div class="form-group">
                <label>Image URL</label>
                <input type="url" name="image" value="{{ old('image', $category->image) }}"/>
            </div>
            <div class="form-group">
                <div class="checkbox-group">
                    <input type="checkbox" name="is_active" id="is_active" {{ old('is_active', $category->is_active) ? 'checked' : '' }}/>
                    <label for="is_active">✅ Active (visible in store)</label>
                </div>
            </div>
        </div>
        <button type="submit" class="submit-btn">💾 Update Category</button>
    </form>
</main>
</body>
</html>