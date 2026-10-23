<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KiaBeautyFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_home_page_loads_with_products_and_discounts(): void
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertSeeText('KiaBeauty');
        $response->assertSeeText('Spesial Akhir Bulan');
        $response->assertSeeText('Diskon 15%');
        $response->assertSeeText('Produk Pilihan');
    }

    public function test_catalog_products_page_loads(): void
    {
        $response = $this->get(route('shop.index'));

        $response->assertStatus(200);
        $response->assertSeeText('Kategori Produk');
        $response->assertSeeText('Semua Kategori');
    }

    public function test_product_detail_page_loads_and_displays_rating(): void
    {
        $product = Product::first();
        $this->assertNotNull($product);

        $response = $this->get(route('shop.detail', $product->slug));

        $response->assertStatus(200);
        $response->assertSeeText($product->name);
        $response->assertSeeText('Customer Reviews');
    }

    public function test_can_add_product_to_cart_and_view_cart(): void
    {
        $product = Product::first();

        $response = $this->post(route('cart.add'), [
            'product_id' => $product->product_id,
            'quantity' => 2,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $cartResponse = $this->get(route('cart.index'));
        $cartResponse->assertStatus(200);
        $cartResponse->assertSee($product->name);
    }

    public function test_can_submit_review_and_rating(): void
    {
        $product = Product::first();

        $response = $this->post(route('reviews.store'), [
            'product_id' => $product->product_id,
            'rating' => 5,
            'user_name' => 'Budi Santoso',
            'comment' => 'Produk sangat berkualitas, packing rapi!',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('reviews', [
            'product_id' => $product->product_id,
            'user_name' => 'Budi Santoso',
            'rating' => 5,
        ]);
    }

    public function test_can_checkout_and_create_order(): void
    {
        $product = Product::first();

        // Add to cart
        $this->post(route('cart.add'), [
            'product_id' => $product->product_id,
            'quantity' => 1,
        ]);

        $response = $this->post(route('checkout.store'), [
            'customer_name' => 'Kiara Customer',
            'customer_phone' => '08123456789',
            'shipping_address' => 'Jl. Mawar No. 12, Sleman, Yogyakarta',
            'payment_method' => 'Transfer BCA',
            'notes' => 'Tolong kirim siang hari',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('orders', [
            'customer_name' => 'Kiara Customer',
            'payment_method' => 'Transfer BCA',
        ]);
    }

    public function test_can_view_order_history_daftar_belanja(): void
    {
        $user = User::first();
        $this->assertNotNull($user);

        $response = $this->actingAs($user)->get(route('orders.index'));

        $response->assertStatus(200);
        $response->assertSeeText('Daftar Belanja Saya');
    }

    public function test_user_can_login_and_logout(): void
    {
        $user = User::where('email', 'pelanggan@kiabeauty.com')->first();
        $this->assertNotNull($user);

        $response = $this->post(route('login'), [
            'email' => 'pelanggan@kiabeauty.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticatedAs($user);

        $logoutResponse = $this->post(route('logout'));
        $logoutResponse->assertRedirect(route('home'));
        $this->assertGuest();
    }
}
