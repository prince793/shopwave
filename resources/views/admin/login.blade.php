<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin Login - ShopWave</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'DM Sans', sans-serif; background: linear-gradient(135deg, #1A56A0, #3B7DD8); min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-card { background: #fff; border-radius: 16px; padding: 2.5rem; width: 100%; max-width: 400px; box-shadow: 0 20px 60px rgba(0,0,0,0.15); }
        .login-logo { text-align: center; font-size: 1.5rem; font-weight: 600; color: #1A56A0; margin-bottom: 0.25rem; }
        .login-sub { text-align: center; font-size: 0.85rem; color: #6B7280; margin-bottom: 2rem; }
        .form-group { margin-bottom: 1.25rem; }
        .form-group label { display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 0.4rem; }
        .form-group input { width: 100%; border: 1px solid #E5E7EB; border-radius: 8px; padding: 0.75rem 1rem; font-size: 0.9rem; font-family: 'DM Sans', sans-serif; outline: none; transition: border-color 0.2s; }
        .form-group input:focus { border-color: #1A56A0; }
        .error-msg { background: #fee2e2; color: #dc2626; padding: 0.75rem 1rem; border-radius: 8px; font-size: 0.85rem; margin-bottom: 1rem; }
        .login-btn { width: 100%; background: #1A56A0; color: #fff; border: none; border-radius: 8px; padding: 0.875rem; font-size: 1rem; font-weight: 500; cursor: pointer; font-family: 'DM Sans', sans-serif; transition: background 0.2s; }
        .login-btn:hover { background: #3B7DD8; }
        .back-link { display: block; text-align: center; margin-top: 1.25rem; font-size: 0.85rem; color: #6B7280; text-decoration: none; }
        .back-link:hover { color: #1A56A0; }
    </style>
</head>
<body>
<div class="login-card">
    <div class="login-logo">ShopWave Admin</div>
    <div class="login-sub">Sign in to manage your store</div>
    @if($errors->any())
    <div class="error-msg">{{ $errors->first() }}</div>
    @endif
    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@sicasem.com" required/>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="••••••••" required/>
        </div>
        <button type="submit" class="login-btn">Sign In →</button>
    </form>
    <a href="{{ route('home') }}" class="back-link">← Back to store</a>
</div>
</body>
</html>