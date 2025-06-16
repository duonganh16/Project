<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // Trang chủ
    public function home()
    {
        $products = Product::all();
        return view('home', compact('products'));
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
