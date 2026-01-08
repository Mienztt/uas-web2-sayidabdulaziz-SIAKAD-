<x-app-layout>
    <div class="p-6 lg:p-10 bg-[#f8fafc] min-h-screen">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
            <div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tighter italic">Master Mata Kuliah</h1>
                <p class="text-slate-500 font-medium mt-1">Kelola kurikulum dan bobot SKS program studi.</p>
            </div>
            <a href="{{ route('admin.mks.create') }}" class="inline-flex items-center px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-2xl shadow-lg shadow-emerald-100 transition-all transform hover:-translate-y-1 no-underline">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Mata Kuliah
            </a>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/60 border border-white overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-black bg-slate-50/50">
                            <th class="px-8 py-5">Kode MK</th>
                            <th class="px-8 py-5">Nama Mata Kuliah</th>
                            <th class="px-8 py-5 text-center">SKS</th>
                            <th class="px-8 py-5 text-center">Semester</th>
                            <th class="px-8 py-5 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($mks as $mk)
                        <tr class="hover:bg-emerald-50/30 transition-colors group">
                            <td class="px-8 py-6 font-black text-emerald-600 text-sm italic">{{ $mk->kode_mk }}</td>
                            <td class="px-8 py-6 font-bold text-slate-700">{{ $mk->nama_mk }}</td>
                            <td class="px-8 py-6 text-center">
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-lg text-xs font-black">{{ $mk->sks }} SKS</span>
                            </td>
                            <td class="px-8 py-6 text-center font-bold text-slate-500">Smstr {{ $mk->semester }}</td>
                            <td class="px-8 py-6">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('admin.mks.edit', $mk->id) }}" class="p-2 text-amber-500 hover:bg-amber-50 rounded-xl transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </a>
                                    <form action="{{ route('admin.mks.destroy', $mk->id) }}" method="POST" onsubmit="return confirm('Hapus MK ini?')">
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
            </div>
            <div class="p-8 bg-slate-50/50 border-t border-gray-50">
                {{ $mks->links() }}
            </div>
        </div>
    </div>
</x-app-layout>