<div class="kt-portlet kt-portlet--height-fluid">
  <div class="kt-portlet__head">
    <div class="kt-portlet__head-label">
      <h3 class="kt-portlet__head-title">
        Riwayat Mutasi
      </h3>
    </div>
  </div>

  <div class="kt-portlet__body">
    <table class="table">
      <thead class="thead-light">
        <tr>
          <th>Unit Sekarang</th>
          <th>Unit Lama</th>
          <th>No. SK</th>
          <th>Tgl. SK</th>
          <th>No. SPMT</th>
          <th>Tgl. SPMT</th>
          <th>Keterangan</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach (json_decode($data->riwayat_mutasi) as $key => $item)
        <tr>
          <td>{{ $item->unit_kerja_lama }}</td>
          <td>{{ $item->unit_kerja_sekarang }}</td>
          <td>{{ $item->no_sk }}</td>
          <td>{{ $item->tgl_sk }}</td>
          <td>{{ $item->no_spmt }}</td>
          <td>{{ $item->tgl_spmt }}</td>
          <td>{{ $item->keterangan }}</td>
          <td>{!! getDowloadDocument(@$item->dokumen) !!}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>