<div class="kt-portlet kt-portlet--height-fluid">
  <div class="kt-portlet__head">
    <div class="kt-portlet__head-label">
      <h3 class="kt-portlet__head-title">
        Peningkatan Pendidikan
      </h3>
    </div>
  </div>

  <div class="kt-portlet__body">
    <table class="table">
      <thead class="thead-light">
        <tr>
          <th>Jenis Pendidikan</th>
          <th>No. Ijin Belajar</th>
          <th>Tgl. Ijin Belajar</th>
          <th>No. Sertifikat</th>
          <th>Tgl. Sertifikat</th>
          <th>Keterangan</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach (json_decode($data->peningkatan_pendidikan) as $key => $item)
        <tr>
          <td>{{ $item->jenis }}</td>
          <td>{{ $item->no_izin }}</td>
          <td>{{ $item->tgl_izin }}</td>
          <td>{{ $item->no_sertifikat }}</td>
          <td>{{ $item->tgl_sertifikat }}</td>
          <td>{{ $item->keterangan }}</td>
          <td>{!! getDowloadDocument(@$item->dokumen) !!}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>