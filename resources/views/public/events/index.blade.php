@extends('layouts.public')

@section('title', 'Jendela Kegiatan Warga')

@section('content')
<section class="text-center mb-12">
    <h1 class="text-4xl md:text-5xl font-extrabold font-serif text-green-800">Jendela Kegiatan Warga</h1>
    <p class="text-lg text-gray-700 max-w-2xl mx-auto mt-4">
        Ikuti kegiatan dan acara yang diselenggarakan di Gampong Udeung. Mari berpartisipasi aktif dalam pembangunan komunitas.
    </p>
</section>

<section class="max-w-5xl mx-auto">
    <div class="space-y-6">
        @forelse($events as $event)
            <div class="bg-white rounded-lg shadow-md p-6 flex flex-col md:flex-row items-center gap-6 border-l-4 border-green-500">
                <div class="text-center md:text-left w-full md:w-40">
                    <div class="text-3xl font-bold text-green-800">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</div>
                    <div class="text-lg font-semibold text-gray-600">{{ \Carbon\Carbon::parse($event->date)->format('F Y') }}</div>
                </div>
                <div class="flex-grow text-center md:text-left">
                     <h2 class="text-2xl font-bold font-serif text-green-800">{{ $event->title }}</h2>
                     <p class="text-gray-600 mt-2"><i class="bi bi-geo-alt-fill me-2"></i> {{ $event->location }}</p>
                </div>
                <div class="text-center md:text-right w-full md:w-48 whitespace-nowrap">
                     <p class="text-lg font-bold text-gray-800"><i class="bi bi-clock-fill me-2"></i> {{ \Carbon\Carbon::parse($event->date)->format('H:i') }} WIB</p>
                </div>
            </div>
        @empty
             <p class="text-center text-gray-500">Belum ada kegiatan yang dijadwalkan.</p>
        @endforelse
    </div>
</section>
@endsection