<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Jadwal Kuliah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('admin.jadwal.update', $jadwal->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        {{-- Dropdown Mata Kuliah --}}
                        <div class="mb-4">
                            <label for="mk_id" class="block text-sm font-medium text-gray-700 mb-1">Mata Kuliah</label>
                            <select name="mk_id" id="mk_id" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500" required>
                                <option value="">-- Pilih Mata Kuliah --</option>
                                @foreach($mks as $mk)
                                    <option value="{{ $mk->id }}" {{ $jadwal->mk_id == $mk->id ? 'selected' : '' }}>
                                        {{ $mk->nama_mk }} ({{ $mk->kode_mk }})
                                    </option>
                                @endforeach
                            </select>
                            @error('mk_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Dropdown Dosen --}}
                        <div class="mb-4">
                            <label for="dosen_id" class="block text-sm font-medium text-gray-700 mb-1">Dosen Pengampu</label>
                            <select name="dosen_id" id="dosen_id" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500" required>
                                <option value="">-- Pilih Dosen --</option>
                                @foreach($dosens as $dosen)
                                    <option value="{{ $dosen->id }}" {{ $jadwal->dosen_id == $dosen->id ? 'selected' : '' }}>
                                        {{ $dosen->nama_dosen }}
                                    </option>
                                @endforeach
                            </select>
                            @error('dosen_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Dropdown Ruangan --}}
                        <div class="mb-4">
                            <label for="ruang_id" class="block text-sm font-medium text-gray-700 mb-1">Ruangan</label>
                            <select name="ruang_id" id="ruang_id" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500" required>
                                <option value="">-- Pilih Ruangan --</option>
                                @foreach($ruangs as $ruang)
                                    <option value="{{ $ruang->id }}" {{ $jadwal->ruang_id == $ruang->id ? 'selected' : '' }}>
                                        {{ $ruang->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ruang_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Dropdown Shift/Waktu --}}
                        <div class="mb-4">
                            <label for="shift_id" class="block text-sm font-medium text-gray-700 mb-1">Waktu (Shift)</label>
                            <select name="shift_id" id="shift_id" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500" required>
                                <option value="">-- Pilih Waktu --</option>
                                @foreach($shifts as $shift)
                                    <option value="{{ $shift->id }}" {{ $jadwal->shift_id == $shift->id ? 'selected' : '' }}>
                                        {{ $shift->hari }} ({{ $shift->jam_mulai }} - {{ $shift->jam_selesai }})
                                    </option>
                                @endforeach
                            </select>
                            @error('shift_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Input Prodi --}}
                        <div class="mb-4 md:col-span-2">
                            <label for="prodi" class="block text-sm font-medium text-gray-700 mb-1">Program Studi</label>
                            <input type="text" name="prodi" id="prodi" value="{{ old('prodi', $jadwal->prodi) }}" 
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500" required>
                            @error('prodi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                    </div>

                    <div class="flex justify-end gap-3 mt-6 border-t pt-6">
                        <a href="{{ route('admin.jadwal.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>