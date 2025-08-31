@extends('layouts.public', ['title' => 'Selamat Datang di Gampong Udeung Digital'])

@section('content')

{{-- Hero Section --}}
<section class="relative h-[70vh] bg-cover bg-center text-white" style="background-image: url('https://picsum.photos/1600/900?image=1043');">
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    <div class="container mx-auto px-6 h-full flex flex-col justify-center items-center text-center relative z-10">
        <h1 class="text-4xl md:text-6xl font-bold font-serif leading-tight mb-4" data-aos="fade-up">
            Membangun Gampong, Memberdayakan Warga
        </h1>
        <p class="text-lg md:text-xl max-w-3xl" data-aos="fade-up" data-aos-delay="200">
            Platform Digital Gampong Udeung. Sumber informasi terpercaya, panduan layanan, dan etalase potensi desa Anda.
        </p>
    </div>
</section>

{{-- Highlight Section --}}
<section class="py-16 bg-white">
    <div class="container mx-auto px-6 text-center">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            {{-- Card 1: Profil Desa --}}
            <div class="p-6" data-aos="fade-up" data-aos-delay="100">
                <div class="bg-primary text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    {{-- Icon Placeholder --}}
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="font-serif font-bold text-xl mb-2">Profil Desa</h3>
                <p class="text-gray-600">Sejarah, visi, misi, dan struktur pemerintahan Gampong Udeung.</p>
            </div>
            {{-- Card 2: Layanan Publik --}}
            <div class="p-6" data-aos="fade-up" data-aos-delay="200">
                 <div class="bg-primary text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <h3 class="font-serif font-bold text-xl mb-2">Layanan Publik</h3>
                <p class="text-gray-600">Panduan lengkap untuk semua kebutuhan administrasi Anda.</p>
            </div>
            {{-- Card 3: UMKM Desa --}}
            <div class="p-6" data-aos="fade-up" data-aos-delay="300">
                 <div class="bg-primary text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4z"></path></svg>
                </div>
                <h3 class="font-serif font-bold text-xl mb-2">UMKM Desa</h3>
                <p class="text-gray-600">Lihat dan dukung produk-produk unggulan dari usaha mikro warga.</p>
            </div>
            {{-- Card 4: Agenda Kegiatan --}}
            <div class="p-6" data-aos="fade-up" data-aos-delay="400">
                 <div class="bg-primary text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="font-serif font-bold text-xl mb-2">Agenda Kegiatan</h3>
                <p class="text-gray-600">Jadwal kegiatan keagamaan, sosial, dan acara penting lainnya.</p>
            </div>
        </div>
    </div>
</section>

{{-- Berita & Agenda Section --}}
<section class="py-16 bg-secondary-default">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold font-serif text-center mb-12">Berita & Informasi Terkini</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($latestArticles as $article)
                <x-card 
                    :image="$article->image ? Storage::url($article->image) : 'https://picsum.photos/400/300?random=' . $loop->index"
                    :title="$article->title"
                    :date="$article->created_at"
                    :description="$article->summary"
                    :url="'#'" {{-- Replace with route('articles.show', $article) later --}}
                />
            @empty
                <p class="text-center col-span-full">Tidak ada berita untuk ditampilkan.</p>
            @endforelse
        </div>
        <div class="text-center mt-12">
            <a href="#" class="bg-primary text-white px-8 py-3 rounded-md hover:bg-primary-dark transition text-lg">Lihat Semua Berita</a>
        </div>
    </div>
</section>

@endsection
