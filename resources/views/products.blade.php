@extends('layout')

@section('title', 'Products - ShopWave')

@section('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, #1A56A0, #3B7DD8);
        color: #fff; padding: 3rem 0; text-align: center;
    }
    .page-header h1 { font-size: 2rem; font-weight: 600; margin-bottom: 0.5rem; }
    .page-header p { opacity: 0.85; }

    .products-section { padding: 2rem 0 4rem; }
    .products-layout { display: grid; grid-template-columns: 240px 1fr; gap: 2rem; }

    /* SIDEBAR */
    .sidebar { }
    .filter-card { background: var(--card); border: 1px solid var(--border); border-radius: 12px; padding: 1.25rem; margin-bottom: 1rem; }
    .filter-title { font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted); margin-bottom: 0.75rem; }
    .filter-link { display: block; padding: 0.4rem 0; font-size: 0.875rem; color: var(--text-muted); text-decoration: none; transition: color 0.2s; border-radius: 6px; }
    .filter-link:hover, .filter-link.active { color: var(--blue); font-weight: 500; }

    /* TOOLBAR */
    .toolbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 0.75rem; }
    .toolbar-left { font-size: 0.875rem; color: var(--text-muted); }
    .search-form { display: flex; gap: 0.5rem; }
    .search-input { border: 1px solid var(--border); border-radius: 8px; padding: 0.5rem 1rem; font-size: 0.875rem; font-family: 'DM Sans', sans-serif; outline: none; width: 220px; }
    .search-input:focus { border-color: var(--blue); }
    .search-btn { background: var(--blue); color: #fff; border: none; border-radius: 8px; padding: 0.5rem 1rem; cursor: pointer; font-size: 0.875rem; }
    .sort-select { border: 1px solid var(--border); border-radius: 8px; padding: 0.5rem 0.75rem; font-size: 0.875rem; font-family: 'DM Sans', sans-serif; outline: none; background: #fff; cursor: pointer; }

    .stock-badge { font-size: 0.72rem; padding: 0.15rem 0.5rem; border-radius: 100px; }
    .in-stock { background: #dcfce7; color: #16a34a; }
    .out-stock { background: #fee2e2; color: #dc2626; }

    @media(max-width:768px) {
        .products-layout { grid-template-columns: 1fr; }
        .product-grid { grid-template-columns: repeat(2,1fr); }
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <div class="container">
        <h1>All Products</h1>
        <p>Discover our full collection of quality products.</p>
    </div>
</div>

<section class="products-section">
    <div class="container">
        <div class="products-layout">

            <!-- SIDEBAR -->
            <aside class="sidebar">
                <div class="filter-card">
                    <div class="filter-title">Categories</div>
                    <a href="{{ route('products') }}" class="filter-link {{ !request('category') ? 'active' : '' }}">All Products</a>
                    @foreach($categories as $category)
                    <a href="{{ route('products') }}?category={{ $category->slug }}" class="filter-link {{ request('category') == $category->slug ? 'active' : '' }}">
                        {{ $category->name }}
                        <span style="font-size:0.75rem;color:var(--text-muted);">({{ $category->products->count() }})</span>
                    </a>
                    @endforeach
                </div>
                <div class="filter-card">
                    <div class="filter-title">Sort By</div>
                    <a href="{{ route('products') }}?{{ http_build_query(array_merge(request()->all(), ['sort' => 'newest'])) }}" class="filter-link {{ request('sort') == 'newest' ? 'active' : '' }}">Newest First</a>
                    <a href="{{ route('products') }}?{{ http_build_query(array_merge(request()->all(), ['sort' => 'price_asc'])) }}" class="filter-link {{ request('sort') == 'price_asc' ? 'active' : '' }}">Price: Low to High</a>
                    <a href="{{ route('products') }}?{{ http_build_query(array_merge(request()->all(), ['sort' => 'price_desc'])) }}" class="filter-link {{ request('sort') == 'price_desc' ? 'active' : '' }}">Price: High to Low</a>
                </div>
            </aside>

            <!-- MAIN -->
            <div>
                <div class="toolbar">
                    <div class="toolbar-left">
                        Showing <strong>{{ $products->count() }}</strong> of <strong>{{ $products->total() }}</strong> products
                    </div>
                    <form class="search-form" method="GET" action="{{ route('products') }}">
                        <input class="search-input" type="text" name="search" placeholder="Search products..." value="{{ request('search') }}"/>
                        <button type="submit" class="search-btn">🔍</button>
                    </form>
                </div>

                @if($products->count())
                <div class="product-grid">
                    @foreach($products as $product)
                    <div class="product-card">
                        @if($product->image)
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="product-img"/>
                        @else
                        <div class="product-img-placeholder">📦</div>
                        @endif
                        <div class="product-body">
                            <div class="product-category">{{ $product->category?->name ?? 'Uncategorized' }}</div>
                            <a href="{{ route('products.show', $product) }}" class="product-name">{{ $product->name }}</a>
                            <div class="product-price">
                                <span class="price-current">₱{{ number_format($product->price, 2) }}</span>
                                @if($product->original_price)
                                <span class="price-original">₱{{ number_format($product->original_price, 2) }}</span>
                                <span class="price-badge">-{{ $product->getDiscountPercentage() }}%</span>
                                @endif
                            </div>
                            <div style="margin-bottom:0.75rem;">
                                <span class="stock-badge {{ $product->stock > 0 ? 'in-stock' : 'out-stock' }}">
                                    {{ $product->stock > 0 ? 'In Stock ('.$product->stock.')' : 'Out of Stock' }}
                                </span>
                            </div>
                            @if($product->stock > 0)
                            <form action="{{ route('cart.add', $product) }}" method="POST">
                                @csrf
                                <button type="submit" class="add-to-cart-btn">🛒 Add to Cart</button>
                            </form>
                            @else
                            <button class="add-to-cart-btn" disabled style="opacity:0.5;cursor:not-allowed;">Out of Stock</button>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                <div style="margin-top:2rem;">{{ $products->links() }}</div>
                @else
                <div style="text-align:center;padding:4rem;color:var(--text-muted);">
                    <p style="font-size:3rem;">🔍</p>
                    <p style="font-size:1rem;margin-top:1rem;">No products found. Try a different search.</p>
                    <a href="{{ route('products') }}" class="btn btn-outline" style="margin-top:1rem;">Clear Filters</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection