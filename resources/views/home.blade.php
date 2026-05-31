@extends('layout')

@section('title', 'ShopWave - Online Shopping Philippines')

@section('styles')
<style>
    .hero {
        background: linear-gradient(135deg, #1A56A0 0%, #3B7DD8 100%);
        color: #fff; padding: 6rem 0; text-align: center;
    }
    .hero-tag { display: inline-block; background: rgba(255,255,255,0.15); padding: 0.3rem 1rem; border-radius: 100px; font-size: 0.8rem; margin-bottom: 1.5rem; }
    .hero h1 { font-size: clamp(2rem, 5vw, 3.5rem); font-weight: 600; margin-bottom: 1rem; line-height: 1.2; }
    .hero p { font-size: 1.1rem; opacity: 0.85; max-width: 520px; margin: 0 auto 2.5rem; }
    .hero-btns { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }
    .btn-white { background: #fff; color: var(--blue); }
    .btn-white:hover { background: #f0f4ff; }
    .btn-ghost { border: 1.5px solid rgba(255,255,255,0.5); color: #fff; }
    .btn-ghost:hover { background: rgba(255,255,255,0.1); }

    .categories-row { display: grid; grid-template-columns: repeat(6, 1fr); gap: 1rem; margin-bottom: 1rem; }
    .category-chip {
        background: var(--card); border: 1px solid var(--border);
        border-radius: 12px; padding: 1rem 0.5rem;
        text-align: center; text-decoration: none; color: var(--text);
        transition: all 0.2s; font-size: 0.85rem;
    }
    .category-chip:hover { border-color: var(--blue); color: var(--blue); transform: translateY(-2px); }
    .category-chip .icon { font-size: 1.8rem; display: block; margin-bottom: 0.4rem; }

    .banner {
        background: linear-gradient(135deg, #1A56A0, #3B7DD8);
        border-radius: 16px; padding: 3rem 2rem;
        color: #fff; text-align: center; margin: 2rem 0;
    }
    .banner h2 { font-size: 1.8rem; font-weight: 600; margin-bottom: 0.5rem; }
    .banner p { opacity: 0.85; margin-bottom: 1.5rem; }

    .features-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; }
    .feature-card { text-align: center; padding: 1.5rem; }
    .feature-icon { font-size: 2rem; display: block; margin-bottom: 0.75rem; }
    .feature-card h3 { font-size: 0.95rem; font-weight: 600; margin-bottom: 0.4rem; }
    .feature-card p { font-size: 0.82rem; color: var(--text-muted); }

    @media(max-width:768px) {
        .categories-row { grid-template-columns: repeat(3,1fr); }
        .features-grid { grid-template-columns: repeat(2,1fr); }
    }
</style>
@endsection

@section('content')

<!-- HERO -->
<div class="hero">
    <div class="container">
        <div class="hero-tag">🛍️ Free Shipping on Orders Over ₱999</div>
        <h1>Shop Smarter,<br/>Live Better</h1>
        <p>Discover thousands of quality products at unbeatable prices. Fast delivery across the Philippines.</p>
        <div class="hero-btns">
            <a href="{{ route('products') }}" class="btn btn-white">Shop Now</a>
            <a href="{{ route('products') }}?sort=newest" class="btn btn-ghost">New Arrivals</a>
        </div>
    </div>
</div>

<!-- CATEGORIES -->
<section class="section">
    <div class="container">
        <div class="section-label">Browse By</div>
        <h2 class="section-title">Shop Categories</h2>
        <div class="categories-row">
            @forelse($categories as $category)
            <a href="{{ route('products') }}?category={{ $category->slug }}" class="category-chip">
                <span class="icon">🛍️</span>
                {{ $category->name }}
            </a>
            @empty
            <p>No categories yet.</p>
            @endforelse
        </div>
    </div>
</section>

<!-- FEATURED PRODUCTS -->
<section class="section" style="padding-top:0;">
    <div class="container">
        <div class="section-label">Hand Picked</div>
        <h2 class="section-title">Featured Products</h2>
        @if($featuredProducts->count())
        <div class="product-grid">
            @foreach($featuredProducts as $product)
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
                    <form action="{{ route('cart.add', $product) }}" method="POST">
                        @csrf
                        <button type="submit" class="add-to-cart-btn">🛒 Add to Cart</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @endif
        <div style="text-align:center;margin-top:2rem;">
            <a href="{{ route('products') }}" class="btn btn-outline">View All Products</a>
        </div>
    </div>
</section>

<!-- BANNER -->
<section style="padding: 0 0 4rem;">
    <div class="container">
        <div class="banner">
            <h2>🔥 New Arrivals Just Dropped!</h2>
            <p>Check out the latest products added to our store. Fresh styles, new tech, and more.</p>
            <a href="{{ route('products') }}?sort=newest" class="btn btn-white">Shop New Arrivals</a>
        </div>
    </div>
</section>

<!-- NEW ARRIVALS -->
<section class="section" style="padding-top:0;">
    <div class="container">
        <div class="section-label">Just Added</div>
        <h2 class="section-title">New Arrivals</h2>
        <div class="product-grid">
            @foreach($newArrivals as $product)
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

<!-- FEATURES -->
<section class="section" style="background:#F0F4FF;padding:3rem 0;">
    <div class="container">
        <div class="features-grid">
            <div class="feature-card">
                <span class="feature-icon">🚚</span>
                <h3>Fast Delivery</h3>
                <p>Free shipping on orders over ₱999. Delivered in 3-5 business days.</p>
            </div>
            <div class="feature-card">
                <span class="feature-icon">🔒</span>
                <h3>Secure Payment</h3>
                <p>Pay safely with GCash or Cash on Delivery.</p>
            </div>
            <div class="feature-card">
                <span class="feature-icon">↩️</span>
                <h3>Easy Returns</h3>
                <p>Not satisfied? Return within 7 days, no questions asked.</p>
            </div>
            <div class="feature-card">
                <span class="feature-icon">💬</span>
                <h3>24/7 Support</h3>
                <p>Our customer support team is always ready to help you.</p>
            </div>
        </div>
    </div>
</section>

@endsection