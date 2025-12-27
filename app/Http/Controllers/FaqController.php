<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $categories = Category::with(['faqs' => function($query) {
            $query->where('is_active', true)->orderBy('order');
        }])
        ->whereHas('faqs', function($query) {
            $query->where('is_active', true);
        })
        ->orderBy('order')
        ->get();

        return view('frontend.faq.index', compact('categories'));
    }
}
