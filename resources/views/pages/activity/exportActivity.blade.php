@extends('layout.export')

@section('content')

<h4 class="text-center">LAPORAN KINERJA PEGAWAI PUSKESMAS TEBET <br>
SUKU DINAS KESEHATAN KOTA ADMINISTRASI JAKARTA SELATAN</h4>

<table class="border" style="font-size: .70rem;">
  <thead>
    <tr>
      <th>No</th>
      <th>Tanggal</th>
      <th>Aktifitas</th>
      <th>Waktu Efektif</th>
      <th>Jam Mulai</th>
      <th>Jam Selesai</th>
      <th>Vol</th>
      <th>Keterangan Aktifitas</th>
      <th>Foto</th>
    </tr>
  </thead>

  <tbody style="font-weight: 100;">
    @foreach ($list as $key => $item)
    <tr>
      <td class="text-center">{{ $key+1 }}</td>
      <td class="text-center">{{ $item->date }}</td>

      @if (@$item->tupoksi->description)
      <td class="text-center">{{ $item->tupoksi->description }}</td>
      <td class="text-center">{{ $item->time }} Menit</td>
      <td class="text-center">{{ $item->start }}</td>
      <td class="text-center">{{ $item->end }}</td>
      <td class="text-center">{{ $item->vol }}</td>
      <td>{{ $item->description }}</td>
      <td class="text-center">
        <img src="{{ isImage(env('PATH_ACTIVITY'), $item->image) }}" width="75px">
      </td>
      @else
      <td colspan="7" class="text-center">{{ $item->name }}</td>
      @endif
    </tr>
    @endforeach
  </tbody>
</table>

@endsection
