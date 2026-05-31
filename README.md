# 🌊 ShopWave — E-Commerce Store

[![Laravel Version](https://shields.io)](https://laravel.com)
[![PHP Version](https://shields.io)](https://php.net)
[![Vite](https://shields.io)](https://vite.dev)

A full-stack e-commerce platform built to simulate a complete online shopping lifecycle. Features standard consumer workflows alongside an analytical administrator management matrix.

---

## ✨ Features

### 🛒 Customer Experience
* **Interactive Storefront:** Dynamic hero section, multi-tier product category landing spots, and featured items module.
* **Granular Browsing:** Fast sorting controls, dynamic keyword query searches, and targeted category filtering.
* **State-Managed Cart:** Real-time arithmetic subtotal updates upon adding, mutating, or removing store items.
* **Localized Checkout:** Native checkout form workflows engineered for Cash on Delivery (COD) and GCash simulations.

### 📊 Admin Infrastructure
* **Analytical Matrix:** Centralized dashboard compiling total order volume metrics, revenue flow, and structural aggregates.
* **Order Tracking Pipeline:** State-controlled tracking flow transitioning orders dynamically (`Pending` ➡️ `Processing` ➡️ `Shipped` ➡️ `Delivered`).
* **Inventory Control Suite:** Complete product payload management handling image mapping assets, pricing indexes, stock variations, and promotional flags.

---

## 🛠 Architecture & Tech Stack

* **Backend Matrix:** PHP 8.2, Laravel 12 (MVC Architecture)
* **Frontend Layer:** Blade Templates, Semantic HTML5, CSS3, JavaScript (ES6+)
* **Database Engine:** MySQL
* **Build System:** Vite, Composer, NPM

---

## ⚙️ Installation & Infrastructure Simulation

Follow these steps to spin up the application structure locally:

1. **Clone the repository:**
   ```bash
   git clone https://github.com/prince793/shopwave.git
   cd shopwave
   ```

2. **Install core ecosystems:**
   ```bash
   composer install
   npm install && npm run build
   ```

3. **Establish Environment Keys:**
   ```bash
   cp .env.example .env
   php artisan key_generate
   ```

4. **Database Parameter Assignment:**
   * Configure your local instance variables inside your `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=shopwave
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Execute Schema Migration & Seeding:**
   ```bash
   php artisan migrate --seed
   ```

6. **Seed Administrative User Instance:**
   ```bash
   php artisan tinker --execute="\App\Models\User::create(['name' => 'Admin', 'email' => 'admin@shopwave.com', 'password' => bcrypt('admin123'), 'email_verified_at' => now()]);"
   ```

7. **Launch Runtime Local Server:**
   ```bash
   php artisan serve
   ```
   *Access the site application locally via `http://localhost:8000`*

---

## 👤 Sandbox Identity Profile

* **Gateway Route:** `http://localhost:8000/admin/login`
* **Sandbox Email:** `admin@shopwave.com`
* **Sandbox Password:** `admin123`

---

## 📁 Project Directory Mapping

```text
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
```

---

## 🗄️ Entity Relationship Database Schema

* `users` — Core security administrative identity profiles.
* `categories` — Structured taxonomies organizing catalog variants.
* `products` — Inventory metrics tracking unique unit valuations and stock quantities.
* `orders` — Consumer fulfillment data mapped with shipping properties.
* `order_items` — Single relational transactional break-downs tracking line items.

---

## 🗺️ Engineering Development Roadmap

- [ ] Customer account authentication engines (Signup/Login)
- [ ] Historical user order tracking summary logs
- [ ] Multi-part native server-side image asset uploading
- [ ] External production sandbox Payment Gateway implementation
- [ ] Item specific rating index scores and text reviews
- [ ] Relational coupon code deduction logic engines

---

## 👨‍💻 Developer Profile

**Prince Edrian P. Casem**  
*3rd-year BSIT Student — University of Eastern Pangasinan*

* 📧 **Email:** princeedriancasem@gmail.com
* 🔗 **LinkedIn: https://www.linkedin.com/in/casem-prince-edrian-p-9408b3294?utm_source=share_via&utm_content=profile&utm_medium=member_android


---

## 📄 Licensing

This architecture is open-source distribution software under the [MIT License](LICENSE).
