
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah nama kolom ID produk
        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('id', 'product_id');
        });

        // Tambahkan kolom gambar dan slug
        Schema::table('products', function (Blueprint $table) {
            $table->string('img')->nullable();
            $table->string('slug')->nullable()->unique();
        });

        // Hubungkan produk dengan kategori
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('category_id')
                ->references('category_id')
                ->on('categories')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        // Lepaskan foreign key dan hapus kolom tambahan
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropUnique(['products_slug_unique']);
            $table->dropColumn(['img', 'slug']);
        });

        // Kembalikan nama ID produk
        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('product_id', 'id');
        });

        // Kembalikan foreign key
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('category_id')
                ->references('category_id')
                ->on('categories')
                ->cascadeOnDelete();
        });
    }
};
