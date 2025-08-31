@extends('layouts.public')

@section('title', 'Panduan Administrasi')

@section('content')
<section class="text-center mb-12">
    <h1 class="text-4xl md:text-5xl font-extrabold font-serif text-green-800">Panduan Administrasi Cerdas</h1>
    <p class="text-lg text-gray-700 max-w-2xl mx-auto mt-4">
        Temukan informasi lengkap tentang pengurusan administrasi di Gampong Udeung. Proses yang jelas, syarat yang transparan, dan pelayanan yang efisien.
    </p>
</section>

<section class="max-w-5xl mx-auto">
    <div class="space-y-6">
        @forelse($guides as $guide)
            <div class="bg-white rounded-lg shadow-md p-6 flex flex-col md:flex-row items-start gap-6 transform hover:-translate-y-1 transition-transform duration-300">
                <div class="flex-grow">
                    <h2 class="text-2xl font-bold font-serif text-green-800">{{ $guide->title }}</h2>
                    <p class="text-gray-600 mt-2">{{ \Illuminate\Support\Str::limit(strip_tags($guide->content), 200) }}</p>
                </div>
                <a href="{{ route('guides.show', $guide) }}" class="bg-green-700 text-white font-bold py-2 px-5 rounded-lg shadow hover:bg-green-800 transition-colors whitespace-nowrap">
                    Lihat Detail Lengkap
                </a>
            </div>
        @empty
             <p class="text-center text-gray-500 col-span-full">Belum ada panduan yang dipublikasikan.</p>
        @endforelse
    </div>
</section>
@endsection