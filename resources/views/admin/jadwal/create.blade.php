<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Jadwal Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.jadwal.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div>
                                <label for="mk_id" class="block font-medium text-sm text-gray-700">Mata Kuliah</label>
                                <select name="mk_id" id="mk_id" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm" required>
                                    <option value="">Pilih Mata Kuliah</option>
                                    @foreach($mks as $mk)
                                        <option value="{{ $mk->id }}" {{ old('mk_id') == $mk->id ? 'selected' : '' }}>
                                            {{ $mk->nama_mk }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="dosen_id" class="block font-medium text-sm text-gray-700">Dosen</label>
                                <select name="dosen_id" id="dosen_id" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm" required>
                                    <option value="">Pilih Dosen</option>
                                    @foreach($dosens as $dosen)
                                        <option value="{{ $dosen->id }}" {{ old('dosen_id') == $dosen->id ? 'selected' : '' }}>
                                            {{ $dosen->nama_dosen }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="ruang_id" class="block font-medium text-sm text-gray-700">Ruang</label>
                                <select name="ruang_id" id="ruang_id" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm" required>
                                    <option value="">Pilih Ruang</a_option>
                                    @foreach($ruangs as $ruang)
                                        <option value="{{ $ruang->id }}" {{ old('ruang_id') == $ruang->id ? 'selected' : '' }}>
                                            {{ $ruang->nama_ruang }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="shift_id" class="block font-medium text-sm text-gray-700">Shift (Hari, Waktu, Prodi)</label>
                                <select name="shift_id" id="shift_id" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm" required>
                                    <option value="">Pilih Shift</option>
                                    @foreach($shifts as $shift)
                                        <option value="{{ $shift->id }}" {{ old('shift_id') == $shift->id ? 'selected' : '' }}>
                                            {{ $shift->hari }} | 
                                            {{ \Carbon\Carbon::parse($shift->jam_mulai)->format('H:i') }}-{{ \Carbon\Carbon::parse($shift->jam_selesai)->format('H:i') }} | 
                                            {{ $shift->prodi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.jadwal.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
                                Batal
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Simpan Jadwal
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>