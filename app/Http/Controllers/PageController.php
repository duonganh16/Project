<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // Trang chủ
    public function home()
    {
        return view('home');
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
