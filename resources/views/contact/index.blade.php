@extends('layouts.public', ['title' => 'Hubungi Kami'])

@section('content')

{{-- Page Header --}}
<section class="bg-primary text-white py-16">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-4xl font-serif font-bold" data-aos="fade-up">Hubungi Kami</h1>
        <p class="text-lg mt-2" data-aos="fade-up" data-aos-delay="100">Kami siap mendengar dari Anda. Sampaikan pertanyaan, saran, atau laporan Anda melalui form di bawah ini.</p>
    </div>
</section>

{{-- Contact Form and Info Section --}}
<section class="py-16 bg-secondary-default">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

            {{-- Form Section --}}
            <div class="lg:col-span-2 bg-white p-8 rounded-lg shadow-md" data-aos="fade-right">
                <h2 class="text-2xl font-serif font-bold mb-6">Kirim Pesan</h2>
                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" name="name" id="name" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary" value="{{ old('name') }}">
                            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                            <input type="email" name="email" id="email" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary" value="{{ old('email') }}">
                            @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div class="mt-6">
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subjek</label>
                        <input type="text" name="subject" id="subject" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary" value="{{ old('subject') }}">
                        @error('subject')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="mt-6">
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Pesan Anda</label>
                        <textarea name="message" id="message" rows="6" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary">{{ old('message') }}</textarea>
                        @error('message')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="mt-6 text-right">
                        <button type="submit" class="bg-primary text-white px-8 py-3 rounded-md hover:bg-primary-dark transition font-semibold">
                            Kirim Pesan
                        </button>
                    </div>
                </form>
            </div>

            {{-- Info Section --}}
            <div data-aos="fade-left" data-aos-delay="200">
                <h2 class="text-2xl font-serif font-bold mb-6">Informasi Kontak</h2>
                <div class="space-y-6 text-gray-700">
                    <div class="flex items-start space-x-4">
                        <svg class="w-6 h-6 text-primary flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <div>
                            <h3 class="font-semibold">Alamat</h3>
                            <p>Kantor Keuchik Gampong Udeung<br>Kec. Bandar Baru, Pidie Jaya<br>Aceh, 24184</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <svg class="w-6 h-6 text-primary flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <div>
                            <h3 class="font-semibold">Email</h3>
                            <p>kontak@gampongudeung.test</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <svg class="w-6 h-6 text-primary flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        <div>
                            <h3 class="font-semibold">Telepon</h3>
                            <p>(+62) 123-456-7890</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@push('scripts')
@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'OK',
            confirmButtonColor: '#047857' // primary color
        });
    });
</script>
@endif
@endpush
