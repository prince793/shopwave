<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) return redirect()->route('cart.index');
        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $shipping = 100;
        $total = $subtotal + $shipping;
        return view('checkout', compact('cart', 'subtotal', 'shipping', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email',
            'phone'          => 'required|string|max:20',
            'address'        => 'required|string',
            'city'           => 'required|string',
            'province'       => 'required|string',
            'zip'            => 'required|string|max:10',
            'payment_method' => 'required|in:cod,gcash',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) return redirect()->route('cart.index');

        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $shipping = 100;
        $total = $subtotal + $shipping;

        $order = Order::create([
            'order_number'   => 'ORD-' . strtoupper(uniqid()),
            'name'           => $request->name,
            'email'          => $request->email,
            'phone'          => $request->phone,
            'address'        => $request->address,
            'city'           => $request->city,
            'province'       => $request->province,
            'zip'            => $request->zip,
            'subtotal'       => $subtotal,
            'shipping'       => $shipping,
            'total'          => $total,
            'payment_method' => $request->payment_method,
            'notes'          => $request->notes,
        ]);

        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id'     => $order->id,
                'product_id'   => $productId,
                'product_name' => $item['name'],
                'price'        => $item['price'],
                'quantity'     => $item['quantity'],
                'subtotal'     => $item['price'] * $item['quantity'],
            ]);
        }

        session()->forget('cart');
        return redirect()->route('checkout.success', $order);
    }

    public function success(Order $order)
    {
        return view('checkout-success', compact('order'));
    }
}