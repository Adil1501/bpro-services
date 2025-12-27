<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Account Verwijderen
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Zodra je account is verwijderd, worden alle bronnen en gegevens permanent verwijderd. Voordat je je account verwijdert, download dan alle gegevens of informatie die je wilt behouden.
        </p>
    </header>

    <button type="button"
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="px-6 py-3 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition">
        <i class="fas fa-trash mr-2"></i>
        Account Verwijderen
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                Weet je zeker dat je je account wilt verwijderen?
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Zodra je account is verwijderd, worden alle bronnen en gegevens permanent verwijderd. Voer je wachtwoord in om te bevestigen dat je je account permanent wilt verwijderen.
            </p>

            <div class="mt-6">
                <label for="password" class="sr-only">Wachtwoord</label>
                <input id="password"
                       name="password"
                       type="password"
                       class="mt-1 block w-3/4 px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500"
                       placeholder="Wachtwoord">

                @error('password', 'userDeletion')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button"
                        x-on:click="$dispatch('close')"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    Annuleren
                </button>

                <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    Account Verwijderen
                </button>
            </div>
        </form>
    </x-modal>
</section>
