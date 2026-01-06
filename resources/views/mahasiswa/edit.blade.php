<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Profil Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-col md:flex-row gap-8">
                        {{-- Preview Foto Saat Ini --}}
                        <div class="flex flex-col items-center">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Saat Ini</label>
                            @if($mahasiswa->gambar_profil)
                                <img src="{{ asset('storage/' . $mahasiswa->gambar_profil) }}" class="w-40 h-40 rounded-lg object-cover border-4 border-gray-100 shadow">
                            @else
                                <div class="w-40 h-40 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400">No Image</div>
                            @endif
                        </div>

                        {{-- Input Data --}}
                        <div class="flex-1 grid grid-cols-1 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">NIM</label>
                                <input type="text" name="nim" value="{{ old('nim', $mahasiswa->nim) }}" class="w-full rounded-md border-gray-300 shadow-sm" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama</label>
                                <input type="text" name="nama" value="{{ old('nama', $mahasiswa->nama) }}" class="w-full rounded-md border-gray-300 shadow-sm" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Ganti Foto Profil (Opsional)</label>
                                <input type="file" name="gambar_profil" class="mt-1 block w-full border border-gray-300 rounded-md p-1 shadow-sm">
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end gap-3 border-t pt-6">
                        <a href="{{ route('mahasiswa.index') }}" class="bg-gray-100 text-gray-700 px-4 py-2 rounded">Kembali</a>
                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded font-bold transition">Perbarui Profil</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>