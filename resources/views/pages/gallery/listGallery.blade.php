@extends('layout.default')

@section('content')

<div class="kt-container--fluid  kt-grid__item kt-grid__item--fluid">
  <div class="kt-portlet">
    <div class="kt-portlet__head">
      <div class="kt-portlet__head-label">
        <h3 class="kt-portlet__head-title">
          Daftar Foto
        </h3>
      </div>

      <div class="mt-2">
        <a href="{{ URL('/gallery/add') }}">
          <button type="button" class="btn btn-primary btn-wide">Tambah Foto</button>
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
                <td>
                  {{ $value->title }} <br>
                  {!! $value->description !!}
                </td>

                <td  class="text-right">
                  <a href="{{ URL('/gallery/edit/'. $value->id) }}">
                    <button type="button" class="btn btn-warning">
                      <i class="fa fa-edit"></i>
                      Ubah
                    </button>
                  </a>

                  <button type="button"
                    class="btn btn-danger"
                    onclick="deleteRow('/gallery', {{ $value->id }})">
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
