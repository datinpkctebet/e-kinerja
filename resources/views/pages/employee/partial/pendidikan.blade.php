<div class="kt-portlet kt-portlet--height-fluid">
  <div class="kt-portlet__head">
    <div class="kt-portlet__head-label">
      <h3 class="kt-portlet__head-title">
        Pendidikan
      </h3>
    </div>
  </div>

  <div class="kt-portlet__body">
    <table class="table">
      <thead class="thead-light">
        <tr>
          <th>Jenjang</th>
          <th>Jurusan</th>
          <th>Nama Sekolah</th>
          <th>Kota</th>
          <th class="text-center">Lama</th>
          <th>No Ijazah</th>
          <th>Tgl Ijazah</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach (json_decode($data->pendidikans) as $key => $item)
        <tr>
          <td>{{ $item->jenjang }}</td>
          <td>{{ $item->jurusan }}</td>
          <td>{{ $item->nama_sekolah }}</td>
          <td>{{ $item->kota }}</td>
          <td>{{ $item->tgl_masuk }} - {{ $item->tgl_keluar }}</td>
          <td>{{ $item->no_ijazah }}</td>
          <td>{{ $item->tgl_ijazah }}</td>
          <td>{!! getDowloadDocument(@$item->dokumen) !!}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>