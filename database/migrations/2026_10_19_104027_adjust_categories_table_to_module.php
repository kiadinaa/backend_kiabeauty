
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Lepaskan foreign key terlebih dahulu
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });

        // Ubah nama kolom kategori
        Schema::table('categories', function (Blueprint $table) {
            $table->renameColumn('id', 'category_id');
            $table->renameColumn('name', 'category');
        });
    }

    public function down(): void
    {
        // Kembalikan nama kolom kategori
        Schema::table('categories', function (Blueprint $table) {
            $table->renameColumn('category_id', 'id');
            $table->renameColumn('category', 'name');
        });

        // Kembalikan foreign key
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->cascadeOnDelete();
        });
    }
};
