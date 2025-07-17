@extends('layout.default')

@section('content')

<div class="kt-container--fluid  kt-grid__item kt-grid__item--fluid">
  <div class="kt-portlet">
    <div class="kt-portlet__head">
      <div class="kt-portlet__head-label">
        <h3 class="kt-portlet__head-title">
          Daftar Form Surat Pemberian Cuti
        </h3>
      </div>
      <div class="mt-2">
        <a href="{{ URL('/pemberian-cuti2/add') }}">
          <button type="button" class="btn btn-primary btn-wide">Tambah Form Permberian Cuti</button>
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
                <th>No Surat</th>
                <th>Nama Pegawai</th>
                <th>Jenis Cuti</th>
                <th></th>
              </tr>
            </thead>

            <tbody>

            @foreach($list as $value)
              <tr>
                <td>{{ $value->nomor }}</td>
                <td>{{ @$value->list_employee[0]->name}}</td>
                <td>{{ $value->judul }}</td>
                <td style="min-width: 23rem;">
                  <a href="{{ URL('/pemberian-cuti2/edit/'. $value->id) }}">
                    <button type="button" class="btn btn-warning">
                    <i class="fa fa-edit"></i>
                    Ubah</button>
                  </a>

                  <button type="button" class="btn btn-danger" onclick="deleteRow('/pemberian-cuti2', {{ $value->id }})">
                  <i class="fa fa-window-close"></i>
                  Hapus</button>

                  <a href="{{ URL('/pemberian-cuti2/export/'. $value->id) }}">
                    <button type="button" class="btn btn-success">
                    <i class="fa fa-print"></i>
                    Print</button>
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        {{ $list->links() }}
      </div>

      <!--end::Section-->
    </div>

    <!--end::Form-->
  </div>
</div>

@endsection
