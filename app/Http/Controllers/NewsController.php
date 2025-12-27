<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::where('is_published', true)
                   ->where('published_at', '<=', now())
                   ->latest('published_at')
                   ->paginate(9);

        return view('frontend.news.index', compact('news'));
    }

    public function show(News $news)
    {
        if (!$news->is_published || $news->published_at > now()) {
            abort(404);
        }

        return view('frontend.news.show', compact('news'));
    }
}
