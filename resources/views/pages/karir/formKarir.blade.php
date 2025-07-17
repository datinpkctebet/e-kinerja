@extends('layout.default')

@section('content')

<div class="kt-portlet">
  <div class="kt-portlet__head">
    <div class="kt-portlet__head-label">
      <h3 class="kt-portlet__head-title">
        Input Lowongan
      </h3>
    </div>
  </div>

  <!--begin::Form-->
  <form class="kt-form" method="POST" action="{{ URL(setPostUrl()) }}" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="kt-portlet__body">
      <div class="form-group">
        <label>Posisi</label>
        <input type="text" class="form-control" name="position" value="{{ @$list['position'] }}" placeholder="Posisi">
      </div>

      <div class="form-group">
        <label for="kt_summernote_1">Deskripsi</label>
        <textarea class="summernote" id="kt_summernote_1" name="description">{!! @$list['description'] !!}</textarea>
      </div>

      <div class="form-group">
        <label>Upload Gambar</label>
        <div class="custom-file">
          <input type="file" name="image" class="custom-file-input"
            accept="image/*" id="blog-image">
          <label class="custom-file-label" for="blog-image">Upload Gambar</label>
        </div>
      </div>

      <div class="form-group">
        <label>Upload Dokumen</label>
        <div class="custom-file">
          <input type="file" name="document" class="custom-file-input"
            accept=".xls,.xlsx,.doc,.docs,.ppt,.pptx,.pdf,.txt" id="blog-document">
          <label class="custom-file-label" for="blog-document">Upload Dokumen</label>
        </div>
      </div>
    </div>

    <div class="kt-portlet__foot">
      <div class="kt-form__actions">
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ URL('/karir') }}">
          <button type="button" class="btn btn-secondary">Cancel</button>
        </a>
      </div>
    </div>
  </form>
</div>

@endsection
