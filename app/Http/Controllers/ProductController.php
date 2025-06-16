<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 

class ProductController extends Controller
{
    // Trang chủ - hiển thị danh sách sản phẩm
    public function index()
    {
        $products = Product::all();
        return view('home', compact('products'));
    }

    // Trang chi tiết sản phẩm
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product', compact('product'));
    }
}

