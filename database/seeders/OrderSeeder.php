<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get test user (create if not exists)
        $user = User::where('email', 'test@example.com')->first();
        if (!$user) {
            $user = User::create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('password'),
                'is_admin' => false,
            ]);
        }

        // Get some products
        $products = Product::take(3)->get();

        if ($products->count() > 0) {
            // Create sample orders
            $statuses = ['pending', 'processing', 'shipped', 'delivered'];

            for ($i = 1; $i <= 5; $i++) {
                $order = Order::create([
                    'user_id' => $user->id,
                    'name' => 'Nguyễn Văn Test',
                    'address' => '123 Đường ABC, Quận ' . $i . ', TP.HCM',
                    'phone' => '0123456789',
                    'note' => $i % 2 == 0 ? 'Giao hàng giờ hành chính' : null,
                    'status' => $statuses[array_rand($statuses)],
                    'total_amount' => 0, // Will calculate below
                    'created_at' => now()->subDays(rand(1, 30)),
                ]);

                $totalAmount = 0;

                // Add random products to order
                foreach ($products->random(rand(1, 3)) as $product) {
                    $quantity = rand(1, 3);
                    $price = $product->price;

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'price' => $price,
                    ]);

                    $totalAmount += $price * $quantity;
                }

                // Update total amount
                $order->update(['total_amount' => $totalAmount]);
            }
        }
    }
}
