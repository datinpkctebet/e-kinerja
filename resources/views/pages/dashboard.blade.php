@extends('layout.default')

@section('content')

<div class="row">
  @php
    $user = session('employee');
  @endphp

  @if ($user['privilege'] === 'Writer')
  <div class="col-xl-12 mt-5">
    <h1>Hello {{ $user['name'] }}, Happy Work</h1>
  </div>

  @else
  <div class="col-xl-6">
    <div class="kt-portlet kt-portlet--bordered-semi kt-portlet--space kt-portlet--height-fluid">
      <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
          <h3 class="kt-portlet__head-title">
            {{ @$admin->title }}
          </h3>
        </div>
      </div>

      <div class="kt-portlet__body">
        {!! @$admin->description !!}
      </div>
    </div>
  </div>
  @endif

  @if(session('employee')['privilege'] == 'Administrator')
  <div class="col-xl-6">
    <div class="kt-portlet">
      <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
          <h3 class="kt-portlet__head-title">
            Pengumuman
          </h3>
        </div>
      </div>

      <form class="kt-form" method="POST" action="{{ URL(setPostUrl()) }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="kt-portlet__body">
          <div class="form-group">
            <label>Judul</label>
            <input type="text" class="form-control" name="title" value="{{ @$employee['title'] }}" placeholder="Judul">
          </div>

          <div class="form-group">
            <label for="kt_summernote_1">Deskripsi</label>
            <textarea class="summernote" id="kt_summernote_1" name="description">{!! @$employee['description'] !!}</textarea>
          </div>

          <div class="form-group">
            <label>Upload Dokumen</label>
            <div class="custom-file">
              <input type="file" name="file" class="custom-file-input">
              <label class="custom-file-label" for="customFile">Upload Dokumen</label>
            </div>
          </div>

        </div>
        <div class="kt-portlet__foot">
          <div class="kt-form__actions">
            <button type="submit" class="btn btn-success">Save</button>
          </div>
        </div>
      </form>

    </div>
  </div>
  @endif

</div>

@endsection
