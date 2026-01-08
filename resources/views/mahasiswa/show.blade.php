<x-app-layout>
    <div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl w-full">
            
            <div class="mb-6">
                <a href="{{ route('admin.mahasiswa.index') }}" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-indigo-600 transition-colors">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    Kembali ke Daftar
                </a>
            </div>

            <div class="bg-white rounded-[2rem] shadow-2xl overflow-hidden flex flex-col md:flex-row">
                
                <div class="w-full md:w-1/3 bg-indigo-600 p-10 flex flex-col items-center justify-center text-center text-white relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-full bg-indigo-500 opacity-20" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 20px 20px;"></div>
                    
                    <div class="relative z-10">
                        @if($mahasiswa->gambar_profil)
                            <img src="{{ asset('storage/' . $mahasiswa->gambar_profil) }}" 
                                 class="w-40 h-40 rounded-full object-cover border-4 border-white/30 shadow-lg mb-4 mx-auto">
                        @else
                            <div class="w-40 h-40 rounded-full bg-white/10 flex items-center justify-center text-indigo-100 border-4 border-white/20 mb-4 mx-auto backdrop-blur-sm">
                                <span class="text-4xl font-bold">{{ substr($mahasiswa->nama, 0, 2) }}</span>
                            </div>
                        @endif
                        
                        <h2 class="text-xl font-bold">{{ $mahasiswa->nama }}</h2>
                        <p class="text-indigo-200 text-sm font-mono mt-1">{{ $mahasiswa->nim }}</p>
                        
                        <div class="mt-6">
                            <span class="px-3 py-1 bg-white/20 rounded-full text-xs font-bold uppercase tracking-wider backdrop-blur-md border border-white/20">
                                Mahasiswa Aktif
                            </span>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-2/3 p-10">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <span class="bg-indigo-100 text-indigo-600 p-2 rounded-lg mr-3"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg></span>
                        Informasi Akademik
                    </h3>

                    <div class="space-y-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Program Studi</label>
                                <p class="text-gray-900 font-bold text-lg mt-1">{{ $mahasiswa->prodi->nama_prodi ?? '-' }}</p>
                            </div>
                            <div>
                                <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Dosen Pembimbing</label>
                                <p class="text-gray-900 font-bold text-lg mt-1">{{ $mahasiswa->dosenPembimbing->nama_dosen ?? 'Belum Ditentukan' }}</p>
                            </div>
                            <div class="sm:col-span-2">
                                <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Alamat Lengkap</label>
                                <p class="text-gray-700 mt-1 leading-relaxed">{{ $mahasiswa->alamat ?? 'Alamat belum diisi.' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 pt-6 border-t border-gray-100 flex justify-end space-x-3">
                        <form action="{{ route('admin.mahasiswa.destroy', $mahasiswa->id) }}" method="POST" onsubmit="return confirm('Hapus mahasiswa ini?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="px-4 py-2 text-red-600 hover:bg-red-50 rounded-lg font-bold text-sm transition-colors">
                                Hapus
                            </button>
                        </form>
                        <a href="{{ route('admin.mahasiswa.edit', $mahasiswa->id) }}" class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-bold shadow-lg shadow-indigo-200 transition-all">
                            Edit Profil
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>