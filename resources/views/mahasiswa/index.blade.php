<x-app-layout>
    <div class="min-h-screen bg-gray-50/50 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                <div>
                    <h2 class="text-3xl font-black text-gray-900 tracking-tight">Data Mahasiswa</h2>
                    <p class="text-gray-500 text-sm mt-1">Kelola data akademik mahasiswa aktif Fakultas Komputer.</p>
                </div>
                <div class="flex items-center gap-3">
                   <a href="{{ route('admin.mahasiswa.create') }}" class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-indigo-200 transition-all transform hover:-translate-y-0.5 no-underline hover:no-underline">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Data
                    </a>
                </div>
            </div>

            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 mb-6">
                <form action="{{ route('admin.mahasiswa.index') }}" method="GET" class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" 
                        class="w-full pl-12 pr-4 py-3 bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-xl transition-all text-sm font-medium" 
                        placeholder="Cari berdasarkan Nama, NIM, atau Prodi...">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-[1.5rem] shadow-xl shadow-gray-200/40 border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-500 text-[11px] font-bold uppercase tracking-wider border-b border-gray-200">
                                <th class="px-6 py-4">Mahasiswa</th>
                                <th class="px-6 py-4">NIM</th>
                                <th class="px-6 py-4">Program Studi</th>
                                <th class="px-6 py-4">Dosen Wali</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($mahasiswa as $mhs)
                            <tr class="hover:bg-gray-50/50 transition-colors group">
                                <td class="px-6 py-4 align-middle">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0 h-10 w-10 relative">
                                            @if($mhs->gambar_profil)
                                                <img class="h-10 w-10 rounded-full object-cover border border-gray-200 shadow-sm" src="{{ asset('storage/' . $mhs->gambar_profil) }}" alt="">
                                            @else
                                                <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xs border border-indigo-200">
                                                    {{ substr($mhs->nama, 0, 2) }}
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="text-sm font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">{{ $mhs->nama }}</div>
                                            <div class="text-xs text-gray-400">{{ $mhs->email ?? 'Mahasiswa Aktif' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-gray-100 text-gray-700 font-mono border border-gray-200">
                                        {{ $mhs->nim }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wide border
                                        {{ $mhs->prodi->nama_prodi == 'S1 Sistem Informasi' ? 'bg-purple-50 text-purple-700 border-purple-100' : 
                                          ($mhs->prodi->nama_prodi == 'D3 Komputerisasi Akuntansi' ? 'bg-sky-50 text-sky-700 border-sky-100' : 'bg-rose-50 text-rose-700 border-rose-100') }}">
                                        {{ $mhs->prodi->nama_prodi ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 align-middle text-sm text-gray-600 font-medium">
                                    {{ $mhs->dosenPembimbing->nama_dosen ?? '-' }}
                                </td>
                                <td class="px-6 py-4 align-middle text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('mahasiswa.show', $mhs->id) }}" class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition-all border border-blue-100 no-underline" title="Lihat Detail">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </a>
                                        <a href="{{ route('admin.mahasiswa.edit', $mhs->id) }}" class="p-2 bg-amber-50 text-amber-600 rounded-lg hover:bg-amber-500 hover:text-white transition-all border border-amber-100 no-underline" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <form action="{{ route('admin.mahasiswa.destroy', $mhs->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition-all border border-red-100" title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="bg-gray-50 p-4 rounded-full mb-3">
                                            <svg class="h-10 w-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                        <p class="font-medium text-gray-500">Tidak ada data mahasiswa ditemukan.</p>
                                        <p class="text-xs text-gray-400 mt-1">Coba kata kunci lain atau tambahkan data baru.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($mahasiswa->hasPages())
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    {{ $mahasiswa->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>