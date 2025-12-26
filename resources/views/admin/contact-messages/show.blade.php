@extends('admin.layout')

@section('title', 'Contact Bericht')
@section('page-title', 'Contact Bericht van ' . $contactMessage->name)

@section('content')

<div class="mb-4">
    <a href="{{ route('admin.contact-messages.index') }}" class="text-blue-600 hover:text-blue-900">
        <i class="fas fa-arrow-left mr-2"></i>Terug naar overzicht
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <div class="lg:col-span-2 space-y-6">

        <div class="bg-white rounded-lg shadow p-6">
            <div class="border-b border-gray-200 pb-4 mb-4">
                <h3 class="text-2xl font-bold text-gray-800">{{ $contactMessage->subject }}</h3>
                <p class="text-sm text-gray-500 mt-1">
                    Ontvangen op {{ $contactMessage->created_at->format('d/m/Y \o\m H:i') }}
                </p>
            </div>

            <div class="mb-6">
                <h4 class="text-sm font-semibold text-gray-700 mb-2">Van:</h4>
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-xl mr-4">
                        {{ strtoupper(substr($contactMessage->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">{{ $contactMessage->name }}</p>
                        <p class="text-sm text-gray-600">
                            <a href="mailto:{{ $contactMessage->email }}" class="text-blue-600 hover:underline">
                                {{ $contactMessage->email }}
                            </a>
                        </p>
                        @if($contactMessage->phone)
                            <p class="text-sm text-gray-600">
                                <a href="tel:{{ $contactMessage->phone }}" class="text-blue-600 hover:underline">
                                    {{ $contactMessage->phone }}
                                </a>
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <h4 class="text-sm font-semibold text-gray-700 mb-2">Bericht:</h4>
                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                    <p class="text-gray-800 whitespace-pre-line">{{ $contactMessage->message }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                <i class="fas fa-sticky-note text-yellow-600 mr-2"></i>
                Interne Notities
            </h3>

            <form action="{{ route('admin.contact-messages.update-notes', $contactMessage) }}" method="POST">
                @csrf
                <textarea name="admin_notes"
                          rows="4"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg mb-3"
                          placeholder="Voeg interne notities toe (niet zichtbaar voor klant)">{{ old('admin_notes', $contactMessage->admin_notes) }}</textarea>

                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    <i class="fas fa-save mr-2"></i>Notities Opslaan
                </button>
            </form>
        </div>
    </div>

    <div class="space-y-6">

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Status</h3>

            <div class="text-center mb-4">
                <span class="inline-block px-4 py-2 text-sm font-semibold rounded-full {{ $contactMessage->status_color }}">
                    {{ $contactMessage->status_label }}
                </span>
            </div>

            <div class="space-y-2">
                @if($contactMessage->status !== 'read')
                    <form action="{{ route('admin.contact-messages.mark-read', $contactMessage) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            <i class="fas fa-check mr-2"></i>Markeer als Gelezen
                        </button>
                    </form>
                @endif

                @if($contactMessage->status !== 'new')
                    <form action="{{ route('admin.contact-messages.mark-unread', $contactMessage) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700">
                            <i class="fas fa-undo mr-2"></i>Markeer als Ongelezen
                        </button>
                    </form>
                @endif

                @if($contactMessage->status !== 'archived')
                    <form action="{{ route('admin.contact-messages.archive', $contactMessage) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                            <i class="fas fa-archive mr-2"></i>Archiveren
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Acties</h3>

            <div class="space-y-2">
                <a href="mailto:{{ $contactMessage->email }}?subject=RE: {{ $contactMessage->subject }}"
                   class="block w-full px-4 py-2 bg-blue-600 text-white text-center rounded-lg hover:bg-blue-700"
                   onclick="markAsReplied()">
                    <i class="fas fa-reply mr-2"></i>Beantwoorden
                </a>

                @if($contactMessage->phone)
                    <a href="tel:{{ $contactMessage->phone }}"
                       class="block w-full px-4 py-2 bg-green-600 text-white text-center rounded-lg hover:bg-green-700">
                        <i class="fas fa-phone mr-2"></i>Bellen
                    </a>
                @endif

                <form action="{{ route('admin.contact-messages.destroy', $contactMessage) }}"
                      method="POST"
                      onsubmit="return confirm('Weet je zeker dat je dit bericht wilt verwijderen?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                        <i class="fas fa-trash mr-2"></i>Verwijderen
                    </button>
                </form>
            </div>
        </div>

        @if($contactMessage->replied_at)
            <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                <h3 class="text-sm font-semibold text-green-800 mb-2">
                    <i class="fas fa-check-circle mr-1"></i>
                    Beantwoord
                </h3>
                <p class="text-sm text-green-700">
                    Door {{ $contactMessage->repliedBy->name }}<br>
                    Op {{ $contactMessage->replied_at->format('d/m/Y \o\m H:i') }}
                </p>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Informatie</h3>

            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-500">Ontvangen:</span>
                    <span class="text-gray-900">{{ $contactMessage->created_at->format('d/m/Y H:i') }}</span>
                </div>
                @if($contactMessage->ip_address)
                    <div class="flex justify-between">
                        <span class="text-gray-500">IP Adres:</span>
                        <span class="text-gray-900 font-mono text-xs">{{ $contactMessage->ip_address }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
function markAsReplied() {
    fetch("{{ route('admin.contact-messages.mark-replied', $contactMessage) }}", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
        }
    });
}
</script>

@endsection
