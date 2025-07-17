<div class="kt-portlet kt-portlet--height-fluid">
  <div class="kt-portlet__head">
    <div class="kt-portlet__head-label">
      <h3 class="kt-portlet__head-title">
        Riwayat Jabatan
      </h3>
    </div>
  </div>

  <div class="kt-portlet__body">
    <table class="table">
      <thead class="thead-light">
        <tr>
          <th>Unit Kerja Lama</th>
          <th>Masa Kerja</th>
          <th>Jenis Pegawai</th>
          <th>Jabatan</th>
          <th>Rumpun Kerja</th>
          <th>No. SK</th>
          <th>Tgl. SK</th>
          <th>TMT. SK</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach (json_decode($data->riwayat_jabatan) as $key => $item)
        <tr>
          <td>{{ $item->unit_kerja_lama }}</td>
          <td>{{ $item->masa_kerja }}</td>
          <td>{{ $item->jenis_pegawai }}</td>
          <td>{{ $item->jabatan }}</td>
          <td>{{ $item->rumpun_jabatan }}</td>
          <td>{{ $item->no_sk }}</td>
          <td>{{ $item->tgl_sk }}</td>
          <td>{{ $item->tmt_sk }}</td>
          <td>{!! getDowloadDocument(@$item->dokumen) !!}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>