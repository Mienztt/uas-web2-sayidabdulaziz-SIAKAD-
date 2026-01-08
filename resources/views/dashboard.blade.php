<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Utama') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            {{-- Welcome Banner --}}
            <div class="relative overflow-hidden rounded-[2.5rem] bg-gradient-to-r from-indigo-600 to-blue-500 shadow-2xl shadow-indigo-200">
                <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
                <div class="relative z-10 p-10 flex flex-col md:flex-row items-center justify-between text-white">
                    <div class="space-y-4 max-w-2xl">
                        <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-white/20 backdrop-blur-md text-xs font-bold uppercase tracking-widest border border-white/20">
                            <span>🚀 Sistem Informasi Akademik</span>
                        </div>
                        <h3 class="text-4xl md:text-5xl font-black leading-tight tracking-tight">
                            Selamat Datang, <br/>
                            <span class="text-sky-200">{{ Auth::user()->name }}</span>
                        </h3>
                        <p class="text-indigo-100 text-lg opacity-90 leading-relaxed">
                            Akses semua data akademik, jadwal, dan administrasi kampus dalam satu panel yang terintegrasi.
                        </p>
                    </div>
                    <div class="hidden md:block opacity-90">
                        <svg class="w-48 h-48 text-white/20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zm0 9l2.5-1.25L12 8.5l-2.5 1.25L12 11zm0 2.5l-5-2.5-5 2.5L12 22l10-8.5-5-2.5-5 2.5z"/></svg>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <div class="bg-white p-6 rounded-3xl shadow-[0_10px_40px_-10px_rgba(0,0,0,0.08)] border border-gray-100 hover:shadow-lg transition-all group cursor-pointer">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Mahasiswa</p>
                            <h4 class="text-3xl font-black text-gray-900 mt-2">{{ number_format($totalMahasiswa) }}</h4>
                        </div>
                        <div class="p-3 bg-indigo-50 rounded-2xl text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-xs font-medium text-green-500">
                        <span class="bg-green-100 px-2 py-1 rounded-lg">Data Terkini</span>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-3xl shadow-[0_10px_40px_-10px_rgba(0,0,0,0.08)] border border-gray-100 hover:shadow-lg transition-all group cursor-pointer">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Dosen Aktif</p>
                            <h4 class="text-3xl font-black text-gray-900 mt-2">{{ $totalDosen }}</h4>
                        </div>
                        <div class="p-3 bg-sky-50 rounded-2xl text-sky-600 group-hover:bg-sky-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-xs font-medium text-gray-400">
                        <span class="bg-gray-100 px-2 py-1 rounded-lg">Terhitung di Sistem</span>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-3xl shadow-[0_10px_40px_-10px_rgba(0,0,0,0.08)] border border-gray-100 hover:shadow-lg transition-all group cursor-pointer">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Mata Kuliah</p>
                            <h4 class="text-3xl font-black text-gray-900 mt-2">{{ $totalMk }}</h4>
                        </div>
                        <div class="p-3 bg-orange-50 rounded-2xl text-orange-600 group-hover:bg-orange-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-xs font-medium text-orange-500">
                        <span class="bg-orange-100 px-2 py-1 rounded-lg">Kurikulum Aktif</span>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-3xl shadow-[0_10px_40px_-10px_rgba(0,0,0,0.08)] border border-gray-100 hover:shadow-lg transition-all group cursor-pointer">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Ruang Kelas</p>
                            <h4 class="text-3xl font-black text-gray-900 mt-2">{{ $totalKelas }}</h4>
                        </div>
                        <div class="p-3 bg-purple-50 rounded-2xl text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-xs font-medium text-gray-400">
                        <span class="bg-gray-100 px-2 py-1 rounded-lg">Kapasitas Terpantau</span>
                    </div>
                </div>
            </div>

            {{-- ... sisanya Akses Cepat dan Aktivitas Terbaru ... --}}
            
            <div class="bg-white rounded-[2rem] p-8 shadow-xl shadow-gray-100 border border-gray-100 mt-8">
                <h3 class="text-xl font-bold text-gray-900 mb-6 italic">Statistik Jadwal Mingguan</h3>
                <canvas id="jadwalChart" height="100"></canvas>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('jadwalChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    label: 'Jumlah Mata Kuliah',
                    data: {!! json_encode($chartValues) !!},
                    backgroundColor: '#4F46E5',
                    borderRadius: 15,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: { beginAtZero: true, grid: { display: false } },
                    x: { grid: { display: false } }
                }
            }
        });
    </script>
</x-app-layout>