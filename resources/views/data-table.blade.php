@extends('layouts.public', ['title' => $title ?? 'Tabel Data'])

@section('content')

{{-- Page Header --}}
<section class="bg-primary text-white py-16">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-4xl font-serif font-bold" data-aos="fade-up">{{ $title ?? 'Data' }}</h1>
        <p class="text-lg mt-2" data-aos="fade-up" data-aos-delay="100">Tampilan data dalam format tabel yang rapi dan responsif.</p>
    </div>
</section>

{{-- Data Table Section --}}
<section class="py-16 bg-secondary-default">
    <div class="container mx-auto px-6">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <div class="overflow-x-auto">
                <table class="w-full text-left table-auto">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-3 font-semibold text-sm text-gray-600 uppercase border-b-2 border-gray-200">Judul Kegiatan</th>
                            <th class="px-4 py-3 font-semibold text-sm text-gray-600 uppercase border-b-2 border-gray-200">Lokasi</th>
                            <th class="px-4 py-3 font-semibold text-sm text-gray-600 uppercase border-b-2 border-gray-200">Waktu Mulai</th>
                            <th class="px-4 py-3 font-semibold text-sm text-gray-600 uppercase border-b-2 border-gray-200">Waktu Selesai</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @forelse($items as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 border-b border-gray-200">{{ $item->title }}</td>
                                <td class="px-4 py-3 border-b border-gray-200">{{ $item->location ?? '-' }}</td>
                                <td class="px-4 py-3 border-b border-gray-200">{{ \Carbon\Carbon::parse($item->start_time)->translatedFormat('d M Y, H:i') }}</td>
                                <td class="px-4 py-3 border-b border-gray-200">{{ $item->end_time ? \Carbon\Carbon::parse($item->end_time)->translatedFormat('d M Y, H:i') : '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-8 text-gray-500">Tidak ada data untuk ditampilkan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination Links --}}
            <div class="mt-8">
                {{ $items->links() }}
            </div>
        </div>
    </div>
</section>

@endsection
