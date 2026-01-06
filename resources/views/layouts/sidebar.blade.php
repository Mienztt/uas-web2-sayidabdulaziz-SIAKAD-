<div class="h-screen w-64 bg-gray-900 text-white flex flex-col fixed inset-y-0 left-0 z-30 overflow-y-auto transition-transform duration-300 ease-in-out transform translate-x-0">
    
    <!-- 1. Logo Area -->
    <div class="flex items-center justify-center h-16 bg-gray-800 shadow-md mb-2">
        <a href="{{ route('dashboard') }}" class="text-2xl font-bold text-blue-400">
            SIAKAD
        </a>
    </div>

    <!-- 2. Menu Items -->
    <nav class="mt-5 px-2">
        
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" 
           class="group flex items-center px-4 py-2 text-base leading-6 font-medium rounded-md mb-1 transition ease-in-out duration-150 border-0 
           {{ request()->routeIs('dashboard') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:text-white hover:bg-gray-700' }}">
            <svg class="mr-4 h-6 w-6 text-gray-400 group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Dashboard
        </a>

        <!-- Menu Akademik (Jadwal) -->
        <div class="mt-4 mb-2 px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">
            Akademik
        </div>

        <!-- Jadwal Kuliah -->
        <a href="{{ route('jadwal') }}" 
           class="group flex items-center px-4 py-2 text-base leading-6 font-medium rounded-md mb-1 transition ease-in-out duration-150 border-0 
           {{ request()->routeIs('jadwal') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:text-white hover:bg-gray-700' }}">
            <svg class="mr-4 h-6 w-6 text-gray-400 group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Jadwal Kuliah
        </a>

        <!-- Data Mahasiswa (PERBAIKAN: Hapus web.) -->
        <a href="{{ route('mahasiswa.index') }}" 
           class="group flex items-center px-4 py-2 text-base leading-6 font-medium rounded-md mb-1 transition ease-in-out duration-150 border-0 
           {{ request()->routeIs('mahasiswa.*') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:text-white hover:bg-gray-700' }}">
            <svg class="mr-4 h-6 w-6 text-gray-400 group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            Data Mahasiswa
        </a>

        <!-- Menu Administrator -->
        <div class="mt-4 mb-2 px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">
            Administrator
        </div>

        <!-- Admin Jadwal -->
        <a href="{{ route('admin.jadwal.index') }}" class="group flex items-center px-4 py-2 text-base font-medium rounded-md mb-1 text-gray-300 hover:text-white hover:bg-gray-700 border-0">
            <span class="mr-4 h-6 w-6 flex items-center justify-center text-gray-400">⚙️</span> Admin Jadwal
        </a>
        <!-- Master Dosen -->
        <a href="{{ route('admin.dosens.index') }}" class="group flex items-center px-4 py-2 text-base font-medium rounded-md mb-1 text-gray-300 hover:text-white hover:bg-gray-700 border-0">
            <span class="mr-4 h-6 w-6 flex items-center justify-center text-gray-400">👨‍🏫</span> Master Dosen
        </a>
        <!-- Master MK -->
        <a href="{{ route('admin.mks.index') }}" class="group flex items-center px-4 py-2 text-base font-medium rounded-md mb-1 text-gray-300 hover:text-white hover:bg-gray-700 border-0">
            <span class="mr-4 h-6 w-6 flex items-center justify-center text-gray-400">📚</span> Master MK
        </a>
        <!-- Master Ruang -->
        <a href="{{ route('admin.ruangs.index') }}" class="group flex items-center px-4 py-2 text-base font-medium rounded-md mb-1 text-gray-300 hover:text-white hover:bg-gray-700 border-0">
            <span class="mr-4 h-6 w-6 flex items-center justify-center text-gray-400">🏫</span> Master Ruang
        </a>
        <!-- Master Shift -->
        <a href="{{ route('admin.shifts.index') }}" class="group flex items-center px-4 py-2 text-base font-medium rounded-md mb-1 text-gray-300 hover:text-white hover:bg-gray-700 border-0">
            <span class="mr-4 h-6 w-6 flex items-center justify-center text-gray-400">⏰</span> Master Shift
        </a>
        <!-- Master Kelas -->
        <a href="{{ route('admin.kelas.index') }}" class="group flex items-center px-4 py-2 text-base font-medium rounded-md mb-1 text-gray-300 hover:text-white hover:bg-gray-700 border-0">
            <span class="mr-4 h-6 w-6 flex items-center justify-center text-gray-400">🎓</span> Master Kelas
        </a>
        
        <!-- Menu Laporan -->
        <div class="mt-4 mb-2 px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">
            Laporan & Dokumen
        </div>

        <!-- Surat Tugas Mengajar (DOMPDF) -->
        <a href="{{ route('admin.surat-tugas.index') }}" class="group flex items-center px-4 py-2 text-base font-medium rounded-md mb-1 text-gray-300 hover:text-white hover:bg-gray-700 border-0">
            <span class="mr-4 h-6 w-6 flex items-center justify-center text-gray-400">📄</span> Surat Tugas Mengajar
        </a>

    </nav>
</div>