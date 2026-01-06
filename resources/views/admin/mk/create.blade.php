<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Mata Kuliah Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                            <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.mks.store') }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label for="nama_mk" class="block font-medium text-sm text-gray-700">Nama Mata Kuliah</label>
                                <input type="text" name="nama_mk" id="nama_mk" value="{{ old('nama_mk') }}" 
                                       class="block w-full mt-1 rounded-md border-gray-300 shadow-sm" required>
                            </div>
                            <div>
                                <label for="kode_mk" class="block font-medium text-sm text-gray-700">Kode MK (Opsional)</label>
                                <input type="text" name="kode_mk" id="kode_mk" value="{{ old('kode_mk') }}"
                                       class="block w-full mt-1 rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label for="sks" class="block font-medium text-sm text-gray-700">SKS (Opsional)</label>
                                <input type="number" name="sks" id="sks" value="{{ old('sks') }}"
                                       class="block w-full mt-1 rounded-md border-gray-300 shadow-sm">
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.mks.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
                                Batal
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Simpan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>