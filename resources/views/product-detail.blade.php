@extends('layout')

@section('title', $product->name . ' - ShopWave')

@section('styles')
<style>
    .product-section { padding: 3rem 0; }
    .product-layout { display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: start; }

    .product-image-box {
        border-radius: 16px; overflow: hidden;
        border: 1px solid var(--border);
    }
    .product-image-box img { width: 100%; height: 420px; object-fit: cover; display: block; }
    .product-image-placeholder { width: 100%; height: 420px; background: var(--blue-light); display: flex; align-items: center; justify-content: center; font-size: 6rem; }

    .product-info {}
    .product-info .category-link { font-size: 0.8rem; color: var(--blue); text-decoration: none; text-transform: uppercase; letter-spacing: 0.05em; }
    .product-info h1 { font-size: 1.8rem; font-weight: 600; margin: 0.5rem 0 1rem; line-height: 1.3; }
    .product-price-row { display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem; }
    .product-price-main { font-size: 2rem; font-weight: 600; color: var(--blue); }
    .product-price-orig { font-size: 1rem; color: var(--text-muted); text-decoration: line-through; }
    .product-discount { background: #fee2e2; color: var(--red); padding: 0.25rem 0.6rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600; }

    .stock-info { display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem; font-size: 0.875rem; }
    .stock-dot { width: 8px; height: 8px; border-radius: 50%; }
    .stock-dot.green { background: #16a34a; }
    .stock-dot.red { background: #dc2626; }

    .product-desc { color: var(--text-muted); font-size: 0.95rem; line-height: 1.7; margin-bottom: 1.5rem; }

    .qty-row { display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem; }
    .qty-label { font-size: 0.875rem; font-weight: 500; }
    .qty-input { width: 80px; border: 1px solid var(--border); border-radius: 8px; padding: 0.5rem; font-size: 1rem; text-align: center; outline: none; font-family: 'DM Sans', sans-serif; }
    .qty-input:focus { border-color: var(--blue); }

    .product-actions { display: flex; gap: 1rem; flex-wrap: wrap; }
    .btn-cart { flex: 1; background: var(--blue); color: #fff; border: none; border-radius: 10px; padding: 0.875rem; font-size: 1rem; font-weight: 500; cursor: pointer; font-family: 'DM Sans', sans-serif; transition: background 0.2s; }
    .btn-cart:hover { background: var(--blue-mid); }

    .product-meta { margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid var(--border); }
    .meta-item { display: flex; gap: 0.5rem; font-size: 0.85rem; margin-bottom: 0.5rem; }
    .meta-label { color: var(--text-muted); min-width: 80px; }
    .meta-value { font-weight: 500; }

    .related-section { padding: 3rem 0; background: #F9FAFB; }
    .related-section h2 { font-size: 1.5rem; font-weight: 600; margin-bottom: 1.5rem; }

    .breadcrumb { display: flex; gap: 0.5rem; align-items: center; font-size: 0.85rem; color: var(--text-muted); margin-bottom: 2rem; }
    .breadcrumb a { color: var(--blue); text-decoration: none; }
    .breadcrumb span { opacity: 0.5; }

    @media(max-width:768px) { .product-layout { grid-template-columns: 1fr; } }
</style>
@endsection

@section('content')
<section class="product-section">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span>/</span>
            <a href="{{ route('products') }}">Products</a>
            <span>/</span>
            @if($product->category)
            <a href="{{ route('products') }}?category={{ $product->category->slug }}">{{ $product->category->name }}</a>
            <span>/</span>
            @endif
            <span style="color:var(--text);">{{ $product->name }}</span>
        </div>

        <div class="product-layout">
            <div class="product-image-box">
                @if($product->image)
                <img src="{{ $product->image }}" alt="{{ $product->name }}"/>
                @else
                <div class="product-image-placeholder">📦</div>
                @endif
            </div>

            <div class="product-info">
                @if($product->category)
                <a href="{{ route('products') }}?category={{ $product->category->slug }}" class="category-link">{{ $product->category->name }}</a>
                @endif
                <h1>{{ $product->name }}</h1>

                <div class="product-price-row">
                    <span class="product-price-main">₱{{ number_format($product->price, 2) }}</span>
                    @if($product->original_price)
                    <span class="product-price-orig">₱{{ number_format($product->original_price, 2) }}</span>
                    <span class="product-discount">-{{ $product->getDiscountPercentage() }}% OFF</span>
                    @endif
                </div>

                <div class="stock-info">
                    <div class="stock-dot {{ $product->stock > 0 ? 'green' : 'red' }}"></div>
                    @if($product->stock > 0)
                    <span style="color:#16a34a;">In Stock — {{ $product->stock }} available</span>
                    @else
                    <span style="color:#dc2626;">Out of Stock</span>
                    @endif
                </div>

                <p class="product-desc">{{ $product->description }}</p>

                @if($product->stock > 0)
                <form action="{{ route('cart.add', $product) }}" method="POST">
                    @csrf
                    <div class="qty-row">
                        <span class="qty-label">Quantity:</span>
                        <input class="qty-input" type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"/>
                    </div>
                    <div class="product-actions">
                        <button type="submit" class="btn-cart">🛒 Add to Cart</button>
                    </div>
                </form>
                @else
                <button class="btn-cart" disabled style="opacity:0.5;cursor:not-allowed;width:100%;">Out of Stock</button>
                @endif

                <div class="product-meta">
                    <div class="meta-item">
                        <span class="meta-label">Category:</span>
                        <span class="meta-value">{{ $product->category?->name ?? 'Uncategorized' }}</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Stock:</span>
                        <span class="meta-value">{{ $product->stock }} units</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Delivery:</span>
                        <span class="meta-value">3-5 business days</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Payment:</span>
                        <span class="meta-value">COD or GCash</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@if($related->count())
<section class="related-section">
    <div class="container">
        <h2>Related Products</h2>
        <div class="product-grid">
            @foreach($related as $product)
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
                        @endif
                    </div>
                    <form action="{{ route('cart.add', $product) }}" method="POST">
                        @csrf
                        <button type="submit" class="add-to-cart-btn">🛒 Add to Cart</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection