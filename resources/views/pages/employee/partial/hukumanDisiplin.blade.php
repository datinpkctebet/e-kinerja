<div class="kt-portlet kt-portlet--height-fluid">
  <div class="kt-portlet__head">
    <div class="kt-portlet__head-label">
      <h3 class="kt-portlet__head-title">
        Hukuman Disiplin
      </h3>
    </div>
  </div>

  <div class="kt-portlet__body">
    <table class="table">
      <thead class="thead-light">
        <tr>
          <th>No. SK</th>
          <th>Tgl. SK</th>
          <th>Masa Mulai</th>
          <th>Masa Selesai</th>
          <th>Pejabat yang menetapkan</th>
          <th>Nama Pejabat</th>
          <th>Tingkat Hukdis</th>
          <th>Keterangan</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach (json_decode($data->hukuman_disiplin) as $key => $item)
        <tr>
          <td>{{ $item->no_sk }}</td>
          <td>{{ $item->tgl_sk }}</td>
          <td>{{ $item->mulai }}</td>
          <td>{{ $item->selesai }}</td>
          <td>{{ $item->pejabat_menetapkan }}</td>
          <td>{{ $item->nama_pejabat }}</td>
          <td>{{ $item->tingkat }}</td>
          <td>{{ $item->keterangan }}</td>
          <td>{!! getDowloadDocument(@$item->dokumen) !!}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>