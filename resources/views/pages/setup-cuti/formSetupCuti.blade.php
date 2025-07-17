@extends('layout.default')

@section('content')

<div class="kt-portlet">
  <div class="kt-portlet__head">
    <div class="kt-portlet__head-label">
      <h3 class="kt-portlet__head-title">
        Input Setup Surat Pemberian Cuti
      </h3>
    </div>
  </div>

  <!--begin::Form-->

  <form class="kt-form kt-form--label-right" method="POST" action="{{ URL(setPostUrl()) }}">
    {{ csrf_field() }}

    <div class="kt-portlet__body">
      <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label">Pilih Pegawai</label>
        <div class="col-9">
          <select class="form-control kt-select2" id="kt_select2_1" name="nama_pegawai">
            @foreach ($employee as $value)
              <option value="{{ $value->id }}" @if(@$list['title'] == $value->id) selected @endif>{{ $value->name }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-group row">
        <label for="example-number-input" class="col-3 col-form-label">Daftar Peserta</label>
        <div class="col-9">
          <select class="form-control kt-select2" name="type">
            @foreach($form_cuti_type as $item)
              <option value="{{ $item }}" @if(@$list['type'] == $item) selected @endif>{{ $item }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label">Deskripsi</label>
        <div class="col-9">
          <textarea class="form-control" name="keterangan" rows="3">{{ @$list['description'] }}</textarea>
        </div>
      </div>
    </div>

    <div class="kt-portlet__foot">
      <div class="kt-form__actions">
        <div class="row">
          <div class="col-9"></div>
          <div class="col-9">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ URL('/surat-tugas/') }}">
              <button type="button" class="btn btn-secondary">Cancel</button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

@endsection
