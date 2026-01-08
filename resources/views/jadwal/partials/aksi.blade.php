@if($jadwal)
    <div class="flex flex-col space-y-1.5">
        <button class="w-full bg-white border border-blue-200 text-blue-600 hover:bg-blue-600 hover:text-white text-[10px] font-bold py-1 px-2 rounded transition-all shadow-sm">Barter</button>
        <button class="w-full bg-white border border-orange-200 text-orange-600 hover:bg-orange-600 hover:text-white text-[10px] font-bold py-1 px-2 rounded transition-all shadow-sm">Pindah</button>
    </div>
@else
    @php $shift_kosong = $shifts->firstWhere('jam_mulai', $jam); @endphp
    @if($shift_kosong)
        <a href="{{ route('dosen.charter.create', $shift_kosong->id) }}" class="block w-full bg-emerald-50 hover:bg-emerald-500 hover:text-white text-emerald-600 border border-emerald-200 text-[10px] font-bold py-2 px-2 rounded text-center transition-all">Charter</a>
    @endif
@endif