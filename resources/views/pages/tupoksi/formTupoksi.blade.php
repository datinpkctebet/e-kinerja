@extends('layout.default')

@section('content')

<div class="kt-portlet">
  <div class="kt-portlet__head">
    <div class="kt-portlet__head-label">
      <h3 class="kt-portlet__head-title">
        Input Aktifitas
      </h3>
    </div>
  </div>

  <!--begin::Form-->

  <form class="kt-form kt-form--label-right" method="POST" action="{{ URL(setPostUrl()) }}">
    {{ csrf_field() }}

    <div class="kt-portlet__body">

      <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label">Aktifitas</label>
        <div class="col-9">
          <input class="form-control" type="text" name="description" value="{{ @$list['description'] }}" placeholder="Deskripsi">
        </div>
      </div>

      <div class="form-group row">
        <label for="example-number-input" class="col-3 col-form-label">Waktu Efektif</label>
        <div class="col-9">
          <div class="input-group">
            <select class="form-control" name="time">
              @foreach ($time as $value)
              <option value="{{ $value }}" @if(@$list['time'] == $value) selected @endif>{{ $value }}</option>
              @endforeach
            </select>
            <div class="input-group-append"><span class="input-group-text">Menit</span></div>
          </div>
        </div>
      </div>

      <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label">Status Aktifitas</label>
        <div class="col-9">
          <select class="form-control" name="status">
            <option value="umum" @if(@$list['status'] == "umum") selected @endif>umum</option>
            <option value="khusus" @if(@$list['status'] == "khusus") selected @endif>khusus</option>
          </select>
        </div>
      </div>

    </div>
    <div class="kt-portlet__foot">
      <div class="kt-form__actions">
        <div class="row">
          <div class="col-9">
          </div>
          <div class="col-9">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ URL('/profession/'. $profession_id) }}">
              <button type="button" class="btn btn-secondary">Cancel</button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

@endsection