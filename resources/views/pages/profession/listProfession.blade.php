@extends('layout.default')

@section('content')

<div class="kt-container--fluid  kt-grid__item kt-grid__item--fluid">
  <div class="kt-portlet">
    <div class="kt-portlet__head">
      <div class="kt-portlet__head-label">
        <h3 class="kt-portlet__head-title">
          Daftar Profesi
        </h3>
      </div>
      <div class="mt-2">
        <a href="{{ URL('/profession/add') }}">
          <button type="button" class="btn btn-primary btn-wide">Tambah Profesi</button>
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
                <th class="text-center">No</th>
                <th>Nama Profesi</th>
                <th class="text-center">Nilai Maksimal</th>
                <th class="text-center"></th>
              </tr>
            </thead>
            <tbody>
              @php $no=1; @endphp

              @foreach($list as $value)
              <tr>
                <th  class="text-center" scope="row">{{ $no++ }}</th>
                <td>{{ $value->name }}</td>
                <td  class="text-center">{{ $value->value }}</td>
                <td  class="text-center" style="min-width: 17rem;">
                  <a href="{{ URL('/profession/'. $value->id) }}">
                    <button type="button" class="btn btn-success">
                    <i class="fa fa-eye"></i>
                    Lihat</button>
                  </a>

                  <a href="{{ URL('/profession/edit/'. $value->id) }}">
                    <button type="button" class="btn btn-warning">
                    <i class="fa fa-edit"></i>
                    Ubah</button>
                  </a>

                  <button type="button" class="btn btn-danger" onclick="deleteRow('/profession', {{ $value->id }})">
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