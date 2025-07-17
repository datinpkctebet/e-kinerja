@extends('layout.default')

@section('content')

<div class="kt-portlet">
  <div class="kt-portlet__head">
    <div class="kt-portlet__head-label">
      <h3 class="kt-portlet__head-title">
        Input Absensi
      </h3>
    </div>
  </div>

  <!--begin::Form-->

  <form class="kt-form kt-form--label-right" method="POST" action="{{ URL(setPostUrl()) }}">
    {{ csrf_field() }}

    <div class="kt-portlet__body">
      <div class="form-group row">
        <label for="example-number-input" class="col-3 col-form-label">Nama Pegawai</label>
        <div class="col-9">
          <select id="kt_select2_3" class="form-control kt-select2" name="employee_id">
            @foreach ($employee as $value)
            <option value="{{ $value->id }}" @if(@$list['employee_id'] == $value) selected @endif>{{ $value->name }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label">Total Hari Kerja</label>
        <div class="col-9">
          <input class="form-control" type="number" name="hari_kerja" value="{{ @$list['hari_kerja'] }}" placeholder="Total Hari Kerja">
        </div>
      </div>

      <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label">Total Telat</label>
        <div class="col-9">
          <input class="form-control" type="number" name="telat" value="{{ @$list['telat'] }}" placeholder="Total Telat">
        </div>
      </div>

      <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label">Total Pulang Cepat</label>
        <div class="col-9">
          <input class="form-control" type="number" name="pulang_cepat" value="{{ @$list['pulang_cepat'] }}" placeholder="Total Pulang Cepat">
        </div>
      </div>

      <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label">Total Sakit</label>
        <div class="col-9">
          <input class="form-control" type="number" name="sakit" value="{{ @$list['sakit'] }}" placeholder="Total Sakit">
        </div>
      </div>

      <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label">Total Izin</label>
        <div class="col-9">
          <input class="form-control" type="number" name="izin" value="{{ @$list['izin'] }}" placeholder="Total Izin">
        </div>
      </div>

      <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label">Total Alfa</label>
        <div class="col-9">
          <input class="form-control" type="number" name="alfa" value="{{ @$list['alfa'] }}" placeholder="Total Alfa">
        </div>
      </div>
    </div>

    <div class="kt-portlet__foot">
      <div class="kt-form__actions">
        <div class="row">
          <div class="col-9">
            <button type="submit" class="btn btn-primary">Submit</button>

            <a href="{{ URL('/absensi/') }}">
              <button type="button" class="btn btn-secondary">Cancel</button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

@endsection
