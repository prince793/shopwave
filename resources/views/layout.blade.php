<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'ShopWave')</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --blue: #1A56A0; --blue-light: #E8F0FA; --blue-mid: #3B7DD8;
            --text: #1A1A2E; --text-muted: #6B7280;
            --bg: #FAFAFA; --card: #FFFFFF; --border: #E5E7EB;
            --green: #16a34a; --red: #dc2626;
        }
        body { font-family: 'DM Sans', sans-serif; background: var(--bg); color: var(--text); }

        /* NAV */
        nav {
            position: sticky; top: 0; z-index: 100;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(8px);
            border-bottom: 1px solid var(--border);
            padding: 1rem 2rem;
            display: flex; justify-content: space-between; align-items: center;
        }
        .nav-logo { font-size: 1.3rem; font-weight: 600; color: var(--blue); text-decoration: none; }
        .nav-logo span { color: #3B7DD8; }
        .nav-links { display: flex; gap: 1.5rem; list-style: none; align-items: center; }
        .nav-links a { text-decoration: none; color: var(--text-muted); font-size: 0.9rem; transition: color 0.2s; }
        .nav-links a:hover { color: var(--blue); }
        .nav-cart {
            position: relative; background: var(--blue); color: #fff !important;
            padding: 0.5rem 1.2rem; border-radius: 8px;
        }
        .cart-badge {
            position: absolute; top: -6px; right: -6px;
            background: #ef4444; color: #fff;
            width: 18px; height: 18px; border-radius: 50%;
            font-size: 0.7rem; display: flex; align-items: center; justify-content: center;
            font-weight: 600;
        }

        /* ALERTS */
        .alert {
            padding: 0.75rem 1rem; border-radius: 8px;
            margin: 1rem 2rem; font-size: 0.875rem;
        }
        .alert-success { background: #dcfce7; color: var(--green); }
        .alert-error { background: #fee2e2; color: var(--red); }

        /* FOOTER */
        footer {
            background: var(--text); color: rgba(255,255,255,0.7);
            padding: 3rem 2rem 1.5rem; margin-top: 5rem;
        }
        .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 2rem; max-width: 1100px; margin: 0 auto 2rem; }
        .footer-logo { font-size: 1.2rem; font-weight: 600; color: #fff; margin-bottom: 0.75rem; }
        .footer-desc { font-size: 0.875rem; line-height: 1.6; }
        .footer-heading { font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.08em; color: #fff; margin-bottom: 1rem; }
        .footer-links { list-style: none; display: flex; flex-direction: column; gap: 0.5rem; }
        .footer-links a { color: rgba(255,255,255,0.7); text-decoration: none; font-size: 0.875rem; transition: color 0.2s; }
        .footer-links a:hover { color: #fff; }
        .footer-bottom { text-align: center; font-size: 0.8rem; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 1.5rem; max-width: 1100px; margin: 0 auto; }

        /* UTILITIES */
        .container { max-width: 1100px; margin: 0 auto; padding: 0 2rem; }
        .btn { display: inline-block; padding: 0.75rem 1.75rem; border-radius: 8px; font-size: 0.9rem; font-weight: 500; cursor: pointer; text-decoration: none; transition: all 0.2s; border: 1.5px solid transparent; font-family: 'DM Sans', sans-serif; }
        .btn-primary { background: var(--blue); color: #fff; border-color: var(--blue); }
        .btn-primary:hover { background: var(--blue-mid); }
        .btn-outline { border-color: var(--border); color: var(--text); background: transparent; }
        .btn-outline:hover { border-color: var(--blue); color: var(--blue); }
        .btn-danger { background: #fee2e2; color: var(--red); border-color: #fecaca; }
        .btn-danger:hover { background: #fecaca; }
        .section { padding: 4rem 0; }
        .section-label { font-size: 0.75rem; color: var(--blue); letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 0.5rem; }
        .section-title { font-size: 1.8rem; font-weight: 600; margin-bottom: 1rem; }

        .product-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.25rem; }
        .product-card { background: var(--card); border: 1px solid var(--border); border-radius: 12px; overflow: hidden; transition: transform 0.2s, border-color 0.2s; }
        .product-card:hover { transform: translateY(-3px); border-color: var(--blue); }
        .product-img { width: 100%; height: 200px; object-fit: cover; display: block; background: #f3f4f6; }
        .product-img-placeholder { width: 100%; height: 200px; background: var(--blue-light); display: flex; align-items: center; justify-content: center; font-size: 3rem; }
        .product-body { padding: 1rem; }
        .product-category { font-size: 0.72rem; color: var(--blue); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.3rem; }
        .product-name { font-size: 0.9rem; font-weight: 600; margin-bottom: 0.5rem; text-decoration: none; color: var(--text); display: block; }
        .product-price { display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.75rem; }
        .price-current { font-size: 1rem; font-weight: 600; color: var(--blue); }
        .price-original { font-size: 0.8rem; color: var(--text-muted); text-decoration: line-through; }
        .price-badge { font-size: 0.7rem; background: #fee2e2; color: var(--red); padding: 0.15rem 0.4rem; border-radius: 4px; font-weight: 600; }
        .add-to-cart-btn { width: 100%; background: var(--blue); color: #fff; border: none; border-radius: 8px; padding: 0.6rem; font-size: 0.85rem; font-weight: 500; cursor: pointer; font-family: 'DM Sans', sans-serif; transition: background 0.2s; }
        .add-to-cart-btn:hover { background: var(--blue-mid); }

        @media(max-width:768px) {
            .product-grid { grid-template-columns: repeat(2,1fr); }
            .footer-grid { grid-template-columns: 1fr; }
            nav { padding: 1rem; }
            .nav-links { gap: 1rem; }
        }
    </style>
    @yield('styles')
</head>
<body>

<nav>
    <a href="{{ route('home') }}" class="nav-logo">Shop<span>Wave</span></a>
    <ul class="nav-links">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('products') }}">Products</a></li>
        <li>
            <a href="{{ route('cart.index') }}" class="nav-cart">
                🛒 Cart
                @if(session('cart') && count(session('cart')) > 0)
                <span class="cart-badge">{{ count(session('cart')) }}</span>
                @endif
            </a>
        </li>
    </ul>
</nav>

@if(session('success'))
<div class="alert alert-success">✅ {{ session('success') }}</div>
@endif
@if(session('error'))
<div class="alert alert-error">❌ {{ session('error') }}</div>
@endif

@yield('content')

<footer>
    <div class="footer-grid">
        <div>
            <div class="footer-logo">ShopWave</div>
            <p class="footer-desc">Your one-stop online shop for quality products at great prices. Fast delivery across the Philippines.</p>
        </div>
        <div>
            <div class="footer-heading">Shop</div>
            <ul class="footer-links">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('products') }}">All Products</a></li>
                <li><a href="{{ route('cart.index') }}">My Cart</a></li>
            </ul>
        </div>
        <div>
            <div class="footer-heading">Contact</div>
            <ul class="footer-links">
                <li><a href="#">shop@shopwave.com</a></li>
                <li><a href="#">+63 912 345 6789</a></li>
                <li><a href="#">Pangasinan, Philippines</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© 2026 ShopWave. Built with Laravel by Prince Edrian Casem.</p>
    </div>
</footer>

</body>
</html>