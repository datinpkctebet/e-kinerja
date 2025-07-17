@extends('layout.default')

@section('content')

<div class="kt-portlet">
  <div class="kt-portlet__head">
    <div class="kt-portlet__head-label">
      <h3 class="kt-portlet__head-title">
        Input Form Pemberian Cuti
      </h3>
    </div>
  </div>

  <!--begin::Form-->

  <form class="kt-form kt-form--label-right" method="POST" action="{{ URL(setPostUrl()) }}">
    {{ csrf_field() }}

    <div class="kt-portlet__body">
        <div class="form-group row">
            <label for="example-text-input" class="col-3 col-form-label">Pilih Jenis Cuti</label>
              <div class="col-9">
              <select class="form-control" name="surat">
              @foreach ($surat as $value)
              <option value="{{ $value }}" @if(@$list['surat'] == $value) selected @endif>{{ $value }}</option>
              @endforeach
            </select>
          </div>
        </div>

      <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label">Nomor Surat</label>
        <div class="col-9">
          <input class="form-control" type="text" name="nomor" value="{{ @$list['nomor'] }}" placeholder="Nomor Surat">
        </div>
      </div>

      <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label">Cuti yang di Berikan</label>
          <div class="col-9">
          <select class="form-control" name="judul">
          @foreach ($judul as $value)
          <option value="{{ $value }}" @if(@$list['judul'] == $value) selected @endif>{{ $value }}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label">Tahun Cuti</label>
          <div class="col-9">
          <select class="form-control" name="tahun">
          @foreach ($tahun as $value)
          <option value="{{ $value }}" @if(@$list['tahun'] == $value) selected @endif>{{ $value }}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label">Status Pegawai</label>
          <div class="col-9">
          <select class="form-control" name="status">
          @foreach ($status as $value)
          <option value="{{ $value }}" @if(@$list['status'] == $value) selected @endif>{{ $value }}</option>
          @endforeach
        </select>
      </div>
    </div>


      <div class="form-group row">
        <label for="example-number-input" class="col-3 col-form-label">Nama Pegawai</label>
        <div class="col-9">
          <select class="form-control kt-select2"
            id="kt_select2_3"
            data-placeholder="Masukan Daftar Peserta"
            name="peserta[]"
            style="width: 100%;">

            @foreach($employee as $item)
              <option value="{{ $item->id }}"
                @if(in_array($item->id, explode(',', @$list->peserta))) selected @endif
              >{{ $item->name }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label">Tempat Bekerja</label>
        <div class="col-9">
          <textarea class="form-control" name="tempatkerja" rows="3">{{ @$list['tempatkerja'] }}</textarea>
        </div>
      </div>

      <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label">Satuan Organisasi</label>
        <div class="col-9">
          <textarea class="form-control" name="organisasi" rows="3">{{ @$list['organisasi'] }}</textarea>
        </div>
      </div>

      <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label">Lamanya Cuti</label>
        <div class="col-9">
          <textarea class="form-control" name="selama" rows="3">{{ @$list['selama'] }}</textarea>
        </div>
      </div>

      <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label">Mulai Tanggal</label>
        <div class="col-9">
          <input class="form-control" type="text" name="tanggal1" value="{{ @$list['tanggal1'] }}" placeholder="Mulai Tanggal">
        </div>
      </div>

      <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label">Sampai Tanggal</label>
        <div class="col-9">
          <input class="form-control" type="text" name="tanggal2" value="{{ @$list['tanggal2'] }}" placeholder="Sampai Tanggal">
        </div>
      </div>


      <div class="form-group row">
        <label for="kt_summernote_1" class="col-3 col-form-label">Yang Bertanda Tangan</label>
        <div class="col-9">
          <textarea class="summernote" id="kt_summernote_1" name="penanggung_jawab_1">{!! @$list['penanggung_jawab_1'] !!}</textarea>
          {{-- <span style="color:black">
           <br>-------------------------------------------------------
           <br>| Copy/Paste untuk yang Bertanda Tangan Kapuskes |
           <br>-------------------------------------------------------
           <br>Jakarta,
           <br>Kepala Puskesmas Tebet
           <br>Kota Administrasi Jakarta Selatan
           <br>
           <br>
           <br>
           <br>dr. Myrna Kantjananingrat
           <br>NIP.196405301989112001
           <br>
           <br>---------------------------------------------------------
           <br>| Copy/Paste untuk yang Bertanda Tangan KasubagTU |
           <br>---------------------------------------------------------
           <br>Jakarta,
           <br>Ka. Sub Bag/Tata Usaha
           <br>Puskesmas Tebet
           <br>
           <br>
           <br>
           <br>Dra. Min Yuniar, M.Kes
           <br>NIP.196706121987032002
          </span> --}}
        </div>
      </div>



      @if (false)
      <div class="form-group row">
        <label for="kt_summernote_1" class="col-3 col-form-label">Penanggung Jawab</label>
        <div class="col-9">
          <textarea class="summernote" id="kt_summernote_1" name="penanggung_jawab_2">{!! @$list['penanggung_jawab_2'] !!}</textarea>
        </div>
      </div>
      @endif
    </div>

    <div class="kt-portlet__foot">
      <div class="kt-form__actions">
        <div class="row">
          <div class="col-9"></div>

          <div class="col-9">
            <button type="submit" class="btn btn-primary">Submit</button>

            <a href="{{ URL('/pemberian-cuti2/') }}">
              <button type="button" class="btn btn-secondary">Cancel</button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

@endsection
