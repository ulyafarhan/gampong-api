@extends('layouts.public', ['title' => 'Profil Gampong Udeung'])

@section('content')

{{-- Page Header --}}
<section class="bg-primary text-white py-16">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-4xl font-serif font-bold" data-aos="fade-up">Profil Gampong Udeung</h1>
        <p class="text-lg mt-2" data-aos="fade-up" data-aos-delay="100">Mengenal lebih dekat Gampong Udeung, dari sejarah hingga struktur pemerintahan.</p>
    </div>
</section>

{{-- About Us Section --}}
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl font-serif font-bold text-center mb-8" data-aos="fade-up">Tentang Kami</h2>
            
            <div class="prose lg:prose-lg max-w-none text-gray-700" data-aos="fade-up">
                <p>
                    Selamat datang di Gampong Udeung, sebuah desa yang kaya akan sejarah dan budaya, terletak di Kecamatan Bandar Baru, Kabupaten Pidie Jaya. Kami berkomitmen untuk membangun komunitas yang kuat, transparan, dan berdaya saing melalui inovasi dan teknologi.
                </p>

                <h3 class="font-serif">Visi</h3>
                <p>
                    Menjadikan Gampong Udeung sebagai gampong percontohan digital di Kabupaten Pidie Jaya yang unggul dalam transparansi, efisiensi pelayanan, dan pemberdayaan masyarakat melalui teknologi.
                </p>

                <h3 class="font-serif">Misi</h3>
                <ul>
                    <li>Menyederhanakan alur birokrasi untuk semua layanan administrasi kependudukan dan lainnya.</li>
                    <li>Meningkatkan kecepatan dan jangkauan penyebaran informasi penting kepada seluruh warga.</li>
                    <li>Mendokumentasikan dan mempromosikan potensi gampong, mulai dari UMKM, budaya, hingga pariwisata.</li>
                    <li>Menciptakan platform yang mudah diakses dan dikelola secara mandiri oleh aparat gampong.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- Government Structure Section --}}
<section class="py-16 bg-secondary-default">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-serif font-bold text-center mb-12" data-aos="fade-up">Struktur Pemerintahan Gampong</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse($governmentStructure as $member)
                <div class="text-center bg-white p-6 rounded-lg shadow-md" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <img class="w-32 h-32 rounded-full mx-auto mb-4 object-cover" 
                         src="{{ $member->image ? Storage::url($member->image) : 'https://ui-avatars.com/api/?name=' . urlencode($member->name) . '&background=047857&color=fff' }}" 
                         alt="Foto {{ $member->name }}">
                    <h4 class="font-bold text-xl font-serif">{{ $member->name }}</h4>
                    <p class="text-gray-500">{{ $member->position }}</p>
                </div>
            @empty
                <p class="text-center col-span-full">Data struktur pemerintahan belum tersedia.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- Simple prose styling for the text blocks --}}
<style>
    .prose h3 {
        margin-top: 1.5em;
        margin-bottom: 0.5em;
    }
    .prose ul {
        list-style-type: disc;
        padding-left: 1.5em;
    }
    .prose ul li {
        margin-bottom: 0.5em;
    }
</style>
@endsection
