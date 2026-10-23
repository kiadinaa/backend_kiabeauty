<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $makeupId = DB::table('categories')->where('category', 'Makeup')->value('category_id');
        $skincareId = DB::table('categories')->where('category', 'Skincare')->value('category_id');

        $products = [
            [
                'name' => 'Powerstay Sync Matte Cushion',
                'brand' => 'MAKE OVER',
                'slug' => 'make-over-powerstay-sync-matte-cushion',
                'price' => 239000,
                'discount_percent' => 15,
                'stock' => 8,
                'category_id' => $makeupId,
                'img' => 'images/products/makeover-cushion.jpg',
                'description' => 'Cushion matte dengan teknologi color-sync yang menyatu sempurna di kulit, menyamarkan pori dan ketidaksempurnaan hingga 24 jam.',
            ],
            [
                'name' => 'Colorfit 5D Blur Cloud Cushion',
                'brand' => 'WARDAH',
                'slug' => 'wardah-colorfit-5d-blur-cloud-cushion',
                'price' => 149000,
                'discount_percent' => 10,
                'stock' => 12,
                'category_id' => $makeupId,
                'img' => 'images/products/wardahcushion.jpg',
                'description' => 'Cushion ringan seringan awan dengan efek 5D blur untuk tampilan wajah halus bebas kilap tanpa rasa berat.',
            ],
            [
                'name' => 'Hooman Breathable Cushion Cover',
                'brand' => 'SOMETHINC',
                'slug' => 'somethinc-hooman-breathable-cushion',
                'price' => 208000,
                'discount_percent' => 20,
                'stock' => 5,
                'category_id' => $makeupId,
                'img' => 'images/products/somethinc-cushion.jpg',
                'description' => 'Cushion breathable dengan coverage medium-to-high yang tidak menyumbat pori, non-cakey, dan tahan air.',
            ],
            [
                'name' => 'Powerstay Transferproof Matte Lip Cream',
                'brand' => 'MAKE OVER',
                'slug' => 'make-over-powerstay-lip-cream',
                'price' => 143000,
                'discount_percent' => 15,
                'stock' => 4,
                'category_id' => $makeupId,
                'img' => 'images/products/makeover-lipcream.jpg',
                'description' => 'Lip cream transferproof yang tahan lama hingga 14 jam tanpa membuat bibir terasa kering atau pecah-pecah.',
            ],
            [
                'name' => 'Checkmatte Transferproof Lipstick',
                'brand' => 'SOMETHINC',
                'slug' => 'somethinc-checkmatte-lipstick',
                'price' => 109000,
                'discount_percent' => 0,
                'stock' => 9,
                'category_id' => $makeupId,
                'img' => 'images/products/somethinc-lipstick.jpg',
                'description' => 'Lipstick velvet transferproof dengan pigmentasi tinggi sekali oles dan sensasi lembut seperti sutra di bibir.',
            ],
            [
                'name' => 'Colorfit Perfect Glow Cushion',
                'brand' => 'WARDAH',
                'slug' => 'wardah-colorfit-perfect-glow-cushion',
                'price' => 150000,
                'discount_percent' => 15,
                'stock' => 7,
                'category_id' => $makeupId,
                'img' => 'images/products/wardah-glow-cushion.jpg',
                'description' => 'Cushion dengan radiant finish untuk tampilan kulit glowing sehat alami sepanjang hari tanpa rasa lengket.',
            ],
            [
                'name' => '5X Ceramide Barrier Repair Moisture Gel',
                'brand' => 'SKINTIFIC',
                'slug' => 'skintific-5x-ceramide-moisture-gel',
                'price' => 139000,
                'discount_percent' => 20,
                'stock' => 6,
                'category_id' => $skincareId,
                'img' => 'images/products/skintific-moisturizer-ceramide.jpg',
                'description' => 'Pelembap gel dengan 5 tipe Ceramide, Hyaluronic Acid, dan Centella Asiatica untuk memperbaiki skin barrier yang rusak.',
            ],
            [
                'name' => 'MSH Niacinamide Brightening Moisture Gel',
                'brand' => 'SKINTIFIC',
                'slug' => 'skintific-niacinamide-moisture-gel',
                'price' => 149000,
                'discount_percent' => 15,
                'stock' => 10,
                'category_id' => $skincareId,
                'img' => 'images/products/skintific-moisturizer-niacinamide.jpg',
                'description' => 'Krim gel pencerah dengan kombinasi MSH Niacinamide dan Alpha Arbutin untuk memudarkan noda hitam dalam 14 hari.',
            ],
            [
                'name' => 'Hydrasoothe Sunscreen Gel SPF45 PA++++',
                'brand' => 'AZARINE',
                'slug' => 'azarine-hydrasoothe-sunscreen',
                'price' => 59000,
                'discount_percent' => 10,
                'stock' => 3,
                'category_id' => $skincareId,
                'img' => 'images/products/azarine-sunscreen.jpg',
                'description' => 'Sunscreen gel dingin seringan air tanpa whitecast, mudah meresap, dan diperkaya royal jelly serta aloe vera.',
            ],
            [
                'name' => 'UV Shield Airy Smooth Sunscreen SPF50 PA++++',
                'brand' => 'WARDAH',
                'slug' => 'wardah-uv-shield-sunscreen',
                'price' => 99000,
                'discount_percent' => 15,
                'stock' => 11,
                'category_id' => $skincareId,
                'img' => 'images/products/wardah-sunscreen.jpg',
                'description' => 'Sunscreen finish powdery smooth bebas minyak dengan perlindungan optimal dari bahaya sinar UVA, UVB, dan blue light.',
            ],
            [
                'name' => 'Glass-C 12% Vitamin C + GlutaBright Serum',
                'brand' => 'SOMETHINC',
                'slug' => 'somethinc-glass-c-vitamin-c',
                'price' => 249000,
                'discount_percent' => 25,
                'stock' => 5,
                'category_id' => $skincareId,
                'img' => 'images/products/somethinc-vitc.jpg',
                'description' => 'Serum Vitamin C stabil 12% dan Glutathione untuk mencerahkan kulit kusam, meratakan warna kulit, dan menolak radikal bebas.',
            ],
            [
                'name' => 'Low pH Gentle Jelly Cleanser',
                'brand' => 'SOMETHINC',
                'slug' => 'somethinc-low-ph-jelly-cleanser',
                'price' => 62000,
                'discount_percent' => 0,
                'stock' => 14,
                'category_id' => $skincareId,
                'img' => 'images/products/somethinc-cleanser.jpg',
                'description' => 'Pembersih wajah bertekstur jelly lembut ber-pH seimbang (5-6) yang membersihkan debu polusi tanpa membuat kulit ketarik.',
            ],
        ];

        // Kosongkan produk lama agar database sinkron 100% dengan ReactBasic
        Schema::disableForeignKeyConstraints();
        DB::table('reviews')->truncate();
        DB::table('order_items')->truncate();
        DB::table('orders')->truncate();
        DB::table('products')->truncate();
        Schema::enableForeignKeyConstraints();

        foreach ($products as $p) {
            DB::table('products')->insert([
                'name' => $p['name'],
                'brand' => $p['brand'],
                'slug' => $p['slug'],
                'category_id' => $p['category_id'],
                'price' => $p['price'],
                'discount_percent' => $p['discount_percent'],
                'stock' => $p['stock'],
                'img' => $p['img'],
                'description' => $p['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
