@extends('layout.default')

@section('content')

<div class="kt-portlet">
  <div class="kt-portlet__head">
    <div class="kt-portlet__head-label">
      <h3 class="kt-portlet__head-title">
        Input Pertanyaan
      </h3>
    </div>
  </div>

  <!--begin::Form-->
  <form class="kt-form kt-form--label-right" method="POST" action="{{ URL(setPostUrl()) }}">
    {{ csrf_field() }}

    <div class="kt-portlet__body">

      <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label">Deskripsi Pertanyaan</label>
        <div class="col-9">
          <input class="form-control" type="text" name="name" value="{{ @$list['name'] }}" placeholder="Deskripsi Pertanyaan">
        </div>
      </div>

      <div class="form-group row">
        <label for="example-number-input" class="col-3 col-form-label">Kategori</label>
        <div class="col-9">
          <select class="form-control" name="category">
            @foreach ($category as $key => $value)
              <option value="{{ $key }}" @if($key == @$list['category']) selected @endif>{{ $value }}</option>
            @endforeach
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
            <a href="{{ URL('/question') }}">
              <button type="button" class="btn btn-secondary">Cancel</button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

@endsection