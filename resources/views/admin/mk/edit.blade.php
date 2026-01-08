<x-app-layout>
    <div class="p-6 lg:p-10 bg-[#f8fafc] min-h-screen flex items-center justify-center">
        <div class="max-w-3xl w-full">
            <div class="text-center mb-10">
                <div class="mx-auto h-16 w-16 bg-amber-500 rounded-2xl flex items-center justify-center text-white shadow-2xl shadow-amber-200 mb-6 rotate-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tighter italic">Edit Mata Kuliah</h1>
                <p class="text-slate-500 font-medium mt-2">Sesuaikan kembali informasi mata kuliah yang dipilih.</p>
            </div>

            <div class="bg-white rounded-[3rem] shadow-[0_40px_80px_-15px_rgba(0,0,0,0.08)] p-8 lg:p-12 border border-white">
                <form action="{{ route('admin.mks.update', $mk->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 gap-6">
                        <div class="group">
                            <label class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1 block mb-2">Kode Mata Kuliah</label>
                            <input type="text" name="kode_mk" value="{{ old('kode_mk', $mk->kode_mk) }}" class="block w-full bg-slate-50 border-none focus:ring-4 focus:ring-amber-500/10 rounded-2xl py-4 px-6 font-bold text-slate-700 transition-all uppercase" required>
                        </div>

                        <div class="group">
                            <label class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1 block mb-2">Nama Mata Kuliah</label>
                            <input type="text" name="nama_mk" value="{{ old('nama_mk', $mk->nama_mk) }}" class="block w-full bg-slate-50 border-none focus:ring-4 focus:ring-amber-500/10 rounded-2xl py-4 px-6 font-bold text-slate-700 transition-all" required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="group">
                                <label class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1 block mb-2">Bobot SKS</label>
                                <select name="sks" class="block w-full bg-slate-50 border-none focus:ring-4 focus:ring-amber-500/10 rounded-2xl py-4 px-6 font-bold text-slate-700">
                                    @for($i=1; $i<=6; $i++)
                                        <option value="{{ $i }}" {{ $mk->sks == $i ? 'selected' : '' }}>{{ $i }} SKS</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="group">
                                <label class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1 block mb-2">Semester</label>
                                <select name="semester" class="block w-full bg-slate-50 border-none focus:ring-4 focus:ring-amber-500/10 rounded-2xl py-4 px-6 font-bold text-slate-700">
                                    @for($i=1; $i<=8; $i++)
                                        <option value="{{ $i }}" {{ $mk->semester == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-slate-50">
                        <a href="{{ route('admin.mks.index') }}" class="text-sm font-bold text-slate-400 no-underline">Batal</a>
                        <button type="submit" class="px-10 py-4 bg-amber-500 hover:bg-amber-600 text-white font-black rounded-2xl shadow-xl shadow-amber-100 transition-all border-none">
                            Update MK
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>