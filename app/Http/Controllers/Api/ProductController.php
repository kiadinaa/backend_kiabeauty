<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Menampilkan semua produk.
     */
    public function index()
    {
        $products = Product::with('category')->paginate(10);

        return ProductResource::collection($products);
    }

    /**
     * Menambahkan produk baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:150',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,category_id',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'img'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload gambar jika tersedia.
        $path = null;

        if ($request->hasFile('img')) {
            $path = $request->file('img')->store('products', 'public');
        }

        // Membuat slug dari nama produk.
        $slug = Str::slug($validated['name']);

        // Menjaga slug tetap unik.
        $originalSlug = $slug;
        $counter = 1;

        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Menyimpan produk ke database.
        $product = Product::create([
            'name'        => $validated['name'],
            'description' => $validated['description'] ?? null,
            'category_id' => $validated['category_id'],
            'price'       => $validated['price'],
            'stock'       => $validated['stock'],
            'img'         => $path,
            'slug'        => $slug,
        ]);

        // Memuat relasi kategori untuk response.
        $product->load('category');

        // Mengembalikan HTTP 201 Created.
        return (new ProductResource($product))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Menampilkan detail satu produk.
     */
    public function show(string $id)
    {
        $product = Product::with('category')->findOrFail($id);

        return new ProductResource($product);
    }

    /**
     * Memperbarui produk.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name'        => 'required|string|max:150',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,category_id',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'img'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'name'        => $validated['name'],
            'description' => $validated['description'] ?? null,
            'category_id' => $validated['category_id'],
            'price'       => $validated['price'],
            'stock'       => $validated['stock'],
        ];

        $slug = Str::slug($validated['name']);
        $originalSlug = $slug;
        $counter = 1;

        while (
            Product::where('slug', $slug)
                ->where('product_id', '!=', $product->product_id)
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $data['slug'] = $slug;

        // Ganti gambar hanya jika file baru diunggah.
        if ($request->hasFile('img')) {
            $oldImage = $product->img;

            $data['img'] = $request->file('img')
                ->store('products', 'public');

            // Jangan menghapus gambar statis yang tersimpan di public/images.
            if (
                $oldImage &&
                !str_starts_with($oldImage, 'images/') &&
                Storage::disk('public')->exists($oldImage)
            ) {
                Storage::disk('public')->delete($oldImage);
            }
        }

        $product->update($data);
        $product->load('category');

        return new ProductResource($product);
    }

    /**
     * Menghapus produk.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found',
            ], 404);
        }

        // Hapus file upload, jika produk memilikinya.
        $image = $product->img;

        if (
            $image &&
            !str_starts_with($image, 'images/') &&
            Storage::disk('public')->exists($image)
        ) {
            Storage::disk('public')->delete($image);
        }

        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully',
        ], 200);
    }
}
