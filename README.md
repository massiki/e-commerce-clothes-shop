# E-Commerce Clothes Shop (Laravel)

Project ini adalah aplikasi **toko online sederhana** berbasis Laravel untuk katalog produk pakaian, keranjang belanja, checkout, dan manajemen order. Tersedia 2 peran utama: **User** (pembeli) dan **Admin** (pengelola).

## Gambaran Sistem

### Role / Akses
- **Guest (tanpa login)**
  - Melihat homepage & slider, daftar produk (`/shop`), detail produk (`/shop/{slug}`)
  - Lihat halaman cart & wishlist (tetapi aksi tambah/ubah memerlukan login)
  - Kirim pesan via halaman contact
- **User (login)**
  - Kelola cart (tambah produk, naik/turun qty, hapus item, kosongkan cart)
  - Apply / remove coupon
  - Checkout dan membuat order (saat ini: **COD**)
  - Lihat daftar order & detail order, serta cancel order (selama status masih `ordered`)
  - Kelola wishlist (tambah/hapus/kosongkan, pindahkan item ke cart)
- **Admin (login + `user.type === 'admin'`)**
  - Dashboard ringkasan order (jumlah dan total nilai berdasarkan status)
  - CRUD: Brand, Category, Product, Coupon, Slider
  - Manajemen order: lihat order, set **delivered** atau **cancelled**
  - Lihat & hapus pesan contact

### Alur Flow Sistem (High-Level)

#### 1) Browse Produk
1. Pengunjung membuka homepage (`/`) untuk melihat slider, kategori, dan rekomendasi produk.
2. Pengunjung membuka halaman shop (`/shop`) untuk melihat katalog.
3. Filter & sorting dilakukan via query param (contoh: `brand`, `category`, `sort`).
4. Pengunjung membuka detail produk (`/shop/{product:slug}`) dan melihat related products.

#### 2) Cart → Coupon → Checkout
1. User menambahkan produk ke cart (`POST /user/cart/add`).
2. User mengubah kuantitas (`PATCH /user/cart/increase` / `PATCH /user/cart/decrease`) atau menghapus item.
3. User dapat memasukkan coupon (`POST /user/apply-coupon`) yang disimpan ke session sebagai:
   - `coupon.code`, `coupon.type`, `coupon.value`, `coupon.discount`, `coupon.cart_total`, `coupon.final_total`
4. Saat membuka halaman checkout (`GET /user/checkout`), sistem memastikan cart **ada dan tidak kosong**.

#### 3) Checkout → Order → Transaction
1. User mengisi alamat pengiriman di halaman checkout.
2. Saat submit (`POST /user/checkout`), sistem:
   - Menyimpan/Update alamat (`Address::updateOrCreate`)
   - Jika payment method selain COD dipilih, akan mengembalikan respon “Fitur belum tersedia”
   - Untuk COD:
     - Hitung subtotal dari item cart
     - Ambil diskon dari session coupon (jika ada)
     - Buat `Order` dengan status `ordered`
     - Buat `OrderItem` untuk setiap item cart
     - Buat `Transaction` dengan `mode = cod` dan `status = pending`
     - Hapus item cart dan hapus cart
     - Hapus session coupon (opsional)
3. Setelah order dibuat, user diarahkan ke halaman konfirmasi order.

#### 4) After Sales (User & Admin)
- **User**
  - Melihat daftar order (`/user/orders`)
  - Melihat detail order (`/user/orders/{order}`)
  - Cancel order selama status masih `ordered`
- **Admin**
  - Menandai order sebagai `delivered` atau `cancelled` (tidak bisa jika status bukan `ordered`)

## Fitur Utama

### Fitur User (Frontend)
- **Auth**: login/register bawaan Laravel UI
- **Shop**
  - Listing produk dengan filter Brand/Category
  - Sorting: featured, best-selling (berdasarkan `quantity`), nama, harga efektif (sale/regular), terbaru/terlama
- **Product detail** + related products
- **Cart**
  - Add item, increase/decrease qty, remove item, clear cart
  - Perhitungan harga: `sale_price` fallback ke `regular_price`
