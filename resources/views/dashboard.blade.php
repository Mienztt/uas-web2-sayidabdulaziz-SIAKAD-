<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Utama') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Bagian Statistik --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                
                {{-- Card Total Mahasiswa --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase">Total Mahasiswa</p>
                            <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Mahasiswa::count() }}</p>
                        </div>
                    </div>
                </div>

                {{-- Card Total Dosen --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-green-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase">Total Dosen</p>
                            <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Dosen::count() }}</p>
                        </div>
                    </div>
                </div>

                {{-- Card Total Jadwal --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-yellow-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase">Jadwal Kuliah</p>
                            <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Jadwal::count() }}</p>
                        </div>
                    </div>
                </div>

                {{-- Card Ruangan --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-red-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-red-100 text-red-600 mr-4">
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase">Total Ruangan</p>
                            <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Ruang::count() }}</p>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Pesan Selamat Datang --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4">Selamat Datang di Sistem Informasi Akademik (SIAKAD)</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Anda masuk sebagai <strong>{{ Auth::user()->name }}</strong>. 
                        Sistem ini dilengkapi dengan fitur <strong>Smart Scheduling</strong> untuk mencegah konflik jadwal dosen dan ruangan secara otomatis.
                    </p>
                    
                    <div class="mt-8 flex gap-4">
                        {{-- FIX: Menggunakan rute admin.jadwal.index --}}
                        <a href="{{ route('admin.jadwal.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition">
                            Kelola Jadwal
                        </a>
                        {{-- FIX: Menghapus 'web.' dari rute mahasiswa.index --}}
                        <a href="{{ route('mahasiswa.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 transition">
                            Data Mahasiswa
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>