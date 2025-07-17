@extends('layout.default')

@section('content')

<div class="kt-container--fluid  kt-grid__item kt-grid__item--fluid">
  <div class="kt-portlet">
    <div class="kt-portlet__head">
      <div class="kt-portlet__head-label">
        <h3 class="kt-portlet__head-title">
          Daftar Kompetensi Diklat
        </h3>
      </div>
      @if (!isAdmin())
        <div class="mt-2">
          <a href="{{ URL('/kompetensi-diklat/add') }}">
            <button type="button" class="btn btn-primary btn-wide">
              Tambah Kompetensi Diklat
            </button>
          </a>
        </div>
      @endif
    </div>
    <div class="kt-portlet__body">

      <!--begin::Section-->
      <div class="kt-section">
        <div class="kt-section__content table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                @if (isAdmin())
                  <th>Nama Karyawan</th>
                  <th>Bidang</th>
                @endif
                <th>Nama Pelatihan</th>
                <th class="text-center">Sertifikat</th>
                <th class="text-center">Status</th>
                <th class="text-center"></th>
              </tr>
            </thead>
            <tbody>

              @foreach($kompetensies as $value)
              <tr>
                @if (isAdmin())
                  <td>{{ $value->employee->name }}</td>
                  <td>{{ $value->employee->bidang }}</td>
                @endif
                <td>{{ $value->nama_pelatihan }}</td>
                <td class="text-center">
                  @if ($value->file)
                    <a href="{{ URL(env('PATH_KOMPETENSI') .'/'. $value->file) }}" target="_blank">
                      Lihat Sertifikat
                    </a>
                  @endif
                </td>
                <td class="text-center">
                  @if ($value->is_validated)
                    <span class="badge badge-success">
                      YES 
                    </span>
                  @else
                    <span class="badge badge-danger">
                      NO 
                    </span>
                  @endif
                </td>
                <td  class="text-center" style="min-width: 17rem;">
                  @if (isAdmin())
                    @if ($value->is_validated)
                      <a href="{{ URL('/kompetensi-diklat/decline/'. $value->id .'/'. @$employee_id) }}">
                        <button type="button" class="btn btn-outline btn-outline-dashed btn-outline-secondary btn-active-light-secondary">
                          <i class="fa fa-ban"></i>
                          Tolak
                        </button>
                      </a>
                    @else
                      <a href="{{ URL('/kompetensi-diklat/approve/'. $value->id .'/'. @$employee_id) }}">
                        <button type="button" class="btn btn-success">
                          <i class="fa fa-check"></i>
                          Setujui
                        </button>
                      </a>
                    @endif

                  @else
                    <a href="{{ URL('/kompetensi-diklat/update/'. $value->id) }}">
                      <button type="button" class="btn btn-warning">
                        <i class="fa fa-edit"></i>
                        Ubah
                      </button>
                    </a>

                    <button 
                      type="button" 
                      class="btn btn-danger" 
                      onclick="deleteRow('/kompetensi-diklat', {{ $value->id }})"
                    >
                      <i class="fa fa-window-close"></i>
                      Hapus
                    </button>
                  @endif
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