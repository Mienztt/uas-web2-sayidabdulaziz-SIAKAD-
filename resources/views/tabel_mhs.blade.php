@foreach($data as $index => $mhs)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $mhs->id }}</td>
    <td>{{ $mhs->nim }}</td>
    <td>{{ $mhs->nama }}</td>
    <td>{{ $mhs->jurusan }}</td>
</tr>
@endforeach

@if($data->isEmpty())
<tr>
    <td colspan="5" class="text-center">Data tidak ditemukan</td>
</tr>
@endif