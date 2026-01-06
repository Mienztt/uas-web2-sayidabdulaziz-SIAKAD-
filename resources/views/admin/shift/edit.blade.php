<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Shift') }}
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

                    <form action="{{ route('admin.shifts.update', $shift->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="hari" class="block font-medium text-sm text-gray-700">Hari</label>
                                <select name="hari" id="hari" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm" required>
                                    <option value="">Pilih Hari</option>
                                    <option value="Senin" {{ old('hari', $shift->hari) == 'Senin' ? 'selected' : '' }}>Senin</option>
                                    <option value="Selasa" {{ old('hari', $shift->hari) == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                                    <option value="Rabu" {{ old('hari', $shift->hari) == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                    <option value="Kamis" {{ old('hari', $shift->hari) == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                    <option value="Jumat" {{ old('hari', $shift->hari) == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                    <option value="Sabtu" {{ old('hari', $shift->hari) == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                                </select>
                            </div>

                            <div>
                                <label for="prodi" class="block font-medium text-sm text-gray-700">Prodi</label>
                                <input type="text" name="prodi" id="prodi" value="{{ old('prodi', $shift->prodi) }}" 
                                       class="block w-full mt-1 rounded-md border-gray-300 shadow-sm" required>
                            </div>

                            <div>
                                <label for="jam_mulai" class="block font-medium text-sm text-gray-700">Jam Mulai</label>
                                <input type="time" name="jam_mulai" id="jam_mulai" value="{{ old('jam_mulai', $shift->jam_mulai) }}" 
                                       class="block w-full mt-1 rounded-md border-gray-300 shadow-sm" required>
                            </div>

                            <div>
                                <label for="jam_selesai" class="block font-medium text-sm text-gray-700">Jam Selesai</label>
                                <input type="time" name="jam_selesai" id="jam_selesai" value="{{ old('jam_selesai', $shift->jam_selesai) }}" 
                                       class="block w-full mt-1 rounded-md border-gray-300 shadow-sm" required>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.shifts.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
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