<div class="kt-portlet kt-portlet--height-fluid">
  <div class="kt-portlet__head">
    <div class="kt-portlet__head-label">
      <h3 class="kt-portlet__head-title">
        Diklat
      </h3>
    </div>
  </div>

  <div class="kt-portlet__body">
    <table class="table">
      <thead class="thead-light">
        <tr>
          <th>Nama Pelatihan</th>
          <th>Nama Institusi</th>
          <th>Tanggal Mulai</th>
          <th>Tanggal Selesai</th>
          <th>Jenis Diklat</th>
          <th>No. Sertifikat</th>
          <th>Durasi Diklat</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach (json_decode($data->diklats) as $key => $item)
        <tr>
          <td>{{ $item->pelatihan }}</td>
          <td>{{ $item->institusi }}</td>
          <td>{{ $item->mulai }}</td>
          <td>{{ $item->selesai }}</td>
          <td>{{ $item->jenis }}</td>
          <td>{{ $item->no_sertifikat }}</td>
          <td>{{ @$item->durasi }}</td>
          <td>{!! getDowloadDocument(@$item->dokumen) !!}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>