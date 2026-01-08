<x-app-layout>
    <div class="p-6 lg:p-10 bg-[#f8fafc] min-h-screen flex items-center justify-center">
        <div class="max-w-3xl w-full">
            <div class="text-center mb-10">
                <h1 class="text-4xl font-black text-slate-900 tracking-tighter italic">Tambah Dosen</h1>
                <p class="text-slate-500 font-medium mt-2">Data ini akan digunakan untuk manajemen jadwal dan akun login.</p>
            </div>

            <div class="bg-white rounded-[3rem] shadow-xl p-8 lg:p-12 border border-white">
                <form action="{{ route('admin.dosens.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 gap-6">
                        <div class="group">
                            <label class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1 block mb-2">Nama Lengkap & Gelar</label>
                            <input type="text" name="nama_dosen" class="block w-full bg-slate-50 border-none focus:ring-4 focus:ring-indigo-500/10 rounded-2xl py-4 px-6 font-bold text-slate-700" placeholder="Contoh: Dr. Sayid Aziz, M.Kom" required>
                        </div>

                        <div class="group">
                            <label class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1 block mb-2">NIDN</label>
                            <input type="text" name="nidn" class="block w-full bg-slate-50 border-none focus:ring-4 focus:ring-indigo-500/10 rounded-2xl py-4 px-6 font-bold text-slate-700" placeholder="Nomor Induk Dosen Nasional" required>
                        </div>

                        <div class="group">
                            <label class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1 block mb-2">Email Login (Wajib)</label>
                            <input type="email" name="email" class="block w-full bg-slate-50 border-none focus:ring-4 focus:ring-indigo-500/10 rounded-2xl py-4 px-6 font-bold text-slate-700" placeholder="dosen@kampus.ac.id" required>
                            <p class="text-[10px] text-slate-400 mt-2 ml-1 italic">*Password default adalah: **password123**</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-6">
                        <a href="{{ route('admin.dosens.index') }}" class="text-sm font-bold text-slate-400 no-underline">Batal</a>
                        <button type="submit" class="px-10 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-2xl shadow-xl shadow-indigo-100 transition-all border-none">
                            Simpan & Buat Akun
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>