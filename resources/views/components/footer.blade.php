<footer class="bg-gray-800 text-white">
    <div class="container mx-auto px-6 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
            {{-- About Section --}}
            <div>
                <h3 class="font-serif font-bold text-lg mb-4">Gampong Udeung Digital</h3>
                <p class="text-gray-400">
                    Platform digital terpusat untuk informasi, layanan, dan potensi Gampong Udeung, Kecamatan Bandar Baru, Pidie Jaya.
                </p>
            </div>

            {{-- Quick Links --}}
            <div>
                <h3 class="font-serif font-bold text-lg mb-4">Tautan Cepat</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white">Profil Desa</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Berita Terbaru</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Agenda Kegiatan</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Panduan Layanan</a></li>
                </ul>
            </div>

            {{-- Contact & Socials --}}
            <div>
                <h3 class="font-serif font-bold text-lg mb-4">Kontak Kami</h3>
                <p class="text-gray-400">Kantor Keuchik Gampong Udeung</p>
                <p class="text-gray-400">Kec. Bandar Baru, Pidie Jaya, Aceh</p>
                <div class="flex justify-center md:justify-start space-x-4 mt-4">
                    {{-- Social Media Icons --}}
                    <a href="#" class="text-gray-400 hover:text-white">
                        <span class="sr-only">Facebook</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white">
                        <span class="sr-only">Instagram</span>
                        {{-- Placeholder for Instagram Icon --}}
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-12h2v4h-2zm0 6h2v2h-2z"/></svg>
                    </a>
                     <a href="#" class="text-gray-400 hover:text-white">
                        <span class="sr-only">YouTube</span>
                        {{-- Placeholder for YouTube Icon --}}
                         <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-12h2v4h-2zm0 6h2v2h-2z"/></svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="mt-8 border-t border-gray-700 pt-6 text-center">
            <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} Gampong Udeung Digital. All Rights Reserved.</p>
        </div>
    </div>
</footer>
