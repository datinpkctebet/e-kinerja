@extends('layout.default')

@section('content')

<div class="kt-container--fluid  kt-grid__item kt-grid__item--fluid">
  <div class="kt-portlet">
    <div class="kt-portlet__head">
      <div class="kt-portlet__head-label">
        <h3 class="kt-portlet__head-title">
          Daftar Liburan
        </h3>
      </div>
      <div class="mt-2">
        <a href="{{ URL('/holiday/add') }}">
          <button type="button" class="btn btn-primary btn-wide"><i class="fa fa-plus"></i> Tambah Liburan</button>
        </a>
        <a href="{{ URL('/holiday/sync') }}">
          <button type="button" class="btn btn-success btn-wide"><i class="fa fa-sync"></i> Sync Liburan</button>
        </a>
      </div>
    </div>
    <div class="kt-portlet__body">

      <!--begin::Section-->
      <div class="kt-section">
        <div class="kt-section__content table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody>
              @php $no=1; @endphp
              @foreach($list as $value)
              <tr>
                <th scope="row">{{ $no++ }}</th>
                <td>{{ \Carbon\Carbon::parse($value->date)->format('d F Y') }}</td>
                <td>{{ $value->description }}</td>
                <td>
                  <a href="{{ URL('/holiday/edit/'. $value->id) }}">
                    <button type="button" class="btn btn-warning">
                    <i class="fa fa-edit"></i>
                    Ubah</button>
                  </a>

                  <button type="button" class="btn btn-danger" onclick="deleteRow('/holiday', {{ $value->id }})">
                  <i class="fa fa-window-close"></i>
                  Hapus</button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <!--end::Section-->
    </div>
    <!--end::Form-->
  </div>
</div>

@endsection
