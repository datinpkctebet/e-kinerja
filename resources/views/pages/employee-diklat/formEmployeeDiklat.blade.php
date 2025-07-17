@extends('layout.default')

@section('content')

<div class="kt-portlet">
  <div class="kt-portlet__head">
    <div class="kt-portlet__head-label">
      <h3 class="kt-portlet__head-title">
        Input Variabel
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
        <div class="col-lg-6">
          <label>Nama Pelatihan</label>
          <input 
            class="form-control" 
            type="text" 
            name="nama_pelatihan" 
            value="{{ @$diklat['nama_pelatihan'] ? $diklat['nama_pelatihan'] : @$input['nama_pelatihan'] }}" 
            placeholder="Pelatihan keperawatan"
          >
        </div>
        <div class="col-lg-6">
          <label>Nama Institusi</label>
          <input 
            class="form-control" 
            type="text" 
            name="nama_institusi" 
            value="{{ @$diklat['nama_institusi'] ? $diklat['nama_institusi'] : @$input['nama_institusi'] }}" 
            placeholder="Puskesmas"
          >
        </div>
      </div>

      <div class="form-group row">
        <div class="col-lg-6">
          <label>Lokasi Kota</label>
          <input 
            class="form-control" 
            type="text" 
            name="lokasi_kota" 
            value="{{ @$diklat['lokasi_kota'] ? $diklat['lokasi_kota'] : @$input['lokasi_kota'] }}" 
            placeholder="Jakarta"
          >
        </div>
        <div class="col-lg-6">
          <label>Akreditasi Lembaga Penyelenggara</label>
          <select class="form-control kt-select2" id="kt_select2_1" name="akreditasi">
            @php
              $akreditasi = array(
                "A", 
                "B",
                "C",
                "D",
                "E",
              );
              $selectedAkreditasi = @$diklat['akreditasi'] ? $diklat['akreditasi'] : @$input['akreditasi'];
            @endphp
            @foreach ($akreditasi as $value)
              <option value="{{ $value }}" @if($selectedAkreditasi == $value) selected @endif>{{ $value }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-group row">
        <div class="col-lg-6">
          <label>Tanggal Mulai</label>
          <input
            class="form-control datepicker-default"
            type="text"
            name="tanggal_mulai"
            value="{{ @$diklat['tanggal_mulai'] ? $diklat['tanggal_mulai'] : @$input['tanggal_mulai'] }}"
            readonly
          >
        </div>
        <div class="col-lg-6">
          <label>Tanggal Selesai</label>
          <input
            class="form-control datepicker-default"
            type="text"
            name="tanggal_selesai"
            value="{{ @$diklat['tanggal_selesai'] ? $diklat['tanggal_selesai'] : @$input['tanggal_selesai'] }}"
            readonly
          >
        </div>
      </div>

      <div class="form-group row">
        <div class="col-lg-6">
          <label>Jenis Diklat</label>
          <select class="form-control kt-select2" id="kt_select2_1" name="jenis_diklat">
            @php
              $selectedJenisDiklat = @$diklat['jenis_diklat'] ? $diklat['jenis_diklat'] : @$input['jenis_diklat'];
            @endphp
            @foreach ($jenis_diklat as $value)
              <option value="{{ $value }}" @if($selectedJenisDiklat == $value) selected @endif>
                {{ $value }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="col-lg-6">
          <label>No Sertifikat</label>
          <input 
            class="form-control" 
            type="text" 
            name="no_sertifikat" 
            value="{{ @$diklat['no_sertifikat'] ? $diklat['no_sertifikat'] : @$input['no_sertifikat'] }}" 
            placeholder="12/D-12"
          >
        </div>
      </div>

      <div class="form-group row">
        <div class="col-lg-6">
          <label>JPL Diklat</label>
          <input 
            class="form-control" 
            type="number" 
            name="jpl_diklat" 
            value="{{ @$diklat['jpl_diklat'] ? $diklat['jpl_diklat'] : @$input['jpl_diklat'] }}" 
            placeholder="5"
          >
        </div>
        <div class="col-lg-6">
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
            <a href="{{ URL('/diklat') }}">
              <button type="button" class="btn btn-secondary">Cancel</button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

@endsection