<x-guest-layout>
    <div class="min-h-screen bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-indigo-900 via-blue-700 to-sky-500 flex items-center justify-center p-6 lg:p-12">
        
        <div class="w-full max-w-[1100px] min-h-[650px] bg-white/95 backdrop-blur-xl rounded-[3rem] shadow-[0_50px_100px_-20px_rgba(0,0,0,0.25)] overflow-hidden flex flex-col lg:flex-row border border-white/20">
            
            <div class="w-full lg:w-[45%] bg-indigo-600 p-12 lg:p-20 text-white flex flex-col justify-between relative overflow-hidden">
                <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -ml-10 -mb-10 w-40 h-40 bg-sky-400/20 rounded-full blur-2xl"></div>

                <div class="relative z-10">
                    <div class="h-16 w-16 bg-white/20 rounded-2xl flex items-center justify-center text-3xl font-black border border-white/30 shadow-xl backdrop-blur-md">
                        SI
                    </div>
                </div>

                <div class="relative z-10 space-y-6">
                    <h1 class="text-5xl lg:text-7xl font-black leading-[0.85] tracking-tighter italic">
                        SIAKAD<br/><span class="text-sky-300">PORTAL.</span>
                    </h1>
                    <p class="text-indigo-50 text-xl font-medium leading-relaxed opacity-90 max-w-sm">
                        Kelola data akademik dan tugas perkuliahan dengan sistem terintegrasi yang modern.
                    </p>
                </div>

                <div class="relative z-10 flex items-center space-x-4">
                    <div class="flex -space-x-2">
                        <div class="w-8 h-8 rounded-full border-2 border-indigo-600 bg-indigo-400 flex items-center justify-center text-[10px] font-bold">JD</div>
                        <div class="w-8 h-8 rounded-full border-2 border-indigo-600 bg-sky-400 flex items-center justify-center text-[10px] font-bold">SA</div>
                    </div>
                    <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-indigo-200">Terintegrasi & Aman</p>
                </div>
            </div>

            <div class="w-full lg:w-[55%] p-10 lg:p-24 flex flex-col justify-center bg-white">
                <div class="mb-12">
                    <h2 class="text-4xl font-black text-slate-900 tracking-tight">Selamat Datang</h2>
                    <p class="text-slate-500 mt-3 text-lg font-medium">Silakan masuk ke akun anda.</p>
                </div>

                <x-auth-session-status class="mb-6" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-8">
                    @csrf

                    <div class="group">
                        <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2 ml-1 transition-colors group-focus-within:text-indigo-600">Email Address</label>
                        <x-text-input id="email" class="block w-full bg-slate-50 border-slate-100 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-2xl py-5 px-6 transition-all text-slate-700 font-bold" 
                            type="email" name="email" :value="old('email')" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 ml-1" />
                    </div>

                    <div class="group">
                        <div class="flex items-center justify-between mb-2 ml-1">
                            <label class="block text-xs font-black uppercase tracking-widest text-slate-400 transition-colors group-focus-within:text-indigo-600">Password</label>
                            @if (Route::has('password.request'))
                                <a class="text-xs font-black text-indigo-600 hover:text-indigo-800 transition-colors" href="{{ route('password.request') }}">Lupa?</a>
                            @endif
                        </div>
                        <x-text-input id="password" class="block w-full bg-slate-50 border-slate-100 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-2xl py-5 px-6 transition-all text-slate-700 font-bold" 
                            type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 ml-1" />
                    </div>

                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                            <input id="remember_me" type="checkbox" class="w-5 h-5 rounded border-slate-200 text-indigo-600 focus:ring-indigo-500 transition-all cursor-pointer" name="remember">
                            <span class="ms-3 text-sm font-bold text-slate-500 group-hover:text-slate-800 transition-colors italic">Ingat akun saya</span>
                        </label>
                        <a href="{{ route('register') }}" class="text-sm font-black text-indigo-600 hover:underline decoration-2 underline-offset-4">Daftar Akun</a>
                    </div>

                    <div class="pt-4">
                        <x-primary-button class="w-full justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-black py-5 rounded-[1.5rem] shadow-2xl shadow-indigo-200 transition-all active:scale-[0.96] border-none text-lg tracking-tight">
                            {{ __('Masuk Sekarang') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>