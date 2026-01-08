<x-guest-layout>
    <div class="min-h-screen bg-[radial-gradient(circle_at_bottom_right,_var(--tw-gradient-stops))] from-slate-100 via-indigo-50 to-white flex items-center justify-center p-6">
        
        <div class="max-w-[550px] w-full bg-white rounded-[3rem] shadow-[0_40px_80px_-15px_rgba(0,0,0,0.1)] p-10 lg:p-16 border border-white relative overflow-hidden">
            
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-indigo-100/50 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-sky-100/50 rounded-full blur-3xl"></div>

            <div class="text-center mb-10">
                <div class="mx-auto h-20 w-20 bg-indigo-600 rounded-[2rem] flex items-center justify-center text-white shadow-2xl shadow-indigo-200 mb-8 rotate-3 hover:rotate-0 transition-transform duration-500">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                    </svg>
                </div>
                
                <h2 class="text-3xl font-black text-slate-900 tracking-tighter italic">Lupa Password?</h2>
                <p class="mt-4 text-slate-500 font-medium leading-relaxed">
                    {{ __('Jangan panik! Masukkan email terdaftar Anda, dan kami akan mengirimkan tautan ajaib untuk mengatur ulang kata sandi Anda.') }}
                </p>
            </div>

            <x-auth-session-status class="mb-6 bg-emerald-50 text-emerald-600 p-4 rounded-2xl border border-emerald-100 text-sm font-bold text-center" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <div class="group">
                    <x-input-label for="email" :value="__('Alamat Email Terdaftar')" class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1 group-focus-within:text-indigo-600 transition-colors" />
                    <x-text-input id="email" class="block w-full bg-slate-50 border-slate-100 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-2xl py-4 px-6 transition-all text-slate-700 font-bold" type="email" name="email" :value="old('email')" required autofocus placeholder="nama@siakad.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 ml-1" />
                </div>

                <div class="pt-4 space-y-4">
                    <x-primary-button class="w-full justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-black py-5 rounded-2xl shadow-2xl shadow-indigo-200 transition-all active:scale-[0.97] border-none text-base">
                        {{ __('Kirim Link Reset Password') }}
                    </x-primary-button>
                    
                    <div class="text-center">
                        <a href="{{ route('login') }}" class="text-sm font-bold text-slate-400 hover:text-indigo-600 transition-colors no-underline">
                            Tiba-tiba ingat? <span class="text-indigo-600 underline underline-offset-4 decoration-2">Masuk Kembali</span>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>