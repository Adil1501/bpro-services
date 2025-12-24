<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Category;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $query = Faq::with('category');

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $faqs = $query->orderBy('category_id')
                      ->orderBy('order')
                      ->paginate(20);

        $categories = Category::orderBy('name')->get();

        return view('admin.faqs.index', compact('faqs', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.faqs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'question' => ['required', 'string', 'max:500'],
            'answer' => ['required', 'string'],
            'order' => ['nullable', 'integer', 'min:0'],
            'is_published' => ['boolean'],
        ]);

        $validated['order'] = $validated['order'] ?? 0;

        Faq::create($validated);

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQ succesvol aangemaakt!');
    }

    public function show(Faq $faq)
    {
        $faq->load('category');
        return view('admin.faqs.show', compact('faq'));
    }

    public function edit(Faq $faq)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.faqs.edit', compact('faq', 'categories'));
    }

    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'question' => ['required', 'string', 'max:500'],
            'answer' => ['required', 'string'],
            'order' => ['nullable', 'integer', 'min:0'],
            'is_published' => ['boolean'],
        ]);

        $faq->update($validated);

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQ succesvol bijgewerkt!');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQ succesvol verwijderd!');
    }
}
