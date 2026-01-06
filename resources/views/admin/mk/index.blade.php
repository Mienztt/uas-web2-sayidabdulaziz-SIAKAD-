<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Master Data Mata Kuliah') }}
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
                        <a href="{{ route('admin.mks.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            + Tambah Mata Kuliah Baru
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-300">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-2 px-4 border-b">Nama Mata Kuliah</th>
                                    <th class="py-2 px-4 border-b">Kode MK</th>
                                    <th class="py-2 px-4 border-b">SKS</th>
                                    <th class="py-2 px-4 border-b">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($mks as $mk)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-2 px-4 border-b">{{ $mk->nama_mk }}</td>
                                        <td class="py-2 px-4 border-b">{{ $mk->kode_mk }}</td>
                                        <td class="py-2 px-4 border-b">{{ $mk->sks }}</td>
                                        <td class="py-2 px-4 border-b">
                                            <a href="{{ route('admin.mks.edit', $mk->id) }}" class="text-yellow-600 hover:text-yellow-900 mr-2">Edit</a>
                                            <form action="{{ route('admin.mks.destroy', $mk->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus mata kuliah ini?');">
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
                                            Tidak ada data mata kuliah.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $mks->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>