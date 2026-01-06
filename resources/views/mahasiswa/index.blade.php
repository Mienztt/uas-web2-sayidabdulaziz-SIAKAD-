<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profil Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <div class="flex flex-col md:flex-row items-center gap-10">
                        {{-- Foto Profil Besar --}}
                        <div class="flex-shrink-0">
                            @if($mahasiswa->gambar_profil)
                                <img src="{{ asset('storage/' . $mahasiswa->gambar_profil) }}" 
                                     class="w-56 h-56 rounded-full object-cover border-8 border-indigo-50 shadow-xl">
                            @else
                                <div class="w-56 h-56 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-300 border-4 border-dashed border-indigo-200">
                                    <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            @endif
                        </div>

                        {{-- Data Detail --}}
                        <div class="flex-1 w-full">
                            <h3 class="text-3xl font-extrabold text-gray-900 mb-6">{{ $mahasiswa->nama }}</h3>
                            
                            <div class="space-y-4">
                                <div class="flex border-b pb-2">
                                    <span class="w-32 text-gray-500 font-medium">NIM</span>
                                    <span class="text-gray-900 font-bold">: {{ $mahasiswa->nim }}</span>
                                </div>
                                <div class="flex border-b pb-2">
                                    <span class="w-32 text-gray-500 font-medium">Program Studi</span>
                                    <span class="text-gray-900">: {{ $mahasiswa->prodi->nama_prodi ?? '-' }}</span>
                                </div>
                                <div class="flex border-b pb-2">
                                    <span class="w-32 text-gray-500 font-medium">Pembimbing</span>
                                    <span class="text-gray-900">: {{ $mahasiswa->dosenPembimbing->nama_dosen ?? 'Belum Ditentukan' }}</span>
                                </div>
                                <div class="flex pb-2">
                                    <span class="w-32 text-gray-500 font-medium">Alamat</span>
                                    <span class="text-gray-900">: {{ $mahasiswa->alamat ?? '-' }}</span>
                                </div>
                            </div>

                            <div class="mt-8 flex gap-3">
                                <a href="{{ route('mahasiswa.index') }}" class="bg-gray-100 text-gray-700 px-4 py-2 rounded hover:bg-gray-200">
                                    ← Kembali
                                </a>
                                <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition font-medium">
                                    Edit Profil
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>