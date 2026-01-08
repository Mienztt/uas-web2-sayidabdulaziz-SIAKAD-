<x-guest-layout>
    <div class="min-h-screen bg-gray-50 flex flex-col items-center justify-center p-6">
        <div class="text-center">
            <h1 class="text-9xl font-black text-indigo-200">403</h1>
            <p class="text-2xl font-bold text-gray-800 mt-4">Akses Ditolak!</p>
            <p class="text-gray-500 mt-2">Maaf, kamu tidak punya izin untuk masuk ke halaman ini.</p>
            <a href="{{ route('dashboard') }}" class="inline-block mt-6 px-8 py-3 bg-indigo-600 text-white font-bold rounded-xl shadow-lg hover:bg-indigo-700 transition-all no-underline">
                Kembali ke Dashboard
            </a>
        </div>
    </div>
</x-guest-layout>