<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function loginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        $totalOrders    = Order::count();
        $pendingOrders  = Order::where('status', 'pending')->count();
        $totalProducts  = Product::count();
        $totalCategories = Category::count();
        $totalRevenue   = Order::where('status', '!=', 'cancelled')->sum('total');
        $recentOrders   = Order::latest()->take(5)->get();
        return view('admin.dashboard', compact(
            'totalOrders', 'pendingOrders', 'totalProducts',
            'totalCategories', 'totalRevenue', 'recentOrders'
        ));
    }
}