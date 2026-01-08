<x-app-layout>
    <div class="p-6 lg:p-10 bg-[#f8fafc] min-h-screen flex items-center justify-center">
        <div class="max-w-3xl w-full">
            <div class="text-center mb-10">
                <div class="mx-auto h-16 w-16 bg-emerald-600 rounded-2xl flex items-center justify-center text-white shadow-2xl shadow-emerald-200 mb-6 -rotate-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tighter italic">Tambah Mata Kuliah</h1>
                <p class="text-slate-500 font-medium mt-2">Masukkan detail kurikulum baru untuk program studi.</p>
            </div>

            <div class="bg-white rounded-[3rem] shadow-[0_40px_80px_-15px_rgba(0,0,0,0.08)] p-8 lg:p-12 border border-white">
                <form action="{{ route('admin.mks.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 gap-6">
                        <div class="group">
                            <label class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1 block mb-2">Kode Mata Kuliah</label>
                            <input type="text" name="kode_mk" class="block w-full bg-slate-50 border-none focus:ring-4 focus:ring-emerald-500/10 rounded-2xl py-4 px-6 font-bold text-slate-700 transition-all uppercase" placeholder="Contoh: MK001" required>
                        </div>

                        <div class="group">
                            <label class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1 block mb-2">Nama Mata Kuliah</label>
                            <input type="text" name="nama_mk" class="block w-full bg-slate-50 border-none focus:ring-4 focus:ring-emerald-500/10 rounded-2xl py-4 px-6 font-bold text-slate-700 transition-all" placeholder="Contoh: Pemrograman Web" required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="group">
                                <label class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1 block mb-2">Bobot SKS</label>
                                <select name="sks" class="block w-full bg-slate-50 border-none focus:ring-4 focus:ring-emerald-500/10 rounded-2xl py-4 px-6 font-bold text-slate-700" required>
                                    @for($i=1; $i<=6; $i++)
                                        <option value="{{ $i }}">{{ $i }} SKS</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="group">
                                <label class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1 block mb-2">Semester</label>
                                <select name="semester" class="block w-full bg-slate-50 border-none focus:ring-4 focus:ring-emerald-500/10 rounded-2xl py-4 px-6 font-bold text-slate-700" required>
                                    @for($i=1; $i<=8; $i++)
                                        <option value="{{ $i }}">Semester {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-slate-50">
                        <a href="{{ route('admin.mks.index') }}" class="text-sm font-bold text-slate-400 no-underline hover:text-slate-600">Batal</a>
                        <button type="submit" class="px-10 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-black rounded-2xl shadow-xl shadow-emerald-100 transition-all border-none">
                            Simpan MK
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>