@extends('layouts.app')

@section('title', $company->nama . ' - PKLHub')

@section('content')

    <!-- HEADER -->
    <div class="relative text-white py-20 overflow-hidden">

        <!-- Background Image -->
        <img src="{{ asset('images/bg-header.png') }}" class="absolute inset-0 w-full h-full object-cover">

        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-black/40"></div>


        <!-- Content -->
        <div class="relative max-w-5xl mx-auto px-6 animate-fadeUp">

            @if (isset($from) && $from === 'create')
                <a href="{{ route('user.companies.create', ['from' => $origin]) }}"
                    class="inline-block bg-white/10 backdrop-blur hover:bg-white/20 text-white px-4 py-2 rounded-lg text-sm mb-6 transition">
                    ← Kembali
                </a>
            @else
                <a href="{{ route('public.companies.index') }}"
                    class="inline-block bg-white/10 backdrop-blur hover:bg-white/20 text-white px-4 py-2 rounded-lg text-sm mb-6 transition">
                    ← Kembali
                </a>
            @endif


            <h1 class="text-3xl md:text-4xl font-bold">
                {{ $company->nama }}
            </h1>

            <p class="text-gray-200 mt-2">
                {{ $company->alamat }}
            </p>


            <div class="mt-4 flex gap-2 flex-wrap">

                <span class="bg-white/20 backdrop-blur text-sm px-3 py-1 rounded">
                    Jurusan: {{ $company->jurusan->nama ?? '-' }}
                </span>

                @if ($company->status_kuota == 'open')
                    <span class="bg-green-500 text-sm px-3 py-1 rounded">Open</span>
                @elseif($company->status_kuota == 'hampir_penuh')
                    <span class="bg-yellow-500 text-sm px-3 py-1 rounded">Hampir Penuh</span>
                @else
                    <span class="bg-red-500 text-sm px-3 py-1 rounded">Penuh</span>
                @endif

            </div>

        </div>

    </div>



    <!-- CONTENT -->
    <div class="bg-gradient-to-b from-slate-900 via-slate-800 to-slate-900 py-16">

        <div class="max-w-6xl mx-auto px-6 space-y-10">

            @if (session('success'))
                <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg animate-fadeUp">
                    {{ session('success') }}
                </div>
            @endif


            <!-- GRID INFO -->
            <div class="grid md:grid-cols-2 gap-8">

                <!-- DESKRIPSI -->
                <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-100">

                    <h3 class="text-lg font-semibold mb-3 animate-fadeUp">
                        Deskripsi
                    </h3>

                    <p class="text-gray-600 leading-relaxed animate-fadeUp">
                        {{ $company->deskripsi ?? 'Belum ada deskripsi.' }}
                    </p>

                </div>



                <!-- BENEFIT -->
                <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-100">

                    <h3 class="text-lg font-semibold mb-3 animate-fadeUp">
                        Benefit
                    </h3>

                    <p class="text-gray-600 leading-relaxed animate-fadeUp">
                        {{ $company->benefit ?? 'Belum ada informasi benefit.' }}
                    </p>

                </div>

            </div>



            <!-- KONTAK -->
            <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-100">

                <h3 class="text-lg font-semibold mb-6 animate-fadeUp">
                    Informasi Kontak
                </h3>

                <div class="grid md:grid-cols-2 gap-6 text-gray-600">

                    @if ($company->kontak)
                        @php $contacts = explode(',', $company->kontak); @endphp

                        <div>
                            <strong class="block mb-1 animate-fadeUp">WhatsApp</strong>

                            @foreach ($contacts as $contact)
                                @php
                                    $number = trim($contact);
                                    $wa = preg_replace('/[^0-9]/', '', $number);

                                    if (str_starts_with($wa, '0')) {
                                        $wa = '62' . substr($wa, 1);
                                    }
                                @endphp

                                <a href="https://wa.me/{{ $wa }}" target="_blank"
                                    class="block text-blue-600 hover:underline animate-fadeUp">

                                    {{ $number }}

                                </a>
                            @endforeach

                        </div>
                    @endif



                    @if ($company->telepon)
                        @php $phones = explode(',', $company->telepon); @endphp

                        <div>
                            <strong class="block mb-1 animate-fadeUp">Telepon</strong>

                            @foreach ($phones as $phone)
                                <a href="tel:{{ trim($phone) }}" class="block text-blue-600 hover:underline animate-fadeUp">

                                    {{ trim($phone) }}

                                </a>
                            @endforeach

                        </div>
                    @endif



                    @if ($company->email)
                        @php $emails = explode(',', $company->email); @endphp

                        <div>
                            <strong class="block mb-1 animate-fadeUp">Email</strong>

                            @foreach ($emails as $email)
                                <a href="mailto:{{ trim($email) }}" class="block text-blue-600 hover:underline animate-fadeUp">

                                    {{ trim($email) }}

                                </a>
                            @endforeach

                        </div>
                    @endif



                    @if ($company->website)
                        @php $websites = explode(',', $company->website); @endphp

                        <div>
                            <strong class="block mb-1 animate-fadeUp">Website</strong>

                            @foreach ($websites as $site)
                                <a href="{{ trim($site) }}" target="_blank" class="block text-blue-600 hover:underline animate-fadeUp">

                                    {{ trim($site) }}

                                </a>
                            @endforeach

                        </div>
                    @endif

                </div>

            </div>



            <!-- MAP -->
            <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-100">

                <h3 class="text-lg font-semibold mb-4 animate-fadeUp">
                    Lokasi
                </h3>

                <div class="aspect-video w-full rounded-lg overflow-hidden animate-fadeUp">

                    <iframe class="w-full h-full"
                        src="https://www.google.com/maps?q={{ urlencode($company->alamat) }}&output=embed" loading="lazy">
                    </iframe>

                </div>

                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($company->alamat) }}" target="_blank"
                    class="inline-block mt-4 text-blue-600 hover:underline animate-fadeUp">

                    Buka di Google Maps

                </a>

            </div>



            <!-- RATING -->
            <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-100">

                <h3 class="text-lg font-semibold mb-4 animate-fadeUp">
                    Rating Perusahaan
                </h3>

                @if ($company->reviews_count > 0)

                    <div class="flex items-center gap-3 mb-6">

                        <div class="text-yellow-400 text-xl animate-fadeUp">

                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= round($company->reviews_avg_rating))
                                    ★
                                @else
                                    <span class="text-gray-300">★</span>
                                @endif
                            @endfor

                        </div>

                        <span class="text-gray-600 animate-fadeUp">

                            {{ number_format($company->reviews_avg_rating ?? 0, 1) }}
                            ({{ $company->reviews_count }} review)

                        </span>

                    </div>
                @else
                    <p class="text-gray-500 animate-fadeUp">
                        Belum ada review.
                    </p>

                @endif



                <hr class="my-8">



                <h3 class="text-lg font-semibold mb-4 animate-fadeUp">
                    Berikan Review
                </h3>

                @auth

                    @php
                        $alreadyReviewed = \App\Models\Review::where('company_id', $company->id)
                            ->where('user_id', auth()->id())
                            ->exists();
                    @endphp

                    @if (!$alreadyReviewed)
                        <form action="{{ route('reviews.store', $company->id) }}" method="POST" class="space-y-4">
                            @csrf

                            <select name="rating" class="border rounded-lg px-3 py-2 w-full animate-fadeUp">

                                <option value="">Pilih Rating</option>
                                <option value="5">⭐⭐⭐⭐⭐ (5)</option>
                                <option value="4">⭐⭐⭐⭐ (4)</option>
                                <option value="3">⭐⭐⭐ (3)</option>
                                <option value="2">⭐⭐ (2)</option>
                                <option value="1">⭐ (1)</option>

                            </select>

                            <textarea name="comment" rows="3" class="border rounded-lg px-3 py-2 w-full animate-fadeUp"
                                placeholder="Tulis pengalaman PKL kamu...">
</textarea>

                            <button class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition animate-fadeUp">
                                Kirim Review
                            </button>

                        </form>
                    @else
                        <div class="text-blue-600 animate-fadeUp">
                            Kamu sudah memberikan review untuk perusahaan ini.
                        </div>
                    @endif
                @else
                    <div class="text-yellow-600 animate-fadeUp">
                        Silakan login untuk memberikan review.
                    </div>

                @endauth



                <hr class="my-8">



                <!-- REVIEW LIST -->
                <div class="space-y-4">

                    @foreach ($company->reviews as $review)
                        <div class="border rounded-lg p-4 bg-gray-50 animate-fadeUp">

                            <strong>{{ $review->user->name }}</strong>

                            <div class="text-yellow-400 mt-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $review->rating)
                                        ★
                                    @else
                                        <span class="text-gray-300">★</span>
                                    @endif
                                @endfor
                            </div>

                            <p class="mt-2 text-gray-600">
                                {{ $review->comment }}
                            </p>

                            <small class="text-gray-400">
                                {{ $review->created_at->diffForHumans() }}
                            </small>

                        </div>
                    @endforeach

                </div>


            </div>

        </div>

    </div>

@endsection
