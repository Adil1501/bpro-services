<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $categories = Category::with(['faqs' => function($query) {
            $query->orderBy('order');
        }])
        ->whereHas('faqs')
        ->orderBy('order')
        ->get();

        return view('frontend.faq.index', compact('categories'));
    }
}
