<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Surat Tugas Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                            <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.surat-tugas.store') }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <!-- Dropdown Dosen -->
                            <div>
                                <label for="dosen_id" class="block font-medium text-sm text-gray-700">Dosen</label>
                                <select name="dosen_id" id="dosen_id" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm" required>
                                    <option value="">-- Pilih Dosen --</option>
                                    @foreach($dosens as $dosen)
                                        <option value="{{ $dosen->id }}" {{ old('dosen_id') == $dosen->id ? 'selected' : '' }}>
                                            {{ $dosen->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Dropdown Mata Kuliah -->
                            <div>
                                <label for="mata_kuliah_id" class="block font-medium text-sm text-gray-700">Mata Kuliah</label>
                                <select name="mata_kuliah_id" id="mata_kuliah_id" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm" required>
                                    <option value="">-- Pilih Mata Kuliah --</option>
                                    @foreach($mks as $mk)
                                        <option value="{{ $mk->id }}" {{ old('mata_kuliah_id') == $mk->id ? 'selected' : '' }}>
                                            {{ $mk->nama_mk }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Dropdown Kelas -->
                            <div>
                                <label for="kelas_id" class="block font-medium text-sm text-gray-700">Kelas</label>
                                <select name="kelas_id" id="kelas_id" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm" required>
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach($kelas as $kls)
                                        <option value="{{ $kls->id }}" {{ old('kelas_id') == $kls->id ? 'selected' : '' }}>
                                            {{ $kls->nama }} (Angkatan: {{ $kls->angkatan }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.surat-tugas.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
                                Batal
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Simpan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>