<x-app-layout>
    <div class="p-6 lg:p-10 bg-[#f8fafc] min-h-screen">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
            <div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tighter italic">Pengaturan Jadwal</h1>
                <p class="text-slate-500 font-medium mt-1">Kelola seluruh jadwal perkuliahan dalam satu pintu.</p>
            </div>
            
            <a href="{{ route('admin.jadwal.create') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-2xl shadow-lg shadow-indigo-100 transition-all transform hover:-translate-y-1 no-underline">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Tambah Jadwal Baru
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100">
                <div class="flex items-center space-x-4">
                    <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">Total Sesi</p>
                        <h3 class="text-2xl font-black text-slate-800">{{ $jadwals->total() }} Sesi</h3>
                    </div>
                </div>
            </div>
            </div>

        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/60 border border-white overflow-hidden">
            <div class="p-8 border-b border-gray-50 bg-slate-50/50">
                <form action="{{ route('admin.jadwal.index') }}" method="GET" class="relative max-w-md">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           class="w-full pl-12 pr-4 py-4 bg-white border-none rounded-2xl shadow-sm focus:ring-4 focus:ring-indigo-500/10 font-medium text-slate-600" 
                           placeholder="Cari Mata Kuliah atau Dosen...">
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-black bg-slate-50/50">
                            <th class="px-8 py-5">Mata Kuliah</th>
                            <th class="px-8 py-5">Dosen</th>
                            <th class="px-8 py-5">Ruang & Waktu</th>
                            <th class="px-8 py-5 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($jadwals as $j)
                        <tr class="hover:bg-indigo-50/30 transition-colors group">
                            <td class="px-8 py-6">
                                <div class="font-black text-slate-700">{{ $j->mk->nama_mk }}</div>
                                <div class="text-xs font-bold text-slate-400 mt-0.5">
                                {{ $j->kelas?->nama ?? 'Tanpa Kelas' }}
                                                            </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xs">
                                        {{ substr($j->dosen->nama_dosen, 0, 1) }}
                                    </div>
                                    <span class="font-bold text-slate-600 text-sm">{{ $j->dosen->nama_dosen }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="inline-flex items-center px-3 py-1 bg-emerald-50 text-emerald-600 rounded-lg text-xs font-black mb-1">
                                    {{ $j->ruang->nama_ruang }}
                                </div>
                                <div class="text-xs font-bold text-slate-400 italic">
                                    {{ $j->hari }}, {{ $j->shift->jam_mulai }} - {{ $j->shift->jam_selesai }}
                                </div>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('admin.jadwal.edit', $j->id) }}" class="p-2 text-amber-500 hover:bg-amber-50 rounded-xl transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </a>
                                    <form action="{{ route('admin.jadwal.destroy', $j->id) }}" method="POST" onsubmit="return confirm('Hapus jadwal ini?')">
                                        @csrf @method('DELETE')
                                        <button class="p-2 text-rose-500 hover:bg-rose-50 rounded-xl transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-8 bg-slate-50/50">
                {{ $jadwals->links() }}
            </div>
        </div>
    </div>
</x-app-layout>