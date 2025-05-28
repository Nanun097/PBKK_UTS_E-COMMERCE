<?php
// OrderSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $customer1 = Customer::where('email', 'john@example.com')->first();
        $customer2 = Customer::where('email', 'jane@example.com')->first();
        
        $iphone = Product::where('name', 'iPhone 15')->first();
        $samsung = Product::where('name', 'Samsung Galaxy S24')->first();
        $tshirt = Product::where('name', 'Cotton T-Shirt')->first();

        // Order 1
        $order1 = Order::create([
            'order_id' => Str::ulid(),
            'customer_id' => $customer1->customer_id,
            'order_date' => '2024-05-25',
            'total_amount' => 15150000, // iPhone + T-Shirt
            'status' => 'completed'
        ]);

        OrderItem::create([
            'id' => Str::ulid(),
            'order_id' => $order1->order_id,
            'product_id' => $iphone->product_id,
            'quantity' => 1,
            'price' => 15000000
        ]);

        OrderItem::create([
            'id' => Str::ulid(),
            'order_id' => $order1->order_id,
            'product_id' => $tshirt->product_id,
            'quantity' => 1,
            'price' => 150000
        ]);

        // Order 2
        $order2 = Order::create([
            'order_id' => Str::ulid(),
            'customer_id' => $customer2->customer_id,
            'order_date' => '2024-05-28',
            'total_amount' => 24000000, // 2 Samsung phones
            'status' => 'pending'
        ]);

        OrderItem::create([
            'id' => Str::ulid(),
            'order_id' => $order2->order_id,
            'product_id' => $samsung->product_id,
            'quantity' => 2,
            'price' => 12000000
        ]);

        // Order 3
        $order3 = Order::create([
            'order_id' => Str::ulid(),
            'customer_id' => $customer1->customer_id,
            'order_date' => '2024-05-29',
            'total_amount' => 450000, // 3 T-Shirts
            'status' => 'processing'
        ]);

        OrderItem::create([
            'id' => Str::ulid(),
            'order_id' => $order3->order_id,
            'product_id' => $tshirt->product_id,
            'quantity' => 3,
            'price' => 150000
        ]);
    }
}
