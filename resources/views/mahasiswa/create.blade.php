<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Mahasiswa Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                {{-- PENTING: Atribut enctype wajib ada untuk upload file --}}
                <form action="{{ route('mahasiswa.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">NIM</label>
                            <input type="text" name="nim" value="{{ old('nim') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500" required>
                            @error('nim') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" name="nama" value="{{ old('nama') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Program Studi</label>
                            <select name="prodi_id" class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500" required>
                                <option value="">-- Pilih Prodi --</option>
                                @foreach($prodi as $p)
                                    <option value="{{ $p->id }}">{{ $p->nama_prodi }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Dosen Pembimbing</label>
                            <select name="dosen_pembimbing_id" class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500">
                                <option value="">-- Pilih Dosen (Opsional) --</option>
                                @foreach($dosens as $d)
                                    <option value="{{ $d->id }}">{{ $d->nama_dosen }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4 md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Foto Profil</label>
                            <input type="file" name="gambar_profil" class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring-blue-500">
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, JPEG. Maks: 2MB.</p>
                            @error('gambar_profil') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end gap-3 border-t pt-6">
                        <a href="{{ route('mahasiswa.index') }}" class="bg-gray-100 text-gray-700 px-4 py-2 rounded">Batal</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-bold transition">Simpan Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>