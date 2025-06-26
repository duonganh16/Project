<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    /**
     * Display a listing of the user's orders.
     */
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
                      ->with(['items.product'])
                      ->orderBy('created_at', 'desc')
                      ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show($id)
    {
        // Only allow users to view their own orders
        $order = Order::where('user_id', auth()->id())
                     ->where('id', $id)
                     ->with(['items.product'])
                     ->firstOrFail();

        return view('orders.show', compact('order'));
    }
}
