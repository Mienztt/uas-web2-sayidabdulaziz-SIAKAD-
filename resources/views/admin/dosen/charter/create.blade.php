<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Charter Jadwal Kuliah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h3 class="text-lg font-semibold mb-2">Detail Slot Kosong</h3>

                    <div class="mb-6 p-4 bg-gray-100 rounded-lg">
                        <p><strong>Hari:</strong> {{ $shift->hari }}</p>
                        <p><strong>Waktu:</strong> {{ \Carbon\Carbon::parse($shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($shift->jam_selesai)->format('H:i') }}</p>
                        <p><strong>Prodi:</strong> {{ $shift->prodi }}</p>
                    </div>

                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('dosen.charter.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="shift_id" value="{{ $shift->id }}">

                        <div class="space-y-4">

                            <div>
                                <label for="surat_tugas_id" class="block font-medium text-sm text-gray-700">Pilih Surat Tugas Mengajar Anda</label>
                                <select name="surat_tugas_id" id="surat_tugas_id" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm" required>
                                    <option value="">-- Pilih Mata Kuliah yang Akan Diajarkan --</option>
                                    @forelse($suratTugasList as $st)
                                        <option value="{{ $st->id }}" {{ old('surat_tugas_id') == $st->id ? 'selected' : '' }}>
                                            {{ $st->mataKuliah->nama_mk }} (Untuk Kelas: {{ $st->kelas->nama }})
                                        </option>
                                    @empty
                                        <option value="" disabled>Anda tidak memiliki Surat Tugas yang tersedia (belum terjadwal).</option>
                                    @endforelse
                                </select>
                                <p class="text-xs text-gray-600 mt-1">Hanya menampilkan Surat Tugas yang belum mendapatkan jadwal.</p>
                            </div>

                            <div>
                                <label for="ruang_id" class="block font-medium text-sm text-gray-700">Pilih Ruangan</label>
                                <select name="ruang_id" id="ruang_id" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm" required>
                                    <option value="">-- Pilih Ruangan --</option>
                                    @foreach($ruangs as $ruang)
                                        <option value="{{ $ruang->id }}" {{ old('ruang_id') == $ruang->id ? 'selected' : '' }}>
                                            {{ $ruang->nama_ruang }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('jadwal') }}" class="text-gray-600 hover:text-gray-900 mr-4">
                                Batal
                            </a>
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                                @if($suratTugasList->isEmpty()) disabled @endif>
                                Charter Slot Ini
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>