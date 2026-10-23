<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        $products = Product::all();

        $reviews = [
            [
                'rating' => 5,
                'comment' => 'Bagus banget! Teksturnya nyaman, cepat meresap, dan kulit langsung terasa glowing lembap seharian. Pasti repurchase!',
                'user_name' => 'Kiara Cantika',
            ],
            [
                'rating' => 5,
                'comment' => 'Suka banget sama formulanya yang gentle. Gak bikin perih di muka dan jerawatku jadi cepet kempes.',
                'user_name' => 'Dinda Putri',
            ],
            [
                'rating' => 4,
                'comment' => 'Pengemasan rapi dan aman pakai bubble wrap tebal. Produk original, wanginya enak dan menenangkan.',
                'user_name' => 'Anisa Rahmawati',
            ],
        ];

        foreach ($products as $product) {
            if ($product->reviews()->count() === 0) {
                foreach ($reviews as $rev) {
                    Review::create([
                        'product_id' => $product->product_id,
                        'user_id' => $user?->id,
                        'user_name' => $rev['user_name'],
                        'rating' => $rev['rating'],
                        'comment' => $rev['comment'],
                    ]);
                }
            }
        }
    }
}
