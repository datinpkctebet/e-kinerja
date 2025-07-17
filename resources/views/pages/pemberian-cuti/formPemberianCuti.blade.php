@extends('layout.default')

@section('content')

<div class="kt-portlet">
  <div class="kt-portlet__head">
    <div class="kt-portlet__head-label">
      <h3 class="kt-portlet__head-title">
        Form Permintaan dan Pemberian Cuti
      </h3>
    </div>
  </div>

  <!--begin::Form-->
  <form class="kt-form kt-form--label-right" method="POST" action="{{ URL(setPostUrl()) }}">
    {{ csrf_field() }}

    <div class="kt-portlet__body">
      <h3 class="kt-section__title">HEADER SURAT</h3>
      <div class="form-group row">
        <label class="col-3 col-form-label">Tempat, Tanggal Surat</label>
        <div class="col-5">
          <input
            class="form-control"
            type="text"
            name="header_place"
            value="{{ @$list['header_place'] }}"
            placeholder="Tempat">
        </div>

        <div class="col-4">
          <input
            class="form-control datepicker-default"
            type="text"
            name="header_date"
            value="{{ @$list['header_date'] }}"
            placeholder="Tanggal Surat"
            readonly>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-3 col-form-label">Surat Kepada</label>
        <div class="col-9">
          <input
            class="form-control"
            type="text"
            name="header_title"
            value="{{ @$list['header_title'] }}"
            placeholder="Kepala Puskesmas Tebet">
        </div>
      </div>


      <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>

      <h3 class="kt-section__title">DATA CUTI</h3>
      <div class="form-group row">
        <label class="col-3 col-form-label">Jenis Cuti</label>
        <label class="col-9 font-weight-bold text-left col-form-label">{{ @$list['jenis'] }}</label>
      </div>

      <div class="form-group row">
        <label class="col-3 col-form-label">Periode</label>
        <label class="col-9 font-weight-bold text-left col-form-label">
          {{ @$list['mulai'] }}
          <label class="font-weight-light mx-2"> sampai </label>
          {{ @$list['selesai'] }}
        </label>
      </div>

      <div class="form-group row">
        <label class="col-3 col-form-label">Sisa Cuti</label>
        <label class="col-9 font-weight-bold text-left col-form-label">{{ @$employee->total_cuti }}</label>
      </div>

      @if ($list['jenis'] === 'Cuti Tahunan')
      <div class="form-group row">
        <label class="col-3 col-form-label">Jumlah Cuti yang diambil</label>
        <div class="col-9">
          <input
            class="form-control"
            type="number"
            name="cuti"
            value="{{ @$list['cuti'] }}"
            min="0"
            max="{{ @$employee->total_cuti }}">
        </div>
      </div>
      @endif

      <div class="form-group row">
        <label class="col-3 col-form-label">Alasan Cuti</label>
        <div class="col-9">
          <textarea
            class="form-control"
            name="alasan"
            rows="4"
            >{{ @$list['alasan'] }}</textarea>
        </div>
      </div>


      <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>

      <h3 class="kt-section__title">Data Penanggung Jawab</h3>
      <div class="form-group row">
        <label class="col-5 col-form-label">Selama Menjalankan Cuti Tugas Saya Diserahkan Kepada</label>
        <div class="col-7">
          <select class="form-control" id="kt_select2_1" name="penanggung_jawab">
            @foreach ($employees as $value)
              <option value="{{ optional($value)->id }}" @if(optional($value)->id == old('penanggung_jawab', @$list['penanggung_jawab'])) selected @endif>
                {{ optional($value)->name }}
              </option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-5 col-form-label">Pertimbangan Atasan Langsung_1</label>
        <div class="col-7">
          <select class="form-control" name="atasan1">
            @foreach ($atasan1 as $value)
              <option value="{{ optional($value)->id }}" @if(optional($value)->id == old('atasan1', @$list['atasan1'])) selected @endif>
                {{ optional($value->employee)->name }}
              </option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-5 col-form-label">Pertimbangan Atasan Langsung</label>
        <div class="col-7">
          <select class="form-control" name="atasan">
            @foreach ($atasan as $value)
              <option value="{{ optional($value)->id }}" @if(optional($value)->id == old('atasan', @$list['atasan'])) selected @endif>
                {{ optional($value->employee)->name }}
              </option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-5 col-form-label">Pejabat yang Berwenang Memberikan Cuti</label>
        <div class="col-7">
          <select class="form-control" name="pejabat_berwenang">
            @foreach ($pejabat_berwenang as $value)
              <option value="{{ optional($value)->id }}" @if(optional($value)->id == old('pejabat_berwenang', @$list['pejabat_berwenang'])) selected @endif>
                {{ optional($value->employee)->name }}
              </option>
            @endforeach
          </select>
        </div>
      </div>
    </div>

    <div class="kt-portlet__foot">
      <div class="kt-form__actions">
        <div class="row">
          <div class="col-9"></div>
          <div class="col-9">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ URL('/pemberian-cuti/') }}">
              <button type="button" class="btn btn-secondary">Cancel</button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

@endsection
