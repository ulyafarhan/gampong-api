@extends('layouts.public')

@section('title', 'Profil Gampong Udeung')

@section('content')
<section class="text-center mb-12">
    <h1 class="text-4xl md:text-5xl font-extrabold font-serif text-green-800">Profil Gampong Udeung</h1>
    <p class="text-lg text-gray-700 max-w-2xl mx-auto mt-4">
        Mengenal lebih dekat Gampong Udeung, dari sejarah hingga struktur pemerintahan yang bertugas.
    </p>
</section>

<section class="mb-16 bg-white p-8 rounded-lg shadow-lg">
    <h2 class="text-3xl font-bold font-serif mb-6 text-center">Visi & Misi</h2>
    <div class="text-center max-w-3xl mx-auto">
        <h3 class="text-2xl font-semibold font-serif text-green-700">Visi</h3>
        <p class="text-lg italic text-gray-600 mb-6">"Menjadikan Gampong Udeung sebagai gampong percontohan digital di Kabupaten Pidie Jaya, yang unggul dalam transparansi, efisiensi pelayanan, dan pemberdayaan masyarakat melalui teknologi."</p>
        
        <h3 class="text-2xl font-semibold font-serif text-green-700">Misi</h3>
        <ul class="list-inside list-disc text-lg text-gray-600 text-left space-y-2">
            <li>Menyederhanakan dan memperjelas alur birokrasi bagi warga.</li>
            <li>Meningkatkan kecepatan dan jangkauan penyebaran informasi resmi.</li>
            <li>Mendokumentasikan dan mempromosikan potensi serta kegiatan komunal gampong.</li>
        </ul>
    </div>
</section>

<section>
     <h2 class="text-3xl font-bold font-serif mb-8 text-center">Struktur Pemerintahan Gampong</h2>
     <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($officials as $official)
        <div class="bg-white rounded-lg shadow-lg p-6 text-center transform hover:-translate-y-2 transition-transform duration-300">
            <img src="{{ asset('storage/' . $official->photo) }}" alt="Foto {{ $official->name }}" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover border-4 border-green-700">
            <h3 class="text-xl font-bold font-serif text-green-800">{{ $official->name }}</h3>
            <p class="text-gray-600 font-semibold">{{ $official->position }}</p>
        </div>
        @empty
            <p class="text-center text-gray-500 col-span-full">Data aparatur gampong belum tersedia.</p>
        @endforelse
     </div>
</section>
@endsection