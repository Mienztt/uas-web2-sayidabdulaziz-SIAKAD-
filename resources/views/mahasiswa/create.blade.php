<x-app-layout>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="text-center text-3xl font-extrabold text-gray-900">
                Tambah Mahasiswa Baru
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Lengkapi data di bawah ini dengan benar.
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-xl">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                
                <form action="{{ route('admin.mahasiswa.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">NIM</label>
                        <input type="text" name="nim" value="{{ old('nim') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Contoh: 12345678">
                        @error('nim') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Nama sesuai KTM">
                        @error('nama') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Program Studi</label>
                        <select name="prodi_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="">-- Pilih Prodi --</option>
                            @foreach($prodi as $p)
                                <option value="{{ $p->id }}" {{ old('prodi_id') == $p->id ? 'selected' : '' }}>{{ $p->nama_prodi }}</option>
                            @endforeach
                        </select>
                        @error('prodi_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Dosen Pembimbing</label>
                        <select name="dosen_pembimbing_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="">-- Pilih Dosen Pembimbing --</option>
                            @foreach($dosens as $dosen)
                                <option value="{{ $dosen->id }}" {{ old('dosen_pembimbing_id') == $dosen->id ? 'selected' : '' }}>
                                    {{ $dosen->nama_dosen }}
                                </option>
                            @endforeach
                        </select>
                        @error('dosen_pembimbing_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea name="alamat" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('alamat') }}</textarea>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700">Foto Profil</label>
                        <input type="file" name="gambar_profil" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    </div>

                    <div class="flex items-center justify-end">
                        <a href="{{ route('admin.mahasiswa.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-xl shadow-lg transition-all">Simpan Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>