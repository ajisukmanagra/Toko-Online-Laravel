<h1 align="center">Selamat datang di Toko Online! 👋</h1>

## Apa itu Toko Online?

Web Toko Online yang dibuat oleh**Toko Online adalah Website penjualan secara online untuk seseorang yang inggin membeli suatu produk melalui website dengan mudah.**

## Fitur apa saja yang tersedia di Toko Online?

-   Autentikasi Admin
-   User & CRUD
-   Produk & CRUD
-   Produk & CRUD
-   Order & CRUD
-   Dan lain-lain

## Release Date

**Release date : 28 Apr 2020**

> Toko Online merupakan project open source yang dibuat oleh Adhi Ariyadi. Kalian dapat download/fork/clone. Cukup beri stars di project ini agar memberiku semangat. Terima kasih!

---

## Install

1. **Clone Repository**

```bash
git clone https://github.com/adhiariyadi/Toko-Online-Laravel.git
cd Toko-Online-Laravel
composer install
cp .env.example .env
```

2. **Buka `.env` lalu ubah baris berikut sesuai dengan databasemu yang ingin dipakai**

```bash
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

3. **Instalasi website**

```bash
php artisan key:generate
php artisan migrate --seed
```

4. **Jalankan website**

```bash
php artisan serve
