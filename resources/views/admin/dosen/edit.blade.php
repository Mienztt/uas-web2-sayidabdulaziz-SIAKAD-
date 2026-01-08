<x-app-layout>
    <div class="p-6 lg:p-10 bg-[#f8fafc] min-h-screen flex items-center justify-center">
        <div class="max-w-3xl w-full">
            
            <div class="text-center mb-10">
                <div class="mx-auto h-16 w-16 bg-amber-500 rounded-2xl flex items-center justify-center text-white shadow-2xl shadow-amber-200 mb-6 rotate-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tighter italic">Edit Data Dosen</h1>
                <p class="text-slate-500 font-medium mt-2">Perbarui informasi profil dan akun akses dosen.</p>
            </div>

            <div class="bg-white rounded-[3rem] shadow-[0_40px_80px_-15px_rgba(0,0,0,0.08)] p-8 lg:p-12 border border-white">
                
                @if ($errors->any())
                    <div class="mb-8 p-6 bg-rose-50 border-l-4 border-rose-500 rounded-2xl text-rose-700 shadow-sm">
                        <ul class="list-disc list-inside text-sm font-bold">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.dosens.update', $dosen->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-6">
                        
                        <div class="group">
                            <label for="nama_dosen" class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1 group-focus-within:text-amber-500 transition-colors mb-2 block">Nama Lengkap & Gelar</label>
                            <input type="text" name="nama_dosen" id="nama_dosen" 
                                   value="{{ old('nama_dosen', $dosen->nama_dosen) }}" 
                                   class="block w-full bg-slate-50 border-none focus:ring-4 focus:ring-amber-500/10 rounded-2xl py-4 px-6 font-bold text-slate-700 transition-all" required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="group">
                                <label for="nidn" class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1 group-focus-within:text-amber-500 transition-colors mb-2 block">NIDN</label>
                                <input type="text" name="nidn" id="nidn" 
                                       value="{{ old('nidn', $dosen->nidn) }}" 
                                       class="block w-full bg-slate-50 border-none focus:ring-4 focus:ring-amber-500/10 rounded-2xl py-4 px-6 font-bold text-slate-700 transition-all" required>
                            </div>

                            <div class="group">
                                <label for="inisial" class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1 group-focus-within:text-amber-500 transition-colors mb-2 block">Inisial (Contoh: SA)</label>
                                <input type="text" name="inisial" id="inisial" 
                                       value="{{ old('inisial', $dosen->inisial) }}" 
                                       class="block w-full bg-slate-50 border-none focus:ring-4 focus:ring-amber-500/10 rounded-2xl py-4 px-6 font-bold text-slate-700 transition-all">
                            </div>
                        </div>

                        <div class="group">
                            <label for="email" class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1 group-focus-within:text-amber-500 transition-colors mb-2 block">Email Akun (Untuk Login)</label>
                            <input type="email" name="email" id="email" 
                                   value="{{ old('email', $dosen->user->email ?? '') }}" 
                                   class="block w-full bg-slate-50 border-none focus:ring-4 focus:ring-amber-500/10 rounded-2xl py-4 px-6 font-bold text-slate-700 transition-all" required>
                            <p class="text-[10px] text-slate-400 mt-2 ml-1 italic">*Mengubah email ini juga akan merubah email login dosen tersebut.</p>
                        </div>

                    </div>

                    <div class="flex items-center justify-end gap-4 pt-8 border-t border-slate-50">
                        <a href="{{ route('admin.dosens.index') }}" class="text-sm font-bold text-slate-400 hover:text-slate-600 no-underline transition-colors">
                            Batalkan
                        </a>
                        <button type="submit" class="px-10 py-4 bg-amber-500 hover:bg-amber-600 text-white font-black rounded-2xl shadow-xl shadow-amber-100 transition-all active:scale-[0.98] border-none text-base">
                            Update Data Dosen
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>