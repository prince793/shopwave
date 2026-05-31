@extends('layout')

@section('title', 'My Cart - ShopWave')

@section('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, #1A56A0, #3B7DD8);
        color: #fff; padding: 3rem 0; text-align: center;
    }
    .page-header h1 { font-size: 2rem; font-weight: 600; margin-bottom: 0.5rem; }

    .cart-section { padding: 3rem 0; }
    .cart-layout { display: grid; grid-template-columns: 1fr 340px; gap: 2rem; }

    .cart-card { background: var(--card); border: 1px solid var(--border); border-radius: 12px; overflow: hidden; }
    .cart-header { padding: 1rem 1.5rem; border-bottom: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center; }
    .cart-header h2 { font-size: 1rem; font-weight: 600; }

    .cart-item { display: flex; gap: 1rem; padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--border); align-items: center; }
    .cart-item:last-child { border-bottom: none; }
    .cart-item-img { width: 80px; height: 80px; border-radius: 8px; object-fit: cover; flex-shrink: 0; background: var(--blue-light); display: flex; align-items: center; justify-content: center; font-size: 2rem; overflow: hidden; }
    .cart-item-img img { width: 100%; height: 100%; object-fit: cover; }
    .cart-item-info { flex: 1; }
    .cart-item-name { font-size: 0.9rem; font-weight: 600; margin-bottom: 0.25rem; }
    .cart-item-price { font-size: 0.875rem; color: var(--blue); font-weight: 500; }
    .cart-item-actions { display: flex; align-items: center; gap: 0.75rem; }
    .qty-form { display: flex; align-items: center; gap: 0.5rem; }
    .qty-field { width: 60px; border: 1px solid var(--border); border-radius: 6px; padding: 0.35rem 0.5rem; font-size: 0.875rem; text-align: center; font-family: 'DM Sans', sans-serif; outline: none; }
    .qty-btn { background: var(--blue-light); border: none; border-radius: 6px; padding: 0.35rem 0.6rem; font-size: 0.8rem; cursor: pointer; color: var(--blue); font-weight: 600; }
    .remove-btn { background: transparent; border: none; color: #dc2626; cursor: pointer; font-size: 0.8rem; padding: 0.25rem 0.5rem; border-radius: 6px; transition: background 0.2s; }
    .remove-btn:hover { background: #fee2e2; }
    .item-subtotal { font-size: 0.9rem; font-weight: 600; color: var(--text); min-width: 80px; text-align: right; }

    .summary-card { background: var(--card); border: 1px solid var(--border); border-radius: 12px; padding: 1.5rem; height: fit-content; }
    .summary-card h2 { font-size: 1rem; font-weight: 600; margin-bottom: 1.25rem; }
    .summary-row { display: flex; justify-content: space-between; font-size: 0.875rem; margin-bottom: 0.75rem; }
    .summary-row.total { font-size: 1rem; font-weight: 600; border-top: 1px solid var(--border); padding-top: 0.75rem; margin-top: 0.75rem; color: var(--blue); }
    .checkout-btn { width: 100%; background: var(--blue); color: #fff; border: none; border-radius: 10px; padding: 0.875rem; font-size: 1rem; font-weight: 500; cursor: pointer; font-family: 'DM Sans', sans-serif; transition: background 0.2s; text-decoration: none; display: block; text-align: center; margin-top: 1rem; }
    .checkout-btn:hover { background: var(--blue-mid); }

    .empty-cart { text-align: center; padding: 4rem 2rem; }
    .empty-cart p:first-child { font-size: 4rem; margin-bottom: 1rem; }
    .empty-cart h2 { font-size: 1.3rem; font-weight: 600; margin-bottom: 0.5rem; }
    .empty-cart p { color: var(--text-muted); margin-bottom: 1.5rem; }

    @media(max-width:768px) { .cart-layout { grid-template-columns: 1fr; } }
</style>
@endsection

@section('content')
<div class="page-header">
    <div class="container">
        <h1>🛒 My Cart</h1>
        <p>{{ count($cart) }} item(s) in your cart</p>
    </div>
</div>

<section class="cart-section">
    <div class="container">
        @if(count($cart) > 0)
        <div class="cart-layout">
            <div>
                <div class="cart-card">
                    <div class="cart-header">
                        <h2>Cart Items</h2>
                        <form method="POST" action="{{ route('cart.clear') }}">
                            @csrf @method('DELETE')
                            <button type="submit" class="remove-btn" onclick="return confirm('Clear entire cart?')">🗑 Clear All</button>
                        </form>
                    </div>
                    @foreach($cart as $id => $item)
                    <div class="cart-item">
                        <div class="cart-item-img">
                            @if($item['image'])
                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}"/>
                            @else
                            📦
                            @endif
                        </div>
                        <div class="cart-item-info">
                            <div class="cart-item-name">{{ $item['name'] }}</div>
                            <div class="cart-item-price">₱{{ number_format($item['price'], 2) }} each</div>
                        </div>
                        <div class="cart-item-actions">
                            <form class="qty-form" method="POST" action="{{ route('cart.update', $id) }}">
                                @csrf @method('PATCH')
                                <input class="qty-field" type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="99"/>
                                <button type="submit" class="qty-btn">↻</button>
                            </form>
                            <form method="POST" action="{{ route('cart.remove', $id) }}">
                                @csrf @method('DELETE')
                                <button type="submit" class="remove-btn">✕ Remove</button>
                            </form>
                        </div>
                        <div class="item-subtotal">₱{{ number_format($item['price'] * $item['quantity'], 2) }}</div>
                    </div>
                    @endforeach
                </div>
                <div style="margin-top:1rem;">
                    <a href="{{ route('products') }}" class="btn btn-outline">← Continue Shopping</a>
                </div>
            </div>

            <div>
                <div class="summary-card">
                    <h2>Order Summary</h2>
                    @foreach($cart as $item)
                    <div class="summary-row">
                        <span>{{ $item['name'] }} x{{ $item['quantity'] }}</span>
                        <span>₱{{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                    </div>
                    @endforeach
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span>₱{{ number_format($total, 2) }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Shipping</span>
                        <span>{{ $total >= 999 ? 'FREE' : '₱100.00' }}</span>
                    </div>
                    <div class="summary-row total">
                        <span>Total</span>
                        <span>₱{{ number_format($total + ($total >= 999 ? 0 : 100), 2) }}</span>
                    </div>
                    <a href="{{ route('checkout.index') }}" class="checkout-btn">Proceed to Checkout →</a>
                    @if($total < 999)
                    <p style="font-size:0.78rem;color:var(--text-muted);text-align:center;margin-top:0.75rem;">
                        Add ₱{{ number_format(999 - $total, 2) }} more for free shipping!
                    </p>
                    @endif
                </div>
            </div>
        </div>
        @else
        <div class="empty-cart">
            <p>🛒</p>
            <h2>Your cart is empty</h2>
            <p>Looks like you haven't added anything yet.</p>
            <a href="{{ route('products') }}" class="btn btn-primary">Start Shopping</a>
        </div>
        @endif
    </div>
</section>
@endsection