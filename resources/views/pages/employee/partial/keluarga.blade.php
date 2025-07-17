<div class="kt-portlet kt-portlet--height-fluid">
  <div class="kt-portlet__head">
    <div class="kt-portlet__head-label">
      <h3 class="kt-portlet__head-title">
        Keluarga
      </h3>
    </div>
  </div>

  <div class="kt-portlet__body">
    <table class="table">
      <thead class="thead-light">
        <tr>
          <th>Nama</th>
          <th>Tempat, Tanggal Lahir</th>
          <th>Jenis Kelamin</th>
          <th>Hubungan</th>
          <th>Pendidikan</th>
          <th>Keterangan</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach (json_decode($data->keluargas) as $key => $item)
        <tr>
          <td>{{ $item->nama }}</td>
          <td>{{ $item->tempat_lahir }}, {{ $item->tgl_lahir }}</td>
          <td>{{ formatJenisKelamin($item->jenis_kelamin) }}</td>
          <td>{{ $item->hubungan }}</td>
          <td>{{ $item->pendidikan }}</td>
          <td>{{ $item->keterangan }}</td>
          <td>{!! getDowloadDocument(@$item->dokumen) !!}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
