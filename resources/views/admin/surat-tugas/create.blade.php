<x-app-layout>
    <div class="p-6 lg:p-10 bg-[#f8fafc] min-h-screen flex items-center justify-center">
        <div class="max-w-3xl w-full">
            <div class="text-center mb-10">
                <div class="mx-auto h-16 w-16 bg-amber-500 rounded-2xl flex items-center justify-center text-white shadow-2xl shadow-amber-200 mb-6 -rotate-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tighter italic">Buat Surat Tugas</h1>
                <p class="text-slate-500 font-medium mt-2">Generate nomor surat resmi untuk penugasan dosen.</p>
            </div>

            <div class="bg-white rounded-[3rem] shadow-[0_40px_80px_-15px_rgba(0,0,0,0.08)] p-8 lg:p-12 border border-white">
                <form action="{{ route('admin.surat-tugas.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 gap-6">
                        
                        <div class="group">
                            <label class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1 block mb-2">Nomor Surat</label>
                            <input type="text" name="nomor_surat" class="block w-full bg-slate-50 border-none focus:ring-4 focus:ring-amber-500/10 rounded-2xl py-4 px-6 font-bold text-slate-700 transition-all" placeholder="Contoh: 654/FKOM-UM/IX/2025" required>
                        </div>

                        <div class="group">
                            <label class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1 block mb-2">Dosen Penerima Tugas</label>
                            <select name="dosen_id" class="block w-full bg-slate-50 border-none focus:ring-4 focus:ring-amber-500/10 rounded-2xl py-4 px-6 font-bold text-slate-700 transition-all" required>
                                <option value="">-- Pilih Dosen --</option>
                                @foreach($dosens as $dosen)
                                    <option value="{{ $dosen->id }}">{{ $dosen->nama_dosen }} ({{ $dosen->nidn }})</option>
                                @endforeach
                            </select>
                            <p class="mt-2 text-xs text-slate-400 italic">*Jadwal akan ditarik otomatis berdasarkan dosen yang dipilih</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="group">
                                <label class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1 block mb-2">Semester Aktif</label>
                                <input type="text" name="semester_aktif" class="block w-full bg-slate-50 border-none focus:ring-4 focus:ring-amber-500/10 rounded-2xl py-4 px-6 font-bold text-slate-700 transition-all" placeholder="2025/2026 Ganjil" required>
                            </div>

                            <div class="group">
                                <label class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1 block mb-2">Tanggal Terbit</label>
                                <input type="date" name="tanggal_terbit" value="{{ date('Y-m-d') }}" class="block w-full bg-slate-50 border-none focus:ring-4 focus:ring-amber-500/10 rounded-2xl py-4 px-6 font-bold text-slate-700 transition-all" required>
                            </div>
                        </div>

                        @if(isset($mks) && isset($kelas))
                            <div class="hidden">
                                @foreach($mks as $mk) @endforeach
                                @foreach($kelas as $kls) @endforeach
                            </div>
                        @endif

                    </div>

                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-slate-50">
                        <a href="{{ route('admin.surat-tugas.index') }}" class="text-sm font-bold text-slate-400 no-underline hover:text-slate-600 transition-colors">Batal</a>
                        <button type="submit" class="px-10 py-4 bg-slate-900 hover:bg-black text-white font-black rounded-2xl shadow-xl shadow-slate-200 transition-all border-none">
                            Simpan & Terbitkan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>