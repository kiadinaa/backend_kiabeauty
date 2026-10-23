
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Sesuaikan panjang nama kategori
        Schema::table('categories', function (Blueprint $table) {
            $table->string('category', 100)->change();
        });

        // Sesuaikan nama produk dan tipe data harga
        Schema::table('products', function (Blueprint $table) {
            $table->string('name', 150)->change();
            $table->decimal('price', 12, 2)->change();
        });
    }

    public function down(): void
    {
        // Kembalikan struktur kategori seperti sebelumnya
        Schema::table('categories', function (Blueprint $table) {
            $table->string('category', 255)->change();
        });

        // Kembalikan struktur produk seperti sebelumnya
        Schema::table('products', function (Blueprint $table) {
            $table->string('name', 255)->change();
            $table->decimal('price', 10, 2)->change();
        });
    }
};
