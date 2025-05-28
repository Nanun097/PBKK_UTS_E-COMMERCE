<?php
// ProductSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $electronics = Category::where('name', 'Electronics')->first();
        $clothing = Category::where('name', 'Clothing')->first();
        $books = Category::where('name', 'Books')->first();
        $homeGarden = Category::where('name', 'Home & Garden')->first();

        // Electronics Products
        Product::create([
            'product_id' => Str::ulid(),
            'name' => 'iPhone 15',
            'description' => 'Latest iPhone with advanced features',
            'price' => 15000000,
            'stock' => 50,
            'category_id' => $electronics->category_id
        ]);

        Product::create([
            'product_id' => Str::ulid(),
            'name' => 'Samsung Galaxy S24',
            'description' => 'Premium Android smartphone',
            'price' => 12000000,
            'stock' => 30,
            'category_id' => $electronics->category_id
        ]);

        Product::create([
            'product_id' => Str::ulid(),
            'name' => 'MacBook Pro',
            'description' => 'Professional laptop for developers',
            'price' => 25000000,
            'stock' => 20,
            'category_id' => $electronics->category_id
        ]);

        // Clothing Products
        Product::create([
            'product_id' => Str::ulid(),
            'name' => 'Cotton T-Shirt',
            'description' => 'Comfortable cotton t-shirt',
            'price' => 150000,
            'stock' => 100,
            'category_id' => $clothing->category_id
        ]);

        Product::create([
            'product_id' => Str::ulid(),
            'name' => 'Denim Jeans',
            'description' => 'Classic blue denim jeans',
            'price' => 300000,
            'stock' => 75,
            'category_id' => $clothing->category_id
        ]);

        // Books Products
        Product::create([
            'product_id' => Str::ulid(),
            'name' => 'Laravel Documentation',
            'description' => 'Complete guide to Laravel framework',
            'price' => 250000,
            'stock' => 40,
            'category_id' => $books->category_id
        ]);

        Product::create([
            'product_id' => Str::ulid(),
            'name' => 'Clean Code',
            'description' => 'A handbook of agile software craftsmanship',
            'price' => 400000,
            'stock' => 25,
            'category_id' => $books->category_id
        ]);

        // Home & Garden Products
        Product::create([
            'product_id' => Str::ulid(),
            'name' => 'Garden Hose',
            'description' => 'Flexible garden hose 50ft',
            'price' => 200000,
            'stock' => 60,
            'category_id' => $homeGarden->category_id
        ]);
    }
}
