<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ubah Kelas') }}
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

                    <form action="{{ route('admin.kelas.update', $kelas->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="space-y-4">
                            <div>
                                <label for="nama" class="block font-medium text-sm text-gray-700">Nama Kelas</label>
                                <input type="text" name="nama" id="nama" value="{{ old('nama', $kelas->nama) }}" 
                                       class="block w-full mt-1 rounded-md border-gray-300 shadow-sm" required>
                            </div>
                            <div>
                                <label for="angkatan" class="block font-medium text-sm text-gray-700">Angkatan (4 digit)</label>
                                <input type="number" name="angkatan" id="angkatan" value="{{ old('angkatan', $kelas->angkatan) }}" 
                                       class="block w-full mt-1 rounded-md border-gray-300 shadow-sm" required>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.kelas.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
                                Batal
                            </a>
                            <button type="submit" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                Update
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>