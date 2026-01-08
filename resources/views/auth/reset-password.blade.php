<x-guest-layout>
    <div class="min-h-screen bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-slate-100 via-blue-50 to-white flex items-center justify-center p-6">
        
        <div class="max-w-[550px] w-full bg-white rounded-[3rem] shadow-[0_50px_100px_-20px_rgba(0,0,0,0.12)] p-10 lg:p-16 border border-white relative overflow-hidden">
            
            <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-indigo-50 rounded-full blur-3xl opacity-60"></div>

            <div class="text-center mb-10">
                <div class="mx-auto h-20 w-20 bg-indigo-600 rounded-3xl flex items-center justify-center text-white shadow-2xl shadow-indigo-200 mb-8 rotate-12">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                    </svg>
                </div>
                <h2 class="text-4xl font-black text-slate-900 tracking-tighter">Atur Ulang Kata Sandi</h2>
                <p class="mt-4 text-slate-500 font-medium">Buat kata sandi baru yang lebih kuat untuk mengamankan akun SIAKAD anda.</p>
            </div>

            <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="group">
                    <x-input-label for="email" :value="__('Email')" class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1 group-focus-within:text-indigo-600 transition-colors" />
                    <x-text-input id="email" class="block w-full bg-slate-50 border-slate-100 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-2xl py-4 px-6 transition-all text-slate-400 font-bold opacity-75" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" readonly />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 ml-1" />
                </div>

                <div class="group">
                    <x-input-label for="password" :value="__('Kata Sandi Baru')" class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1 group-focus-within:text-indigo-600 transition-colors" />
                    <x-text-input id="password" class="block w-full bg-slate-50 border-slate-100 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-2xl py-4 px-6 transition-all text-slate-700 font-bold" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 ml-1" />
                </div>

                <div class="group">
                    <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1 group-focus-within:text-indigo-600 transition-colors" />
                    <x-text-input id="password_confirmation" class="block w-full bg-slate-50 border-slate-100 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-2xl py-4 px-6 transition-all text-slate-700 font-bold"
                                    type="password"
                                    name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 ml-1" />
                </div>

                <div class="pt-6">
                    <x-primary-button class="w-full justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-black py-5 rounded-2xl shadow-2xl shadow-indigo-200 transition-all active:scale-[0.97] border-none text-lg">
                        {{ __('Simpan Kata Sandi Baru') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>