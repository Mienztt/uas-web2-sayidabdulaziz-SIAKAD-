<x-guest-layout>
    <div class="min-h-screen bg-[radial-gradient(circle_at_bottom_left,_var(--tw-gradient-stops))] from-slate-100 via-indigo-50 to-white flex items-center justify-center p-6">
        <div class="max-w-[600px] w-full bg-white rounded-[3.5rem] shadow-[0_50px_100px_-20px_rgba(0,0,0,0.15)] p-10 lg:p-20 border border-white relative overflow-hidden">
            
            <div class="text-center mb-10">
                <div class="mx-auto h-20 w-20 bg-indigo-600 rounded-[2rem] flex items-center justify-center text-white shadow-2xl shadow-indigo-200 mb-8 rotate-6">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h2 class="text-4xl font-black text-slate-900 tracking-tighter">Verifikasi Email</h2>
                <p class="mt-6 text-slate-500 font-medium leading-relaxed italic">
                    {{ __('Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan.') }}
                </p>
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-8 p-4 bg-emerald-50 border border-emerald-100 rounded-2xl text-emerald-600 text-sm font-bold text-center animate-bounce">
                    {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.') }}
                </div>
            @endif

            <div class="space-y-6">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <x-primary-button class="w-full justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-black py-5 rounded-2xl shadow-xl shadow-indigo-200 transition-all active:scale-[0.97] border-none text-base tracking-tight">
                        {{ __('Kirim Ulang Email Verifikasi') }}
                    </x-primary-button>
                </form>

                <div class="flex items-center justify-center space-x-6">
                    <a href="{{ route('profile.edit') }}" class="text-sm font-bold text-slate-400 hover:text-indigo-600 underline underline-offset-4 decoration-2">
                        {{ __('Edit Profil') }}
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm font-bold text-rose-400 hover:text-rose-600 underline underline-offset-4 decoration-2">
                            {{ __('Keluar Aplikasi') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>