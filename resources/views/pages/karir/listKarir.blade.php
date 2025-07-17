@extends('layout.default')

@section('content')

<div class="kt-container--fluid  kt-grid__item kt-grid__item--fluid">
  <div class="kt-portlet">
    <div class="kt-portlet__head">
      <div class="kt-portlet__head-label">
        <h3 class="kt-portlet__head-title">
          Daftar Karir
        </h3>
      </div>

      <div class="mt-2">
        <a href="{{ URL('/karir/add') }}">
          <button type="button" class="btn btn-primary btn-wide">Tambah Lowongan</button>
        </a>
      </div>
    </div>

    <div class="kt-portlet__body">
      <!--begin::Section-->
      <div class="kt-section">
        <div class="kt-section__content table-responsive">
          <table class="table table-striped">
            <tbody>
              @foreach($list as $value)
              <tr>
                <td>{{ $value->position }}</td>

                <td  class="text-right">
                  @if ($value->image)
                  <a href="{{ URL(env('PATH_KARIR_IMAGE') .'/'. $value->image) }}">
                    <button type="button" class="btn btn-outline-brand btn-icon">
                      <i class="fa fa-image"></i>
                    </button>
                  </a>
                  @endif

                  @if ($value->document)
                  <a href="{{ URL(env('PATH_KARIR_DOCUMENT') .'/'. $value->document) }}">
                    <button type="button" class="btn btn-outline-success btn-icon">
                      <i class="fa fa-file-pdf"></i>
                    </button>
                  </a>
                  @endif

                  <a href="{{ URL('/karir/edit/'. $value->id) }}">
                    <button type="button" class="btn btn-warning">
                      <i class="fa fa-edit"></i>
                      Ubah
                    </button>
                  </a>

                  <button type="button"
                    class="btn btn-danger"
                    onclick="deleteRow('/karir', {{ $value->id }})">
                    <i class="fa fa-window-close"></i>
                    Hapus
                  </button>
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
