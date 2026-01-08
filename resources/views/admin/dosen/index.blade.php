

<x-app-layout>
    <div class="p-6 lg:p-10 bg-[#f8fafc] min-h-screen">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
            <div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tighter italic">Master Data Dosen</h1>
                <p class="text-slate-500 font-medium mt-1">Manajemen data pengampu mata kuliah dan akun akses.</p>
            </div>
            <a href="{{ route('admin.dosens.create') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-2xl shadow-lg shadow-indigo-100 transition-all transform hover:-translate-y-1 no-underline">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                Tambah Dosen
            </a>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/60 border border-white overflow-hidden">
            <div class="p-8 border-b border-gray-50 bg-slate-50/50">
                <form action="{{ route('admin.dosens.index') }}" method="GET" class="relative max-w-md">
                    <input type="text" name="search" value="{{ request('search') }}" class="w-full pl-12 pr-4 py-4 bg-white border-none rounded-2xl shadow-sm focus:ring-4 focus:ring-indigo-500/10 font-medium text-slate-600" placeholder="Cari NIDN atau Nama Dosen...">
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-black bg-slate-50/50">
                            <th class="px-8 py-5">Dosen</th>
                            <th class="px-8 py-5">NIDN</th>
                            <th class="px-8 py-5">Email Akun</th>
                            <th class="px-8 py-5 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($dosens as $dosen)
                        <tr class="hover:bg-indigo-50/30 transition-colors group">
                            <td class="px-8 py-6">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-black text-lg shadow-lg shadow-indigo-100">
                                        {{ substr($dosen->nama_dosen, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="font-black text-slate-700">{{ $dosen->nama_dosen }}</div>
                                        <div class="text-xs font-bold text-slate-400 uppercase tracking-tighter">Dosen Tetap</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-lg text-xs font-black">{{ $dosen->nidn }}</span>
                            </td>
                            <td class="px-8 py-6 font-bold text-slate-500 text-sm">
                                {{ $dosen->user->email ?? 'Akun belum dibuat' }}
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('admin.dosens.edit', $dosen->id) }}" class="p-2 text-amber-500 hover:bg-amber-50 rounded-xl transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </a>
                                    <form action="{{ route('admin.dosens.destroy', $dosen->id) }}" method="POST" onsubmit="return confirm('Hapus data dosen ini?')">
                                        @csrf @method('DELETE')
                                        <button class="p-2 text-rose-500 hover:bg-rose-50 rounded-xl transition-all border-none bg-transparent cursor-pointer">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-8 bg-slate-50/50 border-t border-gray-50">
    {{ $dosens->links() }}
</div>
            </div>
        </div>
    </div>
</x-app-layout>