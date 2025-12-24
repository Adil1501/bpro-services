<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount(['faqs', 'portfolioProjects', 'tickets'])
                              ->orderBy('order')
                              ->paginate(20);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories'],
            'description' => ['nullable', 'string'],
            'order' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['order'] = $validated['order'] ?? 0;

        Category::create($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Categorie succesvol aangemaakt!');
    }

    public function edit(Category $category)
    {
        $category->loadCount(['faqs', 'portfolioProjects', 'tickets']);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name,' . $category->id],
            'description' => ['nullable', 'string'],
            'order' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $category->update($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Categorie succesvol bijgewerkt!');
    }

    public function destroy(Category $category)
    {
        $usageCount = $category->faqs()->count()
                    + $category->portfolioProjects()->count()
                    + $category->tickets()->count();

        if ($usageCount > 0) {
            return redirect()
                ->route('admin.categories.index')
                ->with('error', "Categorie kan niet verwijderd worden, het is {$usageCount} keer in gebruik!");
        }

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Categorie succesvol verwijderd!');
    }
}
