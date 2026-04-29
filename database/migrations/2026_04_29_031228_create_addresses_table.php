<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('name');
            $table->string('phone');
            $table->string('province');       // Provinsi
            $table->string('city');           // Kota / Kabupaten
            $table->string('district');       // Kecamatan
            $table->string('subdistrict');    // Kelurahan / Desa
            $table->string('postal_code');    // Kode Pos
            $table->text('full_address');     // Jalan lengkap, nomor rumah
            $table->string('address_note')
                ->nullable();                 // Contoh: rumah pagar hitam dekat Indomaret
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
