@extends('layout.default')

@section('content')

<div class="kt-portlet">
  <div class="kt-portlet__head">
    <div class="kt-portlet__head-label">
      <h3 class="kt-portlet__head-title">
        Form Kompetensi Diklat
      </h3>
    </div>
  </div>

  <!--begin::Form-->
  <form 
    class="kt-form kt-form--label-right"
    method="POST" 
    action="{{ URL(setPostUrl()) }}"
    enctype="multipart/form-data"
  >
    {{ csrf_field() }}

    <div class="kt-portlet__body">

      <div class="form-group row">
        <div class="col-lg-8">
          <label>Nama Pelatihan</label>
          <input 
            class="form-control" 
            type="text" 
            name="nama_pelatihan" 
            value="{{ @$diklat['nama_pelatihan'] ? $diklat['nama_pelatihan'] : @$input['nama_pelatihan'] }}" 
            placeholder="Pelatihan keperawatan"
          >
        </div>
      </div>

      <div class="form-group row">
        <div class="col-lg-8">
          <label>Sertifikat (PNG,JPG,PDF)</label>
          <div class="custom-file">
            <input 
              type="file" 
              name="file" 
              class="custom-file-input"
              accept=".pdf,.png,.jpeg,.jpg" 
              id="sertifikat"
            >
            <label class="custom-file-label text-left" for="sertifikat">
              Upload Dokumen
            </label>
          </div>
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
            <a href="{{ URL('/kompetensi-diklat') }}">
              <button type="button" class="btn btn-secondary">Cancel</button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

@endsection