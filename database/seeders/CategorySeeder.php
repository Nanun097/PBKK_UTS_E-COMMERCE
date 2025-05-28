<?php
// CategorySeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create([
            'category_id' => Str::ulid(),
            'name' => 'Electronics',
            'description' => 'Electronic devices and gadgets'
        ]);

        Category::create([
            'category_id' => Str::ulid(),
            'name' => 'Clothing',
            'description' => 'Fashion and apparel items'
        ]);

        Category::create([
            'category_id' => Str::ulid(),
            'name' => 'Books',
            'description' => 'Books and educational materials'
        ]);

        Category::create([
            'category_id' => Str::ulid(),
            'name' => 'Home & Garden',
            'description' => 'Home improvement and garden supplies'
        ]);
    }
}
