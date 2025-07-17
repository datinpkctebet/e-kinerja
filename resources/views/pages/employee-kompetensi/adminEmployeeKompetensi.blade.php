@extends('layout.default')

@section('content')

<div class="kt-container--fluid  kt-grid__item kt-grid__item--fluid">
  <div class="kt-portlet">
    <div class="kt-portlet__body">

      <form class="kt-form kt-form--label-right" method="GET" action="{{ URL(setPostUrl()) }}">
        <div class="form-group row" style="margin:0">
          @php
            $jabatanSelect = (@$input['jabatan']) ? $input['jabatan'] : '';
          @endphp

          <div class="col-2">
            <select class="form-control" name="jabatan">
              <option value="" @if($jabatanSelect == '') selected @endif> 
                Pilih Jabatan 
              </option>
              @foreach ($jabatans as $value)
                <option value="{{ $value->id }}" @if($value->id == $jabatanSelect) selected @endif>
                  {{ $value->name }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="col-2">
            <button type="submit" class="btn btn-block btn-primary">
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
          Daftar Kopentensi Diklat
        </h3>
      </div>
    </div>
    <div class="kt-portlet__body">

      <!--begin::Section-->
      <div class="kt-section">
        <div class="kt-section__content table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>No Pegawai</th>
                <th>Nama Pegawai</th>
                <th>Jabatan</th>
                <th style="width: 100px">Total</th>
                <th class="text-center" style="min-width: 8rem;"></th>
              </tr>
            </thead>
            <tbody>

              @foreach($employees as $value)
              <tr>
                <td>{{ $value->nip }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->first_array_jabatan }}</td>
                <td  class="text-center">{{ $value->total }}</td>
                <td  class="text-center" style="min-width: 8rem;">
                  <a href="{{ URL('/employee-kompetensi/'. $value->id) }}" class="btn btn-primary">
                    <i class="fa fa-eye"></i>
                    Show
                  </a>
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