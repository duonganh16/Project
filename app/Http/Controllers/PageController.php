<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class PageController extends Controller
{
    // Trang chủ
    public function home()
    {
        $products = Product::all();
        return view('home', compact('products'));
    }

    // Trang danh sách sản phẩm
    public function products(Request $request)
    {
        $query = Product::query();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $products = $query->paginate(12);
        return view('products', compact('products'));
    }

    // Trang chi tiết sản phẩm
    public function product($id)
    {
        $product = Product::findOrFail($id);
        return view('product', compact('product'));
    }

    // Trang giới thiệu
    public function about()
    {
        return view('about');
    }

    // Trang liên hệ
    public function contact()
    {
        return view('contact');
    }
}
