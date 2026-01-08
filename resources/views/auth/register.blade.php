<x-guest-layout>
    <div class="min-h-screen bg-[radial-gradient(ellipse_at_top_left,_var(--tw-gradient-stops))] from-slate-900 via-indigo-800 to-blue-600 flex items-center justify-center p-6 lg:p-12">
        
        <div class="w-full max-w-[1100px] min-h-[700px] bg-white/95 backdrop-blur-xl rounded-[3rem] shadow-[0_50px_100px_-20px_rgba(0,0,0,0.3)] overflow-hidden flex flex-col lg:flex-row border border-white/20">
            
            <div class="w-full lg:w-[40%] bg-indigo-600 p-12 lg:p-16 text-white flex flex-col justify-between relative overflow-hidden">
                <div class="absolute top-0 left-0 -ml-10 -mt-10 w-40 h-40 bg-sky-400/20 rounded-full blur-2xl"></div>
                
                <div class="relative z-10">
                    <div class="h-14 w-14 bg-white/20 rounded-2xl flex items-center justify-center text-2xl font-black border border-white/30 backdrop-blur-md">
                        SI
                    </div>
                </div>

                <div class="relative z-10 space-y-6">
                    <h1 class="text-4xl lg:text-5xl font-black leading-tight tracking-tighter">
                        Gabung ke <br/><span class="text-sky-300">SIAKAD.</span>
                    </h1>
                    <p class="text-indigo-50 text-lg font-medium opacity-90 leading-relaxed">
                        Daftarkan akun anda untuk mulai mengelola data akademik dan memantau perkuliahan secara digital.
                    </p>
                    
                    <ul class="space-y-4 text-sm font-bold text-indigo-100 uppercase tracking-widest">
                        <li class="flex items-center space-x-3">
                            <span class="h-1.5 w-1.5 bg-sky-300 rounded-full"></span>
                            <span>Akses Jadwal Real-time</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <span class="h-1.5 w-1.5 bg-sky-300 rounded-full"></span>
                            <span>Manajemen Profil Mandiri</span>
                        </li>
                    </ul>
                </div>

                <div class="relative z-10 text-[10px] font-bold uppercase tracking-[0.3em] text-indigo-300/80 pt-8 border-t border-white/10">
                    SIAKAD Management &copy; 2026
                </div>
            </div>

            <div class="w-full lg:w-[60%] p-10 lg:p-20 flex flex-col justify-center bg-white">
                <div class="mb-10">
                    <h2 class="text-3xl font-black text-slate-900 tracking-tight">Buat Akun Baru</h2>
                    <p class="text-slate-500 mt-2 font-medium">Lengkapi data diri anda di bawah ini.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div class="group">
                        <x-input-label for="name" :value="__('Nama Lengkap')" class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1 group-focus-within:text-indigo-600 transition-colors" />
                        <x-text-input id="name" class="block w-full bg-slate-50 border-slate-100 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-2xl py-4 px-6 transition-all text-slate-700 font-bold" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-1 ml-1" />
                    </div>

                    <div class="group">
                        <x-input-label for="email" :value="__('Email')" class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1 group-focus-within:text-indigo-600 transition-colors" />
                        <x-text-input id="email" class="block w-full bg-slate-50 border-slate-100 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-2xl py-4 px-6 transition-all text-slate-700 font-bold" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1 ml-1" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="group">
                            <x-input-label for="password" :value="__('Password')" class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1 group-focus-within:text-indigo-600 transition-colors" />
                            <x-text-input id="password" class="block w-full bg-slate-50 border-slate-100 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-2xl py-4 px-6 transition-all text-slate-700 font-bold" type="password" name="password" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-1 ml-1" />
                        </div>

                        <div class="group">
                            <x-input-label for="password_confirmation" :value="__('Konfirmasi')" class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1 group-focus-within:text-indigo-600 transition-colors" />
                            <x-text-input id="password_confirmation" class="block w-full bg-slate-50 border-slate-100 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-2xl py-4 px-6 transition-all text-slate-700 font-bold" type="password" name="password_confirmation" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 ml-1" />
                        </div>
                        
                    </div>

                    <div class="flex items-center justify-between pt-4">
                        <a class="text-sm font-bold text-slate-400 hover:text-indigo-600 transition-colors italic underline underline-offset-4" href="{{ route('login') }}">
                            {{ __('Sudah punya akun?') }}
                        </a>

                        <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 text-white font-black py-4 px-8 rounded-2xl shadow-xl shadow-indigo-200 transition-all active:scale-[0.96] border-none text-base">
                            {{ __('Daftar Sekarang') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>