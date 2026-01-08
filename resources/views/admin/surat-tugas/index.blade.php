<x-app-layout>
    <div class="p-6 lg:p-10 bg-[#f8fafc] min-h-screen">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
            <div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tighter italic">Surat Tugas Mengajar</h1>
                <p class="text-slate-500 font-medium mt-1">Generate dan kelola surat penugasan dosen setiap semester.</p>
            </div>
            <a href="{{ route('admin.surat-tugas.create') }}" class="inline-flex items-center px-6 py-3 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-2xl shadow-lg shadow-amber-100 transition-all transform hover:-translate-y-1 no-underline">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Buat Surat Baru
            </a>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/60 border border-white overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-[11px] uppercase tracking-[0.2em] text-slate-400 font-black bg-slate-50/50">
                        <th class="px-8 py-5">Nomor Surat</th>
                        <th class="px-8 py-5">Nama Dosen</th>
                        <th class="px-8 py-5">Semester</th>
                        <th class="px-8 py-5 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($surats as $surat)
                    <tr class="hover:bg-amber-50/30 transition-colors group">
                        <td class="px-8 py-6 font-black text-slate-700">{{ $surat->nomor_surat }}</td>
                        <td class="px-8 py-6 font-bold text-slate-600">{{ $surat->dosen->nama_dosen }}</td>
                        <td class="px-8 py-6 font-medium text-slate-500">{{ $surat->semester_aktif }}</td>
                        <td class="px-8 py-6">
                            <div class="flex items-center justify-center space-x-2">
                                {{-- Tombol Cetak --}}
                                <a href="{{ route('admin.surat-tugas.print', $surat->id) }}" target="_blank" class="flex items-center px-4 py-2 bg-slate-800 text-white rounded-xl text-xs font-bold hover:bg-black transition-all no-underline">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                    Cetak PDF
                                </a>
                                {{-- Tombol Hapus --}}
                                <form action="{{ route('admin.surat-tugas.destroy', $surat->id) }}" method="POST" onsubmit="return confirm('Hapus surat ini?')">
                                    @csrf @method('DELETE')
                                    <button class="p-2 text-rose-500 hover:bg-rose-50 rounded-xl border-none bg-transparent cursor-pointer">
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
    </div>
</x-app-layout>