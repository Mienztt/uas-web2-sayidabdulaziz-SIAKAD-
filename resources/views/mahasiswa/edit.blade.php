<x-app-layout>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="text-center text-3xl font-extrabold text-gray-900">
                Edit Data Mahasiswa
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Perbarui informasi akademik dan profil.
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-xl">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form action="{{ route('admin.mahasiswa.update', $mahasiswa->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <div class="mb-6 flex flex-col items-center">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Foto Profil</label>
                        <div class="relative group">
                            <div class="w-24 h-24 rounded-full overflow-hidden bg-gray-100 border-2 border-dashed border-gray-300 flex items-center justify-center">
                                @if($mahasiswa->gambar_profil)
                                    <img src="{{ asset('storage/' . $mahasiswa->gambar_profil) }}" class="w-full h-full object-cover">
                                @else
                                    <svg class="h-10 w-10 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                @endif
                            </div>
                            <input type="file" name="gambar_profil" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Klik lingkaran untuk mengganti foto</p>
                    </div>

                    <div class="mb-4">
                        <label for="nim" class="block text-sm font-medium text-gray-700">NIM</label>
                        <input type="text" name="nim" id="nim" value="{{ old('nim', $mahasiswa->nim) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('nim') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama', $mahasiswa->nama) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('nama') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="prodi_id" class="block text-sm font-medium text-gray-700">Program Studi</label>
                        <select name="prodi_id" id="prodi_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="">-- Pilih Prodi --</option>
                            @foreach($prodi as $p)
                                <option value="{{ $p->id }}" {{ old('prodi_id', $mahasiswa->prodi_id) == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama_prodi }}
                                </option>
                            @endforeach
                        </select>
                        @error('prodi_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="dosen_pembimbing_id" class="block text-sm font-medium text-gray-700">Dosen Pembimbing</label>
                        <select name="dosen_pembimbing_id" id="dosen_pembimbing_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="">-- Pilih Dosen Pembimbing --</option>
                            @foreach($dosens as $dosen)
                                <option value="{{ $dosen->id }}" {{ old('dosen_pembimbing_id', $mahasiswa->dosen_pembimbing_id) == $dosen->id ? 'selected' : '' }}>
                                    {{ $dosen->nama_dosen }} ({{ $dosen->nidn }})
                                </option>
                            @endforeach
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Dosen wali akademik mahasiswa ini.</p>
                    </div>

                    <div class="mb-6">
                        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea name="alamat" id="alamat" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('alamat', $mahasiswa->alamat) }}</textarea>
                    </div>

                    <div class="flex items-center justify-between">
                        <a href="{{ route('admin.mahasiswa.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>