@extends('admin.layout')

@section('title', 'Instellingen')
@section('page-title', 'Website Instellingen')

@section('content')

<div class="bg-white rounded-lg shadow">
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="border-b border-gray-200">
            <nav class="flex -mb-px">
                <button type="button" onclick="showTab('general')"
                        class="tab-btn tab-active px-6 py-4 text-sm font-medium border-b-2">
                    <i class="fas fa-cog mr-2"></i>Algemeen
                </button>
                <button type="button" onclick="showTab('contact')"
                        class="tab-btn px-6 py-4 text-sm font-medium border-b-2">
                    <i class="fas fa-address-book mr-2"></i>Contact
                </button>
                <button type="button" onclick="showTab('business')"
                        class="tab-btn px-6 py-4 text-sm font-medium border-b-2">
                    <i class="fas fa-briefcase mr-2"></i>Bedrijfsinfo
                </button>
                <button type="button" onclick="showTab('social')"
                        class="tab-btn px-6 py-4 text-sm font-medium border-b-2">
                    <i class="fas fa-share-alt mr-2"></i>Social Media
                </button>
            </nav>
        </div>

        <div class="p-6">

            <div id="general-tab" class="tab-content">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Algemene Instellingen</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Website Naam <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               name="site_name"
                               value="{{ old('site_name', $settings['site_name'] ?? 'B-Pro Services') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('site_name') border-red-500 @enderror"
                               required>
                        @error('site_name')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Tagline / Slogan
                        </label>
                        <input type="text"
                               name="site_tagline"
                               value="{{ old('site_tagline', $settings['site_tagline'] ?? '') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                               placeholder="Professionele Schoonmaakdiensten">
                    </div>
                </div>

                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Website Beschrijving (SEO)
                    </label>
                    <textarea name="site_description"
                              rows="3"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                              placeholder="Korte beschrijving voor zoekmachines...">{{ old('site_description', $settings['site_description'] ?? '') }}</textarea>
                </div>

                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Website Logo
                    </label>

                    @if(isset($settings['site_logo']))
                        <div class="mb-4">
                            <img src="{{ Storage::url($settings['site_logo']) }}"
                                 alt="Current Logo"
                                 class="h-20 w-auto border border-gray-200 rounded p-2">
                        </div>
                    @endif

                    <input type="file"
                           name="logo"
                           accept="image/*"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <p class="mt-1 text-sm text-gray-500">Aanbevolen: PNG of SVG, transparante achtergrond</p>
                </div>
            </div>

            <div id="contact-tab" class="tab-content hidden">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Contact Informatie</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Contact Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email"
                               name="contact_email"
                               value="{{ old('contact_email', $settings['contact_email'] ?? '') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                               required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Telefoonnummer
                        </label>
                        <input type="text"
                               name="contact_phone"
                               value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                               placeholder="+32 123 45 67 89">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Adres
                        </label>
                        <input type="text"
                               name="contact_address"
                               value="{{ old('contact_address', $settings['contact_address'] ?? '') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                               placeholder="Straatnaam 123">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Stad
                        </label>
                        <input type="text"
                               name="contact_city"
                               value="{{ old('contact_city', $settings['contact_city'] ?? '') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                               placeholder="Leuven">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Postcode
                        </label>
                        <input type="text"
                               name="contact_postal_code"
                               value="{{ old('contact_postal_code', $settings['contact_postal_code'] ?? '') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                               placeholder="3000">
                    </div>
                </div>
            </div>

            <div id="business-tab" class="tab-content hidden">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Bedrijfsinformatie</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            BTW Nummer
                        </label>
                        <input type="text"
                               name="business_vat"
                               value="{{ old('business_vat', $settings['business_vat'] ?? '') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                               placeholder="BE 0123.456.789">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Ondernemingsnummer
                        </label>
                        <input type="text"
                               name="business_ondnr"
                               value="{{ old('business_ondnr', $settings['business_ondnr'] ?? '') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                               placeholder="0123.456.789">
                    </div>
                </div>
            </div>

            <div id="social-tab" class="tab-content hidden">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Social Media Links</h3>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fab fa-facebook text-blue-600 mr-2"></i>Facebook
                        </label>
                        <input type="url"
                               name="social_facebook"
                               value="{{ old('social_facebook', $settings['social_facebook'] ?? '') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                               placeholder="https://facebook.com/bproservices">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fab fa-instagram text-pink-600 mr-2"></i>Instagram
                        </label>
                        <input type="url"
                               name="social_instagram"
                               value="{{ old('social_instagram', $settings['social_instagram'] ?? '') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                               placeholder="https://instagram.com/bproservices">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fab fa-linkedin text-blue-700 mr-2"></i>LinkedIn
                        </label>
                        <input type="url"
                               name="social_linkedin"
                               value="{{ old('social_linkedin', $settings['social_linkedin'] ?? '') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                               placeholder="https://linkedin.com/company/bproservices">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fab fa-twitter text-blue-400 mr-2"></i>Twitter / X
                        </label>
                        <input type="url"
                               name="social_twitter"
                               value="{{ old('social_twitter', $settings['social_twitter'] ?? '') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                               placeholder="https://twitter.com/bproservices">
                    </div>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-200 px-6 py-4 flex justify-between items-center bg-gray-50">
            <p class="text-sm text-gray-600">
                <i class="fas fa-info-circle mr-1"></i>
                Wijzigingen worden direct toegepast
            </p>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                <i class="fas fa-save mr-2"></i>Instellingen Opslaan
            </button>
        </div>
    </form>
</div>

<script>
function showTab(tabName) {
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.add('hidden');
    });

    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('tab-active', 'border-blue-600', 'text-blue-600');
        btn.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
    });

    document.getElementById(tabName + '-tab').classList.remove('hidden');

    event.target.closest('.tab-btn').classList.add('tab-active', 'border-blue-600', 'text-blue-600');
    event.target.closest('.tab-btn').classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
}

document.querySelector('.tab-btn.tab-active').classList.add('border-blue-600', 'text-blue-600');
document.querySelector('.tab-btn.tab-active').classList.remove('border-transparent', 'text-gray-500');
</script>

<style>
.tab-active {
    border-color: #2563eb !important;
    color: #2563eb !important;
}
</style>

@endsection
