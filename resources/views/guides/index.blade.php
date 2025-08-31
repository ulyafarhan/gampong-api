@extends('layouts.public', ['title' => 'Panduan Layanan Administrasi'])

@section('content')

{{-- Page Header --}}
<section class="bg-primary text-white py-16">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-4xl font-serif font-bold" data-aos="fade-up">Panduan Layanan Administrasi</h1>
        <p class="text-lg mt-2" data-aos="fade-up" data-aos-delay="100">Solusi "satu pintu" untuk semua kebutuhan administrasi Anda di Gampong Udeung.</p>
    </div>
</section>

{{-- Guides Grid --}}
<section class="py-16 bg-secondary-default">
    <div class="container mx-auto px-6">
        @if($guides->isEmpty())
            <div class="text-center py-12">
                <h2 class="text-2xl font-semibold">Belum Ada Panduan</h2>
                <p class="text-gray-600 mt-2">Saat ini belum ada panduan layanan yang dipublikasikan. Silakan kembali lagi nanti.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($guides as $guide)
                    {{-- Using a dedicated card for guides might be better, but for now, we reuse the main one --}}
                    <x-card
                        :image="'https://picsum.photos/400/300?random=' . $loop->index"
                        :title="$guide->title"
                        :description="$guide->description"
                        :url="route('guides.show', $guide)"
                    />
                @endforeach
            </div>

            {{-- Pagination Links --}}
            <div class="mt-12">
                {{ $guides->links() }}
            </div>
        @endif
    </div>
</section>

@endsection
