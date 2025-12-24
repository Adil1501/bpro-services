@extends('admin.layout')

@section('title', 'Categorieën')
@section('page-title', 'Categorieën Beheer')

@section('content')

<div class="mb-6 flex justify-between items-center">
    <div>
        <p class="text-gray-600">Beheer categorieën voor FAQs, Portfolio en Tickets</p>
    </div>
    <a href="{{ route('admin.categories.create') }}"
       class="px-4 py-2 rounded-lg text-white"
       style="background-color: #2563eb;">
        <i class="fas fa-plus mr-2"></i>
        Nieuwe Categorie
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                    Volgorde
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                    Naam
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                    Slug
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                    Gebruik
                </th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">
                    Acties
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($categories as $category)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 bg-gray-100 rounded-full text-sm font-medium">
                            {{ $category->order }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-folder text-blue-600"></i>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $category->name }}
                                </div>
                                @if($category->description)
                                    <div class="text-sm text-gray-500">
                                        {{ Str::limit($category->description, 50) }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $category->slug }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            <i class="fas fa-question-circle text-blue-600 mr-1"></i>
                            {{ $category->faqs_count }} FAQs
                        </div>
                        <div class="text-sm text-gray-500">
                            <i class="fas fa-images text-green-600 mr-1"></i>
                            {{ $category->portfolio_projects_count }} Portfolio
                        </div>
                        <div class="text-sm text-gray-500">
                            <i class="fas fa-ticket-alt text-purple-600 mr-1"></i>
                            {{ $category->tickets_count }} Tickets
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('admin.categories.edit', $category) }}"
                           class="text-blue-600 hover:text-blue-900 mr-3">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.categories.destroy', $category) }}"
                              method="POST"
                              class="inline-block"
                              onsubmit="return confirm('Weet je zeker dat je deze categorie wilt verwijderen?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-red-600 hover:text-red-900"
                                    {{ ($category->faqs_count + $category->portfolio_projects_count + $category->tickets_count) > 0 ? 'disabled title=In gebruik' : '' }}>
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        Geen categorieën gevonden.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $categories->links() }}
</div>

@endsection
