<x-app-layout>
    <div class="p-6 lg:p-10 bg-[#f8fafc] min-h-screen flex items-center justify-center">
        <div class="max-w-4xl w-full">
            
            <div class="text-center mb-10">
                <div class="mx-auto h-16 w-16 bg-blue-600 rounded-2xl flex items-center justify-center text-white shadow-2xl shadow-blue-200 mb-6 -rotate-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tighter italic">Tambah Jadwal Baru</h1>
                <p class="text-slate-500 font-medium mt-2">Pastikan tidak ada bentrok waktu dan ruangan sebelum menyimpan.</p>
            </div>

            <div class="bg-white rounded-[3rem] shadow-[0_40px_80px_-15px_rgba(0,0,0,0.08)] p-8 lg:p-12 border border-white">
                <form action="{{ route('admin.jadwal.store') }}" method="POST" class="space-y-8">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        <div class="group">
                            <label class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1 group-focus-within:text-blue-600 mb-2 block">Mata Kuliah</label>
                            <select name="mk_id" class="block w-full bg-slate-50 border-none focus:ring-4 focus:ring-blue-500/10 rounded-2xl py-4 px-6 transition-all text-slate-700 font-bold" required>
                                <option value="" disabled selected>-- Pilih Mata Kuliah --</option>
                                @foreach($mks as $mk)
                                    <option value="{{ $mk->id }}" {{ old('mk_id') == $mk->id ? 'selected' : '' }}>
                                        {{ $mk->nama_mk }} ({{ $mk->kode_mk }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="group">
                            <label class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1 group-focus-within:text-blue-600 mb-2 block">Dosen Pengampu</label>
                            <select name="dosen_id" class="block w-full bg-slate-50 border-none focus:ring-4 focus:ring-blue-500/10 rounded-2xl py-4 px-6 transition-all text-slate-700 font-bold" required>
                                <option value="" disabled selected>-- Pilih Dosen --</option>
                                @foreach($dosens as $dosen)
                                    <option value="{{ $dosen->id }}" {{ old('dosen_id') == $dosen->id ? 'selected' : '' }}>
                                        {{ $dosen->nama_dosen }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="group">
                            <label class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1 group-focus-within:text-blue-600 mb-2 block">Ruangan</label>
                            <select name="ruang_id" class="block w-full bg-slate-50 border-none focus:ring-4 focus:ring-blue-500/10 rounded-2xl py-4 px-6 transition-all text-slate-700 font-bold" required>
                                <option value="" disabled selected>-- Pilih Ruangan --</option>
                                @foreach($ruangs as $ruang)
                                    <option value="{{ $ruang->id }}" {{ old('ruang_id') == $ruang->id ? 'selected' : '' }}>
                                        {{ $ruang->nama_ruang }} {{-- <--- SAMA: pakai nama_ruang --}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="group">
                            <label class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1 group-focus-within:text-blue-600 mb-2 block">Shift (Waktu)</label>
                            <select name="shift_id" class="block w-full bg-slate-50 border-none focus:ring-4 focus:ring-blue-500/10 rounded-2xl py-4 px-6 transition-all text-slate-700 font-bold" required>
                                <option value="" disabled selected>-- Pilih Shift --</option>
                                @foreach($shifts as $shift)
                                    <option value="{{ $shift->id }}" {{ old('shift_id') == $shift->id ? 'selected' : '' }}>
                                        {{ $shift->hari }} | {{ $shift->jam_mulai }} - {{ $shift->jam_selesai }} ({{ $shift->prodi }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-6 border-t">
                        <a href="{{ route('admin.jadwal.index') }}" class="text-sm font-bold text-slate-400 hover:text-slate-600 no-underline">Batal</a>
                        <button type="submit" class="px-10 py-4 bg-blue-600 hover:bg-blue-700 text-white font-black rounded-2xl shadow-xl shadow-blue-100 transition-all active:scale-[0.98] border-none">
                            Simpan Jadwal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>