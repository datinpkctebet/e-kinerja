@extends('layout.default')

@section('content')

<div class="kt-container--fluid  kt-grid__item kt-grid__item--fluid">
  <div class="kt-portlet">
    <div class="kt-portlet__body">

      <form class="kt-form kt-form--label-right" method="GET" action="{{ URL(setPostUrl()) }}">
        <div class="form-group row" style="margin:0">
          <div class="col-9">
            <input class="form-control" type="text" name="search" value="{{ @$input['search'] }}" placeholder="Cari berdasarkan nama atau no pegawai">
          </div>

          <div class="col-3">
            <button type="submit" class="btn btn-block btn-warning">
              <i class="fa fa-search"></i> Cari
            </button>
          </div>
        </div>
      </form>

    </div>
  </div>

  <div class="kt-portlet">
    <div class="kt-portlet__head">
      <div class="kt-portlet__head-label">
        <h3 class="kt-portlet__head-title">
          Daftar Pegawai Puskesmas Tebet
        </h3>
      </div>
      <div class="mt-2">
        <a href="{{ URL('/employee/add') }}">
          <button type="button" class="btn btn-primary btn-wide">Tambah Pegawai</button>
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
                <th class="text-center">No Pegawai</th>
                <th style="min-width: 20rem;">Nama Pegawai</th>
                <th>Jabatan</th>
                <th style="min-width: 10rem;">Lama Bekerja</th>
                <th class="text-center">Privilege</th>
                <th class="text-center" style="min-width: 7rem;">status</th>
                <th style="min-width: 25rem;"></th>
              </tr>
            </thead>
            <tbody>
              @foreach($list as $value)
              <tr>
                <td class="text-center">{{ $value->nip }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->first_array_jabatan }}</td>
                <td>{{ $value->length_work }}</td>
                <td  class="text-center">{{ $value->privilege_show }}</td>
                <td  class="text-center">{!! isActiveHtml($value->active) !!}</td>
                <td  class="text-right">
                  @if (@$value->active)
                  <a href="{{ URL('/employee/inactive/'. $value->id) }}">
                  <button type="button" class="btn btn-secondary">
                    <i class="fa fa-lock"></i>
                    Deakftif</button>
                  </a>
                  @else
                  <a href="{{ URL('/employee/active/'. $value->id) }}">
                    <button type="button" class="btn btn-warning">
                    <i class="fa fa-lock-open"></i>
                    Aktifkan</button>
                  </a>
                  @endif

                  <a href="{{ URL('/employee/show/'. $value->id) }}">
                    <button type="button" class="btn btn-success">
                    <i class="fa fa-eye"></i>
                    Lihat</button>
                  </a>

                  <!-- <button type="button" class="btn btn-danger" onclick="deleteRow('/employee', {{ $value->id }})">
                  <i class="fa fa-window-close"></i>
                  Hapus</button> -->
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
