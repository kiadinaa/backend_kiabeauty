<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ApiModuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_user_registration(): void
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Agus Seputra',
            'email' => 'agus@example.com',
            'password' => 'secret123',
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'message' => 'Register success',
                'user' => [
                    'name' => 'Agus Seputra',
                    'email' => 'agus@example.com',
                ],
            ]);

        $this->assertDatabaseHas('users', ['email' => 'agus@example.com']);
    }

    public function test_api_user_login_success_and_failure(): void
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => bcrypt('password123'),
        ]);

        // Failed login
        $failResponse = $this->postJson('/api/login', [
            'email' => 'user@example.com',
            'password' => 'wrongpassword',
        ]);
        $failResponse->assertStatus(422)
            ->assertJsonValidationErrors(['email']);

        // Successful login
        $successResponse = $this->postJson('/api/login', [
            'email' => 'user@example.com',
            'password' => 'password123',
        ]);

        $successResponse->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'token',
                'token_type',
            ])
            ->assertJson([
                'message' => 'Login success',
                'token_type' => 'Bearer',
            ]);
    }

    public function test_products_endpoint_requires_sanctum_auth(): void
    {
        $response = $this->getJson('/api/products');
        $response->assertStatus(401);
    }

    public function test_authenticated_user_can_list_and_get_products(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $category = Category::create(['category' => 'Skincare']);
        $product = Product::create([
            'name' => 'Glow Serum',
            'slug' => 'glow-serum',
            'description' => 'Serum pencerah wajah',
            'category_id' => $category->category_id,
            'price' => 125000,
            'stock' => 15,
            'img' => null,
        ]);

        $response = $this->withHeader('Authorization', 'Bearer '.$token)
            ->getJson('/api/products');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'slug',
                        'description',
                        'price',
                        'stock',
                        'img_url',
                        'category' => ['id', 'name'],
                        'created_at',
                        'updated_at',
                    ],
                ],
            ]);

        $showResponse = $this->withHeader('Authorization', 'Bearer '.$token)
            ->getJson('/api/products/'.$product->product_id);

        $showResponse->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $product->product_id,
                    'name' => 'Glow Serum',
                    'slug' => 'glow-serum',
                    'price' => 125000,
                    'stock' => 15,
                    'category' => [
                        'id' => $category->category_id,
                        'name' => 'Skincare',
                    ],
                ],
            ]);
    }

    public function test_authenticated_user_can_store_product_with_image_upload(): void
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;
        $category = Category::create(['category' => 'Makeup']);

        $image = UploadedFile::fake()->image('lipcream.png', 400, 400);

        $response = $this->withHeader('Authorization', 'Bearer '.$token)
            ->postJson('/api/products', [
                'name' => 'Velvet Lip Cream',
                'description' => 'Lip cream lembut matte',
                'category_id' => $category->category_id,
                'price' => 85000,
                'stock' => 25,
                'img' => $image,
            ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'slug',
                    'price',
                    'stock',
                    'img_url',
                    'category',
                ],
            ]);

        $created = Product::where('name', 'Velvet Lip Cream')->first();
        $this->assertNotNull($created);
        $this->assertEquals('velvet-lip-cream', $created->slug);
        $this->assertNotNull($created->img);
        Storage::disk('public')->assertExists($created->img);
    }

    public function test_authenticated_user_can_update_product(): void
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;
        $category = Category::create(['category' => 'Skincare']);

        $product = Product::create([
            'name' => 'Sunscreen SPF 50',
            'slug' => 'sunscreen-spf-50',
            'category_id' => $category->category_id,
            'price' => 95000,
            'stock' => 20,
        ]);

        $response = $this->withHeader('Authorization', 'Bearer '.$token)
            ->putJson('/api/products/'.$product->product_id, [
                'name' => 'Sunscreen SPF 50 Plus',
                'category_id' => $category->category_id,
                'price' => 99000,
                'stock' => 30,
            ]);

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'name' => 'Sunscreen SPF 50 Plus',
                    'price' => 99000,
                    'stock' => 30,
                ],
            ]);

        $this->assertDatabaseHas('products', [
            'product_id' => $product->product_id,
            'name' => 'Sunscreen SPF 50 Plus',
        ]);
    }

    public function test_authenticated_user_can_delete_product(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;
        $category = Category::create(['category' => 'Skincare']);

        $product = Product::create([
            'name' => 'Toner Hydrating',
            'slug' => 'toner-hydrating',
            'category_id' => $category->category_id,
            'price' => 70000,
            'stock' => 10,
        ]);

        $response = $this->withHeader('Authorization', 'Bearer '.$token)
            ->deleteJson('/api/products/'.$product->product_id);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Product deleted successfully']);

        $this->assertDatabaseMissing('products', ['product_id' => $product->product_id]);
    }

    public function test_user_profile_and_logout(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        // Profile
        $profileResponse = $this->withHeader('Authorization', 'Bearer '.$token)
            ->getJson('/api/profile');

        $profileResponse->assertStatus(200)
            ->assertJson([
                'id' => $user->id,
                'email' => $user->email,
            ]);

        // Logout
        $logoutResponse = $this->withHeader('Authorization', 'Bearer '.$token)
            ->postJson('/api/logout');

        $logoutResponse->assertStatus(200)
            ->assertJson(['message' => 'Logout success']);

        // Check token deleted
        $this->assertDatabaseCount('personal_access_tokens', 0);
    }
}
