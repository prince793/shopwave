@extends('layout')

@section('title', 'Checkout - ShopWave')

@section('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, #1A56A0, #3B7DD8);
        color: #fff; padding: 3rem 0; text-align: center;
    }
    .page-header h1 { font-size: 2rem; font-weight: 600; margin-bottom: 0.5rem; }

    .checkout-section { padding: 3rem 0; }
    .checkout-layout { display: grid; grid-template-columns: 1fr 360px; gap: 2rem; }

    .form-card { background: var(--card); border: 1px solid var(--border); border-radius: 12px; padding: 1.75rem; margin-bottom: 1.25rem; }
    .form-card h2 { font-size: 1rem; font-weight: 600; margin-bottom: 1.25rem; padding-bottom: 0.75rem; border-bottom: 1px solid var(--border); }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    .form-group { margin-bottom: 1rem; }
    .form-group label { display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 0.4rem; }
    .form-group input, .form-group select, .form-group textarea {
        width: 100%; border: 1px solid var(--border); border-radius: 8px;
        padding: 0.7rem 1rem; font-size: 0.9rem;
        font-family: 'DM Sans', sans-serif; outline: none;
        transition: border-color 0.2s; background: var(--bg);
    }
    .form-group input:focus, .form-group select:focus, .form-group textarea:focus { border-color: var(--blue); background: #fff; }
    .form-group textarea { resize: vertical; min-height: 80px; }
    .error { color: #dc2626; font-size: 0.8rem; margin-top: 0.3rem; }

    .payment-options { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    .payment-option { position: relative; }
    .payment-option input { position: absolute; opacity: 0; }
    .payment-label {
        display: block; border: 2px solid var(--border); border-radius: 10px;
        padding: 1rem; cursor: pointer; transition: all 0.2s; text-align: center;
    }
    .payment-option input:checked + .payment-label { border-color: var(--blue); background: var(--blue-light); }
    .payment-icon { font-size: 1.8rem; display: block; margin-bottom: 0.4rem; }
    .payment-name { font-size: 0.875rem; font-weight: 600; }
    .payment-desc { font-size: 0.75rem; color: var(--text-muted); }

    .order-summary { background: var(--card); border: 1px solid var(--border); border-radius: 12px; padding: 1.5rem; height: fit-content; position: sticky; top: 80px; }
    .order-summary h2 { font-size: 1rem; font-weight: 600; margin-bottom: 1.25rem; }
    .summary-item { display: flex; gap: 0.75rem; margin-bottom: 1rem; align-items: center; }
    .summary-item-img { width: 48px; height: 48px; border-radius: 6px; object-fit: cover; background: var(--blue-light); display: flex; align-items: center; justify-content: center; font-size: 1.2rem; overflow: hidden; flex-shrink: 0; }
    .summary-item-img img { width: 100%; height: 100%; object-fit: cover; }
    .summary-item-name { font-size: 0.85rem; font-weight: 500; flex: 1; }
    .summary-item-price { font-size: 0.85rem; font-weight: 600; color: var(--blue); }
    .summary-divider { border: none; border-top: 1px solid var(--border); margin: 1rem 0; }
    .summary-row { display: flex; justify-content: space-between; font-size: 0.875rem; margin-bottom: 0.6rem; }
    .summary-total { font-size: 1rem; font-weight: 600; color: var(--blue); border-top: 1px solid var(--border); padding-top: 0.75rem; margin-top: 0.5rem; display: flex; justify-content: space-between; }

    .place-order-btn {
        width: 100%; background: var(--blue); color: #fff;
        border: none; border-radius: 10px; padding: 1rem;
        font-size: 1rem; font-weight: 500; cursor: pointer;
        font-family: 'DM Sans', sans-serif; transition: background 0.2s;
        margin-top: 1.25rem;
    }
    .place-order-btn:hover { background: var(--blue-mid); }

    @media(max-width:768px) {
        .checkout-layout { grid-template-columns: 1fr; }
        .form-row { grid-template-columns: 1fr; }
        .payment-options { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <div class="container">
        <h1>Checkout</h1>
        <p>Complete your order below.</p>
    </div>
</div>

<section class="checkout-section">
    <div class="container">
        <form method="POST" action="{{ route('checkout.store') }}">
            @csrf
            <div class="checkout-layout">
                <div>
                    <!-- CONTACT INFO -->
                    <div class="form-card">
                        <h2>📋 Contact Information</h2>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Full Name *</label>
                                <input type="text" name="name" value="{{ old('name') }}" placeholder="Juan Dela Cruz"/>
                                @error('name')<div class="error">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label>Email Address *</label>
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="juan@email.com"/>
                                @error('email')<div class="error">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Phone Number *</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+63 912 345 6789"/>
                            @error('phone')<div class="error">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <!-- SHIPPING -->
                    <div class="form-card">
                        <h2>🚚 Shipping Address</h2>
                        <div class="form-group">
                            <label>Street Address *</label>
                            <input type="text" name="address" value="{{ old('address') }}" placeholder="123 Main Street, Barangay..."/>
                            @error('address')<div class="error">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>City / Municipality *</label>
                                <input type="text" name="city" value="{{ old('city') }}" placeholder="Dagupan City"/>
                                @error('city')<div class="error">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label>Province *</label>
                                <input type="text" name="province" value="{{ old('province') }}" placeholder="Pangasinan"/>
                                @error('province')<div class="error">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>ZIP Code *</label>
                            <input type="text" name="zip" value="{{ old('zip') }}" placeholder="2400"/>
                            @error('zip')<div class="error">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group">
                            <label>Order Notes (Optional)</label>
                            <textarea name="notes" placeholder="Special instructions for delivery...">{{ old('notes') }}</textarea>
                        </div>
                    </div>

                    <!-- PAYMENT -->
                    <div class="form-card">
                        <h2>💳 Payment Method</h2>
                        <div class="payment-options">
                            <div class="payment-option">
                                <input type="radio" name="payment_method" id="cod" value="cod" checked/>
                                <label class="payment-label" for="cod">
                                    <span class="payment-icon">💵</span>
                                    <div class="payment-name">Cash on Delivery</div>
                                    <div class="payment-desc">Pay when you receive</div>
                                </label>
                            </div>
                            <div class="payment-option">
                                <input type="radio" name="payment_method" id="paypal" value="paypal"/>
                                <label class="payment-label" for="paypal">
                                    <span class="payment-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 256 256" xml:space="preserve">
                                        <g transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                                            <path d="M 37.046 17.998 c -1.276 0.001 -2.363 0.93 -2.562 2.19 l -4.257 27 c 0.198 -1.261 1.285 -2.19 2.562 -2.19 h 12.475 c 12.555 0 23.208 -9.159 25.155 -21.57 c 0.145 -0.927 0.227 -1.862 0.246 -2.8 c -3.191 -1.673 -6.938 -2.63 -11.045 -2.63 L 37.046 17.998 z" style="fill:rgb(0,28,100);"/>
                                            <path d="M 70.663 20.629 c -0.019 0.938 -0.101 1.873 -0.246 2.8 c -1.947 12.411 -12.601 21.57 -25.155 21.57 H 32.789 c -1.276 0 -2.364 0.928 -2.562 2.19 l -3.914 24.811 L 23.86 87.564 c -0.183 1.148 0.6 2.227 1.748 2.41 C 25.718 89.991 25.829 90 25.94 90 h 13.54 c 1.276 -0.001 2.363 -0.93 2.562 -2.19 l 3.566 -22.621 c 0.2 -1.261 1.287 -2.19 2.564 -2.19 h 7.972 c 12.555 0 23.208 -9.159 25.155 -21.57 c 1.382 -8.809 -3.054 -16.824 -10.636 -20.799 L 70.663 20.629 z" style="fill:rgb(0,112,224);"/>
                                            <path d="M 21.663 0 c -1.276 0 -2.364 0.928 -2.562 2.188 L 8.476 69.564 c -0.201 1.279 0.787 2.436 2.082 2.436 h 15.756 l 3.912 -24.811 l 4.257 -27 c 0.2 -1.261 1.286 -2.189 2.562 -2.19 h 22.572 c 4.108 0 7.855 0.958 11.045 2.63 C 70.882 9.329 61.558 0 48.738 0 L 21.663 0 z" style="fill:rgb(0,48,135);"/>
                                        </g>
                                        </svg>
                                    </span>
                                    <div class="payment-name">PayPal</div>
                                    <div class="payment-desc">Pay via PayPal (Sandbox)</div>
                                </label>
                            </div>
                        </div>
                        @error('payment_method')<div class="error">{{ $message }}</div>@enderror
                        <div id="paypal-button-container" style="margin-top:1rem;display:none;"></div>
                    </div>
                </div>

                <!-- ORDER SUMMARY -->
                <div>
                    <div class="order-summary">
                        <h2>Order Summary</h2>
                        @foreach($cart as $id => $item)
                        <div class="summary-item">
                            <div class="summary-item-img">
                                @if($item['image'])
                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}"/>
                                @else
                                📦
                                @endif
                            </div>
                            <div class="summary-item-name">{{ $item['name'] }} x{{ $item['quantity'] }}</div>
                            <div class="summary-item-price">₱{{ number_format($item['price'] * $item['quantity'], 2) }}</div>
                        </div>
                        @endforeach
                        <hr class="summary-divider"/>
                        <div class="summary-row"><span>Subtotal</span><span>₱{{ number_format($subtotal, 2) }}</span></div>
                        <div class="summary-row"><span>Shipping</span><span>₱{{ number_format($shipping, 2) }}</span></div>
                        <div class="summary-total"><span>Total</span><span>₱{{ number_format($total, 2) }}</span></div>
                        <button type="submit" class="place-order-btn">✅ Place Order</button>
                        <p style="font-size:0.75rem;color:var(--text-muted);text-align:center;margin-top:0.75rem;">
                            By placing your order, you agree to our Terms & Conditions.
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://www.paypal.com/sdk/js?client-id=ATGpHluXkBy9QV5z2LBA4xXXJQIi8rinil87rFRwnNK-qkMg5I9lH9Rf-ThsdCs7pE8-u5o2fkUk6MQT&version=6&currency=USD"></script>
<script>
    var orderTotal = {{ $total }};

    document.getElementById('paypal').addEventListener('change', function() {
        document.getElementById('paypal-button-container').style.display = 'block';
        document.querySelector('.place-order-btn').style.display = 'none';
    });

    document.getElementById('cod').addEventListener('change', function() {
        document.getElementById('paypal-button-container').style.display = 'none';
        document.querySelector('.place-order-btn').style.display = 'block';
    });

    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: { value: orderTotal.toFixed(2) }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'paypal_order_id';
                input.value = data.orderID;
                document.querySelector('form').appendChild(input);
                document.querySelector('form').submit();
            });
        },
        onError: function(err) {
            alert('PayPal payment failed. Please try again.');
        }
    }).render('#paypal-button-container');
</script>
@endpush