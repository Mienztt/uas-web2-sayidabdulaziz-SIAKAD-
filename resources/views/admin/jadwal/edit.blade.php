<x-app-layout>
    <div class="p-6 lg:p-10 bg-[#f8fafc] min-h-screen flex items-center justify-center">
        <div class="max-w-4xl w-full">
            
            <div class="text-center mb-10">
                <div class="mx-auto h-16 w-16 bg-indigo-600 rounded-2xl flex items-center justify-center text-white shadow-2xl shadow-indigo-200 mb-6 rotate-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tighter italic">Edit Jadwal Kuliah</h1>
                <p class="text-slate-500 font-medium mt-2">Perbarui detail waktu, ruang, atau dosen pengampu di bawah ini.</p>
            </div>

            <div class="bg-white rounded-[3rem] shadow-[0_40px_80px_-15px_rgba(0,0,0,0.08)] p-8 lg:p-12 border border-white">
                <form action="{{ route('admin.jadwal.update', $jadwal->id) }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        <div class="group">
                            <label for="mk_id" class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1 group-focus-within:text-indigo-600 transition-colors mb-2 block">Mata Kuliah</label>
                            <select name="mk_id" id="mk_id" class="block w-full bg-slate-50 border-slate-100 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-2xl py-4 px-6 transition-all text-slate-700 font-bold border-none appearance-none" required>
                                <option value="" disabled>-- Pilih Mata Kuliah --</option>
                                @foreach($mks as $mk)
                                    <option value="{{ $mk->id }}" {{ $jadwal->mk_id == $mk->id ? 'selected' : '' }}>
                                        {{ $mk->nama_mk }} ({{ $mk->kode_mk }})
                                    </option>
                                @endforeach
                            </select>
                            @error('mk_id') <p class="text-rose-500 text-xs mt-2 ml-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <div class="group">
                            <label for="dosen_id" class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1 group-focus-within:text-indigo-600 transition-colors mb-2 block">Dosen Pengampu</label>
                            <select name="dosen_id" id="dosen_id" class="block w-full bg-slate-50 border-slate-100 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-2xl py-4 px-6 transition-all text-slate-700 font-bold border-none appearance-none" required>
                                <option value="" disabled>-- Pilih Dosen --</option>
                                @foreach($dosens as $dosen)
                                    <option value="{{ $dosen->id }}" {{ $jadwal->dosen_id == $dosen->id ? 'selected' : '' }}>
                                        {{ $dosen->nama_dosen }}
                                    </option>
                                @endforeach
                            </select>
                            @error('dosen_id') <p class="text-rose-500 text-xs mt-2 ml-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <div class="group">
    <label for="ruang_id" class="text-[11px] font-black uppercase tracking-widest text-slate-400">Ruangan</label>
    <select name="ruang_id" id="ruang_id" class="block w-full bg-slate-50 border-none rounded-2xl py-4 px-6 font-bold" required>
        <option value="" disabled>-- Pilih Ruangan --</option>
        @foreach($ruangs as $ruang)
            <option value="{{ $ruang->id }}" {{ $jadwal->ruang_id == $ruang->id ? 'selected' : '' }}>
                {{ $ruang->nama_ruang }} {{-- <--- PASTIKAN PAKAI nama_ruang, BUKAN nama --}}
            </option>
        @endforeach
    </select>
</div>

                        <div class="group">
                            <label for="shift_id" class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1 group-focus-within:text-indigo-600 transition-colors mb-2 block">Waktu (Shift)</label>
                            <select name="shift_id" id="shift_id" class="block w-full bg-slate-50 border-slate-100 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-2xl py-4 px-6 transition-all text-slate-700 font-bold border-none appearance-none" required>
                                <option value="" disabled>-- Pilih Waktu --</option>
                                @foreach($shifts as $shift)
                                    <option value="{{ $shift->id }}" {{ $jadwal->shift_id == $shift->id ? 'selected' : '' }}>
                                        {{ $shift->hari }} ({{ $shift->jam_mulai }} - {{ $shift->jam_selesai }})
                                    </option>
                                @endforeach
                            </select>
                            @error('shift_id') <p class="text-rose-500 text-xs mt-2 ml-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <div class="group md:col-span-2">
                            <label for="prodi" class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1 group-focus-within:text-indigo-600 transition-colors mb-2 block">Program Studi / Keterangan</label>
                            <input type="text" name="prodi" id="prodi" value="{{ old('prodi', $jadwal->prodi) }}" 
                                   class="block w-full bg-slate-50 border-slate-100 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-2xl py-4 px-6 transition-all text-slate-700 font-bold border-none shadow-sm" 
                                   placeholder="Contoh: Sistem Informasi - Kelas A" required>
                            @error('prodi') <p class="text-rose-500 text-xs mt-2 ml-1 font-bold">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row items-center justify-end gap-4 pt-6 border-t border-slate-50">
                        <a href="{{ route('admin.jadwal.index') }}" class="w-full sm:w-auto text-center px-8 py-4 text-sm font-bold text-slate-400 hover:text-slate-600 transition-colors no-underline">
                            Batalkan Perubahan
                        </a>
                        <button type="submit" class="w-full sm:w-auto px-10 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-2xl shadow-xl shadow-indigo-100 transition-all active:scale-[0.98] border-none text-base tracking-tight">
                            Simpan Update Jadwal
                        </button>
                    </div>
                </form>
            </div>

            <p class="text-center text-slate-400 text-xs mt-8 font-medium italic">
                *Pastikan tidak ada bentrok waktu dan ruangan sebelum menyimpan perubahan.
            </p>
        </div>
    </div>
</x-app-layout>