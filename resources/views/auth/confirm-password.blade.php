<x-guest-layout>
    <div class="min-h-screen bg-[#f8fafc] flex items-center justify-center p-6">
        <div class="max-w-[500px] w-full bg-white rounded-[3rem] shadow-[0_40px_80px_-15px_rgba(0,0,0,0.1)] p-10 lg:p-16 border border-gray-100 relative overflow-hidden">
            
            <div class="text-center mb-10">
                <div class="mx-auto h-16 w-16 bg-indigo-100 rounded-2xl flex items-center justify-center text-indigo-600 mb-6">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">Konfirmasi Keamanan</h2>
                <p class="mt-4 text-slate-500 font-medium leading-relaxed">
                    {{ __('Ini adalah area aplikasi yang aman. Silakan konfirmasi kata sandi Anda sebelum melanjutkan.') }}
                </p>
            </div>

            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
                @csrf

                <div class="group">
                    <x-input-label for="password" :value="__('Kata Sandi')" class="text-[11px] font-black uppercase tracking-widest text-slate-400 ml-1 group-focus-within:text-indigo-600" />
                    <x-text-input id="password" class="block w-full bg-slate-50 border-slate-100 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 rounded-2xl py-4 px-6 transition-all text-slate-700 font-bold"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 ml-1" />
                </div>

                <div class="pt-4">
                    <x-primary-button class="w-full justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-black py-5 rounded-2xl shadow-xl shadow-indigo-200 transition-all active:scale-[0.97] border-none text-base">
                        {{ __('Konfirmasi Akun') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>