<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'category' => 'Makeup',
                'description' => 'Koleksi makeup lengkap: Cushion, Lip Cream, Lipstick, dan Powder.',
            ],
            [
                'category' => 'Skincare',
                'description' => 'Koleksi perawatan kulit: Cleanser, Toner, Serum, Moisturizer, dan Sunscreen.',
            ],
        ];

        foreach ($categories as $cat) {
            DB::table('categories')->updateOrInsert(
                ['category' => $cat['category']],
                [
                    'description' => $cat['description'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
