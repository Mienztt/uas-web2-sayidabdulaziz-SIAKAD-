<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Jadwal Kuliah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                {{-- Header: Tombol Tambah & Form Pencarian --}}
                <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                    <a href="{{ route('admin.jadwal.create') }}" class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow transition text-center">
                        + Tambah Jadwal
                    </a>

                    <form action="{{ route('admin.jadwal.index') }}" method="GET" class="flex w-full md:w-auto gap-2">
                        <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Cari dosen, MK, atau prodi..." 
                               class="w-full md:w-64 border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">
                        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition">
                            Cari
                        </button>
                    </form>
                </div>

                {{-- Alert Success --}}
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Tabel Jadwal --}}
                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Kuliah</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dosen</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu & Ruang</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prodi</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($jadwals as $item)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ ($jadwals->currentPage()-1) * $jadwals->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-bold text-gray-900">{{ $item->mk->nama_mk ?? '-' }}</div>
                                        <div class="text-xs text-gray-500 font-mono">{{ $item->mk->kode_mk ?? '' }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $item->dosen->nama_dosen ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        <div class="flex flex-col">
                                            <span>🗓️ {{ $item->shift->hari ?? '-' }}</span>
                                            <span>⏰ {{ \Carbon\Carbon::parse($item->shift->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($item->shift->jam_selesai)->format('H:i') }}</span>
                                            <span class="font-semibold text-blue-600">📍 Ruang: {{ $item->ruang->nama ?? '-' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600 font-medium">
                                        {{ $item->prodi }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <div class="flex justify-center items-center space-x-3">
                                            <a href="{{ route('admin.jadwal.edit', $item->id) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 px-3 py-1 rounded">
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.jadwal.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 px-3 py-1 rounded">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-10 text-center text-gray-500 italic">
                                        Belum ada data jadwal kuliah yang terdaftar.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination Links --}}
                <div class="mt-6">
                    {{ $jadwals->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>