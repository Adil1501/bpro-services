<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::with('category')
                               ->latest('completed_at')
                               ->paginate(12);

        return view('admin.portfolios.index', compact('portfolios'));
    }

    public function create()
    {
        $categories = Category::orderBy('order')->get();

        return view('admin.portfolios.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'completed_at' => ['nullable', 'date'],
            'before_image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'after_image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'is_featured' => ['boolean'],
        ]);

        if ($request->hasFile('before_image')) {
            $validated['before_image'] = $request->file('before_image')
                ->store('portfolio/before', 'public');
        }

        if ($request->hasFile('after_image')) {
            $validated['after_image'] = $request->file('after_image')
                ->store('portfolio/after', 'public');
        }

        Portfolio::create($validated);

        return redirect()
            ->route('admin.portfolios.index')
            ->with('success', 'Portfolio project succesvol aangemaakt!');
    }

    public function show(Portfolio $portfolio)
    {
        $portfolio->load(['category', 'portfolioLikes']);
        return view('admin.portfolios.show', compact('portfolio'));
    }

    public function edit(Portfolio $portfolio)
    {
        $categories = Category::orderBy('order')->get();

        return view('admin.portfolios.edit', compact('portfolio', 'categories'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'completed_at' => ['nullable', 'date'],
            'before_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'after_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'is_featured' => ['boolean'],
        ]);

        if ($request->hasFile('before_image')) {
            Storage::disk('public')->delete($portfolio->before_image);
            $validated['before_image'] = $request->file('before_image')
                ->store('portfolio/before', 'public');
        }

        if ($request->hasFile('after_image')) {
            Storage::disk('public')->delete($portfolio->after_image);
            $validated['after_image'] = $request->file('after_image')
                ->store('portfolio/after', 'public');
        }

        $portfolio->update($validated);

        return redirect()
            ->route('admin.portfolios.index')
            ->with('success', 'Portfolio project succesvol bijgewerkt!');
    }

    public function destroy(Portfolio $portfolio)
    {
        Storage::disk('public')->delete($portfolio->before_image);
        Storage::disk('public')->delete($portfolio->after_image);

        $portfolio->delete();

        return redirect()
            ->route('admin.portfolios.index')
            ->with('success', 'Portfolio project succesvol verwijderd!');
    }

    public function toggleFeatured(Portfolio $portfolio)
    {
        $portfolio->update([
            'is_featured' => !$portfolio->is_featured
        ]);

        return back()->with('success', 'Featured status bijgewerkt!');
    }
}
