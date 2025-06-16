<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // Hiển thị giỏ hàng
    public function index()
    {
        $cart = Session::get('cart', []);
        return view('cart', compact('cart'));
    }

    // Thêm sản phẩm vào giỏ hàng
    public function add($id)
    {
        $product = Product::findOrFail($id);
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'product' => $product,
                'quantity' => 1
            ];
        }

        Session::put('cart', $cart);
        return redirect('/cart')->with('success', 'Đã thêm sản phẩm vào giỏ hàng.');
    }

    // Cập nhật số lượng sản phẩm
    public function update(Request $request)
    {
        $cart = Session::get('cart', []);
        foreach ($request->quantities as $id => $qty) {
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] = $qty;
            }
        }
        Session::put('cart', $cart);
        return redirect('/cart')->with('success', 'Cập nhật giỏ hàng thành công.');
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function remove($id)
    {
        $cart = Session::get('cart', []);
        unset($cart[$id]);
        Session::put('cart', $cart);
        return redirect('/cart')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }

    // Hiển thị trang thanh toán
    public function checkout()
    {
        $cart = Session::get('cart', []);
        return view('checkout', compact('cart'));
    }

    // Đặt hàng
    public function placeOrder(Request $request)
    {
        $order = Order::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'note' => $request->note,
        ]);

        $cart = Session::get('cart', []);
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product']->id,
                'quantity' => $item['quantity'],
                'price' => $item['product']->price,
            ]);
        }

        Session::forget('cart');

        return redirect('/')->with('success', 'Đặt hàng thành công!');
    }
}