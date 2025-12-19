<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with('author', 'tags')
                    ->latest()
                    ->paginate(15);

        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('admin.news.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'published_at' => ['nullable', 'date'],
            'is_published' => ['boolean'],
            'tags' => ['array'],
            'tags.*' => ['exists:tags,id'],
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['author_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('news', 'public');
        }

        $news = News::create($validated);

        if ($request->has('tags')) {
            $news->tags()->attach($request->tags);
        }

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Nieuwsbericht succesvol aangemaakt!');
    }

    public function show(News $news)
    {
        $news->load('author', 'tags');
        return view('admin.news.show', compact('news'));
    }

    public function edit(News $news)
    {
        $tags = Tag::all();
        $news->load('tags');
        return view('admin.news.edit', compact('news', 'tags'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'published_at' => ['nullable', 'date'],
            'is_published' => ['boolean'],
            'tags' => ['array'],
            'tags.*' => ['exists:tags,id'],
        ]);

        if ($validated['title'] !== $news->title) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('image')) {
            if ($news->image && \Storage::disk('public')->exists($news->image)) {
                \Storage::disk('public')->delete($news->image);
            }

            $validated['image'] = $request->file('image')->store('news', 'public');
        }

        $news->update($validated);

        if ($request->has('tags')) {
            $news->tags()->sync($request->tags);
        } else {
            $news->tags()->detach();
        }

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Nieuwsbericht succesvol bijgewerkt!');
    }

    public function destroy(News $news)
    {
        if ($news->image && \Storage::disk('public')->exists($news->image)) {
            \Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Nieuwsbericht succesvol verwijderd!');
    }
}
