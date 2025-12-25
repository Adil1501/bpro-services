@extends('admin.layout')

@section('title', 'FAQs')
@section('page-title', 'FAQs Beheer')

@section('content')

<div class="mb-6 flex justify-between items-center">
    <div>
        <p class="text-gray-600">Beheer veelgestelde vragen</p>
    </div>
    <a href="{{ route('admin.faqs.create') }}"
       class="px-4 py-2 rounded-lg text-white"
       style="background-color: #2563eb;">
        <i class="fas fa-plus mr-2"></i>
        Nieuwe FAQ
    </a>
</div>

<div class="mb-6 bg-white rounded-lg shadow p-4">
    <form method="GET" action="{{ route('admin.faqs.index') }}" class="flex items-center gap-4">
        <div class="flex-1">
            <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                Filter op Categorie
            </label>
            <select name="category"
                    id="category"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                    onchange="this.form.submit()">
                <option value="">Alle categorieën</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>
        @if(request('category'))
            <div class="pt-6">
                <a href="{{ route('admin.faqs.index') }}"
                   class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                    <i class="fas fa-times mr-1"></i> Reset
                </a>
            </div>
        @endif
    </form>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                    Categorie
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                    Vraag
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                    Volgorde
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                    Status
                </th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">
                    Acties
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($faqs as $faq)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-medium rounded-full"
                              style="background-color: #dbeafe; color: #1e40af;">
                            {{ $faq->category->name }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900">
                            {{ Str::limit($faq->question, 80) }}
                        </div>
                        <div class="text-sm text-gray-500 mt-1">
                            {{ Str::limit(strip_tags($faq->answer), 100) }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 bg-gray-100 rounded-full text-sm font-medium">
                            {{ $faq->order }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($faq->is_published)
                            <span class="px-2 inline-flex items-center text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i> Gepubliceerd
                            </span>
                        @else
                            <span class="px-2 inline-flex items-center text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                <i class="fas fa-eye-slash mr-1"></i> Verborgen
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('admin.faqs.edit', $faq) }}"
                           class="text-blue-600 hover:text-blue-900 mr-3">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.faqs.destroy', $faq) }}"
                              method="POST"
                              class="inline-block"
                              onsubmit="return confirm('Weet je zeker dat je deze FAQ wilt verwijderen?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center">
                        <i class="fas fa-question-circle text-gray-300 text-4xl mb-4"></i>
                        <p class="text-gray-500">
                            @if(request('category'))
                                Geen FAQs gevonden in deze categorie.
                            @else
                                Geen FAQs gevonden. <a href="{{ route('admin.faqs.create') }}" class="text-blue-600">Maak er een aan</a>.
                            @endif
                        </p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $faqs->links() }}
</div>

@endsection
