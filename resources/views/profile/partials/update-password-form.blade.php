<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Wachtwoord Wijzigen
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Zorg ervoor dat je account een lang, willekeurig wachtwoord gebruikt om veilig te blijven.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-medium text-gray-700">
                Huidig Wachtwoord
            </label>
            <input id="update_password_current_password"
                   name="current_password"
                   type="password"
                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                   autocomplete="current-password">
            @error('current_password', 'updatePassword')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-medium text-gray-700">
                Nieuw Wachtwoord
            </label>
            <input id="update_password_password"
                   name="password"
                   type="password"
                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                   autocomplete="new-password">
            @error('password', 'updatePassword')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-700">
                Bevestig Wachtwoord
            </label>
            <input id="update_password_password_confirmation"
                   name="password_confirmation"
                   type="password"
                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                   autocomplete="new-password">
            @error('password_confirmation', 'updatePassword')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                    class="px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                <i class="fas fa-save mr-2"></i>
                Opslaan
            </button>

            @if (session('status') === 'password-updated')
                <p class="text-sm text-green-600 flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    Opgeslagen!
                </p>
            @endif
        </div>
    </form>
</section>
