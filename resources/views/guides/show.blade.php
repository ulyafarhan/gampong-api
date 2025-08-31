@extends('layouts.public', ['title' => $guide->title])

@section('content')

{{-- Page Header --}}
<section class="bg-white py-16">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-4xl md:text-5xl font-serif font-bold text-gray-900 leading-tight" data-aos="fade-up">{{ $guide->title }}</h1>
        <p class="text-lg text-gray-600 mt-4 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
            {{ $guide->description }}
        </p>
    </div>
</section>

{{-- Main Content --}}
<section class="pb-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto bg-secondary-default p-8 rounded-lg">

            {{-- Meta Info: Time & Cost --}}
            <div class="flex flex-wrap items-center justify-center gap-x-8 gap-y-4 mb-8 text-center border-b border-gray-300 pb-8" data-aos="fade-up">
                @if($guide->estimated_time)
                <div class="flex items-center space-x-2">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <p class="text-sm text-gray-600">Estimasi Waktu</p>
                        <p class="font-bold">{{ $guide->estimated_time }}</p>
                    </div>
                </div>
                @endif
                @if($guide->estimated_cost > 0)
                <div class="flex items-center space-x-2">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <div>
                        <p class="text-sm text-gray-600">Estimasi Biaya</p>
                        <p class="font-bold">Rp {{ number_format($guide->estimated_cost, 0, ',', '.') }}</p>
                    </div>
                </div>
                @endif
            </div>

            {{-- Requirements --}}
            @php
                $requirements = json_decode($guide->requirements, true);
            @endphp
            @if(!empty($requirements))
            <div class="mb-12" data-aos="fade-up">
                <h2 class="text-2xl font-serif font-bold mb-4">Persyaratan</h2>
                <ul class="space-y-3">
                    @foreach($requirements as $req)
                    <li class="flex items-start">
                        <span class="bg-primary text-white rounded-full flex-shrink-0 w-6 h-6 flex items-center justify-center mr-3 mt-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </span>
                        <span class="text-gray-800">{{ $req }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- Steps --}}
            <div class="mb-12" data-aos="fade-up">
                <h2 class="text-2xl font-serif font-bold mb-4">Alur dan Langkah-langkah</h2>
                <div class="prose lg:prose-lg max-w-none text-gray-800">
                    {!! $guide->steps !!}
                </div>
            </div>

            {{-- Tips --}}
            @if($guide->tips)
            <div data-aos="fade-up">
                <h2 class="text-2xl font-serif font-bold mb-4">Tips Tambahan</h2>
                <div class="bg-amber-100 border-l-4 border-accent-dark text-amber-900 p-4 rounded-r-lg">
                    <div class="prose max-w-none">
                        {!! $guide->tips !!}
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</section>

{{-- Re-using prose styles from article show page --}}
<style>
    .prose h1, .prose h2, .prose h3 {
        font-family: 'Merriweather', serif;
        font-weight: 700;
    }
    .prose p, .prose li {
        font-family: 'Inter', sans-serif;
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