- **Coupon**
  - Validasi expiry date dan minimum cart value
  - Diskon fixed atau percent
  - Disimpan ke session dan direkalkulasi saat isi cart berubah
- **Checkout & Order**
  - Simpan alamat (Address)
  - Order + order items + transaction (mode COD)
- **Wishlist**
  - Tambah/hapus/kosongkan wishlist
  - Pindahkan item dari wishlist ke cart
- **Search produk (AJAX)**
  - Endpoint `GET /search-product` mengembalikan JSON maksimal 5 produk berdasarkan nama
- **Contact form**
  - Simpan pesan contact ke database

### Fitur Admin (Backend)
- **Dashboard ringkasan order** (total order & total nilai berdasarkan status)
- **CRUD**:
  - Brand (upload image + slug unik)
  - Category (upload image + slug unik)
  - Product (featured, stock status, harga regular/sale, image + gallery)
  - Coupon (code unik, type percent/fixed, minimum cart value, expiry)
  - Slider (image + link + text)
- **Order management**
  - Lihat daftar & detail order
  - Aksi deliver/cancel
- **Contact messages**
  - Lihat dan hapus pesan

## Struktur Data (Entitas Utama)
- **User**: punya `address`, `orders`, `transactions`, `wishlists`
- **Product**: terkait `brand`, `category`, punya `wishlists`
- **Cart** → **CartItem**
- **Order** → **OrderItem** → **Transaction**
- **Coupon**: dipakai via session (bukan relation langsung)
- **Contact**: pesan masuk dari halaman contact
- **Slider**: banner homepage

## Teknologi
- **Backend**: PHP ^8.3, Laravel ^13, Laravel UI
- **Frontend tooling**: Vite + Tailwind (devDependencies)
- **Database default**: SQLite (lihat `.env.example`)
- **Session / Cache**: database (lihat `.env.example`)

## Cara Menjalankan (Local)

### Prasyarat
- PHP 8.3+
- Composer
- Node.js & npm

### Setup cepat
Project sudah menyediakan script composer `setup`:

```bash
composer run setup
```

Lalu jalankan mode dev:

```bash
composer run dev
```

> Catatan: `.env.example` default memakai SQLite. Jika ingin MySQL, ubah `DB_CONNECTION` dan kredensialnya.

## Kelebihan
- **Flow user lengkap** untuk e-commerce basic: shop → cart → coupon → checkout → order.
- **Admin panel** untuk mengelola katalog (brand/category/product) dan promo (coupon), serta order management.
- **Slug unik otomatis** untuk produk/brand/category.
- **Upload gambar** tersentral lewat storage `public` untuk produk, kategori, brand, slider.
- **Perhitungan coupon** sudah mempertimbangkan expiry date + minimum cart value, dan direkalkulasi saat cart berubah.

## Kekurangan / Catatan Teknis (Yang Bisa Ditingkatkan)
- **Payment gateway belum diimplementasikan**: selain COD akan mengembalikan “Fitur belum tersedia”.
- **Tipe kolom tanggal order**: pada migration `orders`, `delivered_date` dan `cancelled_date` bertipe `date` (tanpa jam). Jika butuh format `YYYY-MM-DD HH:MM:SS`, sebaiknya gunakan `dateTime`/`timestamp`.
- **Wishlist `firstOrCreate`** saat ini hanya mengecek `product_id` (bukan kombinasi `user_id + product_id`), sehingga ada potensi wishlist “bentrok” antar user jika product yang sama.
- **Relasi `User::cart()`** didefinisikan sebagai `belongsTo`, padahal pola data cart umumnya `hasOne`/`hasMany` dari user.
- **Stock/best-selling**: sorting “best-selling” saat ini menggunakan `orderBy('quantity','asc')` (lebih mirip “stok paling sedikit”), bukan berdasarkan data penjualan.
- **Shipping/VAT** masih hard-coded (0 / free shipping) dan belum ada kalkulasi ongkir/ppn sesungguhnya.

## Lisensi
Mengikuti lisensi default Laravel (MIT) kecuali dinyatakan lain pada aset pihak ketiga.