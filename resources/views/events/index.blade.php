@extends('layouts.public', ['title' => 'Agenda Kegiatan'])

@section('content')

{{-- Page Header --}}
<section class="bg-primary text-white py-16">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-4xl font-serif font-bold" data-aos="fade-up">Agenda Kegiatan</h1>
        <p class="text-lg mt-2" data-aos="fade-up" data-aos-delay="100">Informasi jadwal kegiatan sosial, keagamaan, dan acara penting lainnya di Gampong Udeung.</p>
    </div>
</section>

{{-- Upcoming Events --}}
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-serif font-bold text-center mb-12" data-aos="fade-up">Kegiatan Akan Datang</h2>
        @if($upcomingEvents->isEmpty())
            <div class="text-center py-8">
                <p class="text-gray-600">Tidak ada kegiatan yang akan datang saat ini.</p>
            </div>
        @else
            <div class="space-y-8">
                @foreach($upcomingEvents as $event)
                    <div class="md:flex bg-white rounded-lg shadow-md overflow-hidden" data-aos="fade-up">
                        <div class="md:w-1/3">
                            <img class="h-48 w-full object-cover md:h-full" src="{{ $event->image ? Storage::url($event->image) : 'https://picsum.photos/400/300?random=' . $loop->index }}" alt="Gambar {{ $event->title }}">
                        </div>
                        <div class="md:w-2/3 p-6 flex flex-col justify-center">
                            <p class="text-sm text-primary font-semibold">{{ \Carbon\Carbon::parse($event->start_time)->translatedFormat('l, d F Y • H:i') }} WIB</p>
                            <h3 class="font-serif font-bold text-2xl my-2">{{ $event->title }}</h3>
                            <p class="text-gray-600 mb-1"><span class="font-semibold">Lokasi:</span> {{ $event->location ?? 'Tidak ditentukan' }}</p>
                            <div class="prose prose-sm max-w-none text-gray-700 mt-2 line-clamp-3">
                                {!! $event->description !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-12">
                {{ $upcomingEvents->links() }}
            </div>
        @endif
    </div>
</section>

{{-- Past Events --}}
<section class="py-16 bg-secondary-default">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-serif font-bold text-center mb-12" data-aos="fade-up">Arsip Kegiatan</h2>
         @if($pastEvents->isEmpty())
            <div class="text-center py-8">
                <p class="text-gray-600">Tidak ada arsip kegiatan.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($pastEvents as $event)
                    <x-card
                        :image="$event->image ? Storage::url($event->image) : 'https://picsum.photos/400/300?random=past' . $loop->index"
                        :title="$event->title"
                        :date="$event->start_time"
                        :description="$event->description"
                        :url="'#'" {{-- No detail page for events for now --}}
                    />
                @endforeach
            </div>
            <div class="mt-12">
                {{ $pastEvents->links() }}
            </div>
        @endif
    </div>
</section>

@endsection
