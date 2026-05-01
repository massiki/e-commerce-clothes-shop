@extends('layouts.app')

@section('content')
  <main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="contact-us container">
      <div class="mw-930">
        <h2 class="page-title">Tentang Website</h2>
      </div>

      <div class="about-us__content pb-5 mb-5">
        <div class="mw-930">
          <h3 class="mb-4">Ringkasan</h3>
          <p class="fs-6 fw-medium mb-4">
            Website ini adalah aplikasi <strong>toko online sederhana</strong> berbasis Laravel untuk katalog produk
            pakaian,
            keranjang belanja, checkout, dan manajemen order. Terdapat 2 peran utama: <strong>User</strong> (pembeli) dan
            <strong>Admin</strong> (pengelola).
          </p>

          <h4 class="mb-3">Alur Penggunaan Singkat</h4>
          <ul class="mb-4">
            <li>Browse produk di halaman Shop, lalu buka detail produk.</li>
            <li>Tambahkan produk ke Cart dan atur kuantitas.</li>
            <li>Opsional: gunakan Coupon untuk mendapatkan diskon.</li>
            <li>Checkout dengan mengisi alamat pengiriman.</li>
            <li>Buat Order (saat ini pembayaran yang aktif: <strong>COD</strong>).</li>
          </ul>

          <h4 class="mb-3">Fitur Utama</h4>
          <div class="row mb-3">
            <div class="col-md-6">
              <h5 class="mb-3">Fitur User</h5>
              <ul class="mb-3">
                <li>Katalog produk + filter Brand/Category + sorting.</li>
                <li>Cart: add item, increase/decrease qty, hapus item, kosongkan cart.</li>
                <li>Wishlist: simpan produk dan pindahkan ke cart.</li>
                <li>Coupon: diskon fixed/percent (disimpan pada session).</li>
                <li>Checkout + pembuatan order + halaman konfirmasi.</li>
                <li>Riwayat order dan cancel order (selama status masih <code>ordered</code>).</li>
                <li>Search produk (AJAX) dan Contact form.</li>
              </ul>
            </div>
            <div class="col-md-6">
              <h5 class="mb-3">Fitur Admin</h5>
              <ul class="mb-3">
                <li>Dashboard ringkasan order.</li>
                <li>CRUD: Brand, Category, Product, Coupon, Slider.</li>
                <li>Order management: deliver / cancel.</li>
                <li>Kelola pesan contact.</li>
              </ul>
            </div>
          </div>
          <h4 class="mb-3">Teknologi</h4>
          <ul class="mb-4">
            <li>Backend: PHP 8.3+, Laravel 13 + Laravel UI (auth).</li>
            <li>Frontend tooling: Vite + Tailwind (dev).</li>
            <li>Database default: SQLite (bisa diganti MySQL via <code>.env</code>).</li>
          </ul>
        </div>
        <div class="mw-930 d-lg-flex align-items-lg-center">
          <div class="content-wrapper">
            <h5 class="mb-3">Catatan</h5>
            <p class="mb-3">
              Project ini dibuat sebagai implementasi e-commerce basic. Beberapa fitur lanjutan seperti payment gateway
              (selain COD), kalkulasi ongkir, dan pajak dinamis masih bisa dikembangkan lebih lanjut.
            </p>
          </div>
        </div>
      </div>
    </section>


  </main>
@endsection
