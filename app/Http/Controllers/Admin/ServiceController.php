<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::withCount('quotes')
                           ->orderBy('order')
                           ->paginate(20);

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:services'],
            'description' => ['required', 'string'],
            'icon' => ['nullable', 'string', 'max:100'],
            'is_active' => ['boolean'],
            'order' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['order'] = $validated['order'] ?? 0;

        Service::create($validated);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Dienst succesvol aangemaakt!');
    }

    public function show(Service $service)
    {
        $service->loadCount('quotes');
        return view('admin.services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:services,name,' . $service->id],
            'description' => ['required', 'string'],
            'icon' => ['nullable', 'string', 'max:100'],
            'is_active' => ['boolean'],
            'order' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $service->update($validated);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Dienst succesvol bijgewerkt!');
    }

    public function destroy(Service $service)
    {
        if ($service->quotes()->count() > 0) {
            return redirect()
                ->route('admin.services.index')
                ->with('error', 'Dienst kan niet verwijderd worden, het is nog in gebruik bij offertes!');
        }

        $service->delete();

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Dienst succesvol verwijderd!');
    }
}
