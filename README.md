# ShopWave — E-Commerce Store

A full-stack e-commerce web application built with Laravel 12, PHP, and MySQL. Features a complete online shopping experience with product management, shopping cart, checkout system, and an admin dashboard.

## 🚀 Live Demo

> Run locally using the installation steps below.

## ✨ Features

### Customer Side
- 🏠 **Homepage** — Hero section, featured products, categories, new arrivals, and store features
- 🛍️ **Product Listing** — Browse all products with category filter, search, and sort
- 📦 **Product Detail** — Full product info, stock status, quantity selector, related products
- 🛒 **Shopping Cart** — Add, update, remove items with real-time subtotal calculation
- 💳 **Checkout** — Complete order form with COD and GCash payment options
- ✅ **Order Confirmation** — Order summary page with order number after successful purchase

### Admin Side
- 🔐 **Secure Login** — Admin authentication system
- 📊 **Dashboard** — Overview of total orders, revenue, products, and categories
- 📦 **Order Management** — View all orders, update status (pending → processing → shipped → delivered)
- 🛍️ **Product Management** — Add, edit, delete products with image URL, pricing, stock, and featured toggle
- 🗂️ **Category Management** — Add, edit, delete product categories

## 🛠️ Tech Stack

- **Backend:** PHP 8.2, Laravel 12
- **Frontend:** Blade Templates, HTML, CSS, JavaScript
- **Database:** MySQL
- **Tools:** Composer, NPM, Vite, Git

## ⚙️ Installation

1. **Clone the repository**
```bash
   git clone https://github.com/prince793/shopwave.git
   cd shopwave
```

2. **Install dependencies**
```bash
   composer install
   npm install && npm run build
```

3. **Environment setup**
```bash
   cp .env.example .env
   php artisan key:generate
```

4. **Configure database** in `.env`

DB_DATABASE=shopwave
DB_USERNAME=root
DB_PASSWORD=

## 🚀 Live Demo

> Run locally using the installation steps below.

## ✨ Features

### Customer Side
- 🏠 **Homepage** — Hero section, featured products, categories, new arrivals, and store features
- 🛍️ **Product Listing** — Browse all products with category filter, search, and sort
- 📦 **Product Detail** — Full product info, stock status, quantity selector, related products
- 🛒 **Shopping Cart** — Add, update, remove items with real-time subtotal calculation
- 💳 **Checkout** — Complete order form with COD and GCash payment options
- ✅ **Order Confirmation** — Order summary page with order number after successful purchase

### Admin Side
- 🔐 **Secure Login** — Admin authentication system
- 📊 **Dashboard** — Overview of total orders, revenue, products, and categories
- 📦 **Order Management** — View all orders, update status (pending → processing → shipped → delivered)
- 🛍️ **Product Management** — Add, edit, delete products with image URL, pricing, stock, and featured toggle
- 🗂️ **Category Management** — Add, edit, delete product categories

## 🛠️ Tech Stack

- **Backend:** PHP 8.2, Laravel 12
- **Frontend:** Blade Templates, HTML, CSS, JavaScript
- **Database:** MySQL
- **Tools:** Composer, NPM, Vite, Git

## ⚙️ Installation

1. **Clone the repository**
```bash
   git clone https://github.com/prince793/shopwave.git
   cd shopwave
```

2. **Install dependencies**
```bash
   composer install
   npm install && npm run build
```

3. **Environment setup**
```bash
   cp .env.example .env
   php artisan key:generate
```

4. **Configure database** in `.env`

5. **Run migrations and seed data**
```bash
   php artisan migrate
   php artisan db:seed
```

6. **Create admin user**
```bash
   php artisan tinker
   \App\Models\User::create(['name' => 'Admin', 'email' => 'admin@shopwave.com', 'password' => bcrypt('admin123'), 'email_verified_at' => now()]);
```

7. **Start the server**
```bash
   php artisan serve
```

8. **Visit** `http://localhost:8000`

## 👤 Admin Access

- **URL:** `/admin/login`
- **Email:** `admin@shopwave.com`
- **Password:** `admin123`

## 📁 Project Structure

shopwave/
├── app/
│   ├── Http/Controllers/
│   │   ├── HomeController.php
│   │   ├── ProductController.php
│   │   ├── CartController.php
│   │   ├── CheckoutController.php
│   │   └── Admin/
│   │       ├── AdminController.php
│   │       ├── ProductAdminController.php
│   │       ├── OrderAdminController.php
│   │       └── CategoryAdminController.php
│   └── Models/
│       ├── Product.php
│       ├── Category.php
│       ├── Order.php
│       └── OrderItem.php
├── resources/views/
│   ├── layout.blade.php
│   ├── home.blade.php
│   ├── products.blade.php
│   ├── product-detail.blade.php
│   ├── cart.blade.php
│   ├── checkout.blade.php
│   ├── checkout-success.blade.php
│   └── admin/
│       ├── login.blade.php
│       ├── dashboard.blade.php
│       ├── orders/
│       ├── products/
│       └── categories/
└── routes/
└── web.php

## 🗄️ Database Schema

- **users** — Admin accounts
- **categories** — Product categories
- **products** — Store products with pricing and stock
- **orders** — Customer orders with shipping details
- **order_items** — Individual items per order

## 📸 Screenshots

### Homepage
![Homepage](https://via.placeholder.com/800x400?text=ShopWave+Homepage)

### Admin Dashboard
![Admin Dashboard](https://via.placeholder.com/800x400?text=Admin+Dashboard)

## 🗺️ Roadmap

- [ ] User registration and login
- [ ] Order history for customers
- [ ] Product image upload
- [ ] Payment gateway integration
- [ ] Product reviews and ratings
- [ ] Coupon/discount system

## 👨‍💻 Developer

**Prince Edrian P. Casem**
3rd-year BSIT Student — University of Eastern Pangasinan
📧 princeedriancasem@gmail.com
🔗 [LinkedIn](https://linkedin.com/in/casem-princeedrian-p-9408b3294)
🐙 [GitHub](https://github.com/prince793)

## 📄 License

This project is open source and available under the [MIT License](LICENSE).