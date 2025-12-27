<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Category;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        $query = Portfolio::where('is_published', true);

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $portfolios = $query->latest('completed_at')->paginate(12);

        $categories = Category::has('portfolioProjects')
                             ->orderBy('order')
                             ->get();

        return view('frontend.portfolio.index', compact('portfolios', 'categories'));
    }
}
