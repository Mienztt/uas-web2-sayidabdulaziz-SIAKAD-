<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Surat Tugas Mengajar (Dekan)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">{{ session('error') }}</div>
                    @endif

                    <div class="mb-4">
                        <a href="{{ route('admin.surat-tugas.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            + Buat Surat Tugas Baru
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-300">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-2 px-4 border-b">Dosen</th>
                                    <th class="py-2 px-4 border-b">Mata Kuliah</th>
                                    <th class="py-2 px-4 border-b">Kelas</th>
                                    <th class="py-2 px-4 border-b">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($suratTugas as $st)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-2 px-4 border-b">{{ $st->dosen->name ?? 'N/A' }}</td>
                                        <td class="py-2 px-4 border-b">{{ $st->mataKuliah->nama_mk ?? 'N/A' }}</td>
                                        <td class="py-2 px-4 border-b">{{ $st->kelas->nama ?? 'N/A' }}</td>
                                        
                                        <td class="py-2 px-4 border-b whitespace-nowrap">
                                            <a href="{{ route('admin.surat-tugas.cetak', $st->id) }}" 
                                               target="_blank" 
                                               class="text-green-600 hover:text-green-900 mr-2">
                                               Cetak
                                            </a>
                                            
                                            <a href="{{ route('admin.surat-tugas.edit', $st->id) }}" class="text-yellow-600 hover:text-yellow-900 mr-2">Ubah</a>
                                            
                                            <form action="{{ route('admin.surat-tugas.destroy', $st->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus surat tugas ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-4 px-4 border-b text-center text-gray-500">
                                            Belum ada surat tugas dibuat.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $suratTugas->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>