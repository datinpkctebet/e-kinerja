@extends('layout.default')

@section('content')

@php
    $mulai = \Carbon\Carbon::parse(isset($list['mulai']) ? $list['mulai'] : null)->format('m/d/Y');
    $selesai = \Carbon\Carbon::parse(isset($list['selesai']) ? $list['selesai'] : null)->format('m/d/Y');
@endphp

<div class="kt-portlet">
  <!-- <div class="kt-portlet__head">
    <div class="kt-portlet__head-label">
      <h3 class="kt-portlet__head-title">
        Input Surat Pengajuan
      </h3>
    </div>
  </div> -->
  <!--begin::Form-->
  <form class="kt-form" method="POST" action="{{ URL(setPostUrl()) }}">
    {{ csrf_field() }}

    <div class="kt-portlet__body">
      <div class="card card-bordered row">
        <div class="card-header">
            <h3 class="card-title">Profil Pegawai</h3>
        </div>
        <div class="card-body">
          <div class="form-group form-group-xs row">
            <label class="col-3 col-form-label">Nama:</label>
            <div class="col-9">
              <span class="form-control-plaintext kt-font-bolder">{{ $employee->name }}</span>
            </div>
          </div>
          <div class="form-group form-group-xs row">
            <label class="col-3 col-form-label">No. Pegawai/NIP:</label>
            <div class="col-9">
              <span class="form-control-plaintext kt-font-bolder">{{ $employee->nip }}</span>
            </div>
          </div>
          <div class="form-group form-group-xs row">
            <label class="col-3 col-form-label">Pangkat / Golongan:</label>
            <div class="col-9">
              <span class="form-control-plaintext kt-font-bolder">{{ $employee->golongan }}</span>
            </div>
          </div>
          <div class="form-group form-group-xs row">
            <label class="col-3 col-form-label">Jabatan:</label>
            <div class="col-9">
              <span class="form-control-plaintext kt-font-bolder">{{ $employee->first_array_jabatan }}</span>
            </div>
          </div>
          <div class="form-group form-group-xs row">
            <label class="col-3 col-form-label">Satuan Organisasi:</label>
            <div class="col-9">
              <input class="form-control" type="text" name="satuan_organisasi" value="Suku Dinas Kesehatan Kota Administrasi Jakarta Selatan" hidden>
              <span class="form-control-plaintext kt-font-bolder">Suku Dinas Kesehatan Kota Administrasi Jakarta Selatan</span>
            </div>
          </div>
        </div>
      </div>

      <div class="card card-bordered row">
        <div class="card-header">
            <h3 class="card-title">Form Pengajuan Cuti</h3>
        </div>
        <div class="card-body">    
          <div class="form-group row">
              <label class="col-3 col-form-label">Jenis Cuti</label>
              <div class="col-9">
                  <select class="form-control" name="jenis" required>
                      <option disabled selected>Pilih Jenis Cuti</option>
                      @foreach($jenis_cuti as $item)
                        <option value="{{ $item }}" @if($item == old('jenis', @$list['jenis'])) selected @endif>
                          {{ $item }}
                        </option>
                      @endforeach
                  </select>
              </div>
          </div>
    
          <div class="form-group row">
              <label class="col-3 col-form-label">Tempat Bekerja</label>
              <div class="col-9">
                <select class="form-control" name="tempat" required>
                    <option disabled selected>Pilih Tempat Bekerja</option>
                    @foreach($tempat_bekerja as $item)
                      <option value="{{ $item }}" @if($item == old('tempat', @$list['tempat'])) selected @endif>
                        {{ $item }}
                      </option>
                    @endforeach
                </select>
              </div>
          </div>
    
          <div class="form-group row">
              <label class="col-3 col-form-label">Periode Cuti</label>
              <div class="col-9">
                  <input class="form-control" type="text" name="periode_cuti" placeholder="Pilih Periode Cuti" value="{{ $mulai }} - {{ $selesai }}" required>
              </div>
          </div>
        </div>
      </div>
    </div>
    <div class="kt-portlet__foot">
      <div class="kt-form__actions">
        <div class="row">
          <div class="col-9">
            <a href="{{ URL('/surat-pengajuan/') }}">
              <button type="button" class="btn btn-secondary">Kembali</button>
            </a>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </div>
    </div>
  </form>

  <script type="text/javascript">
    $(function() {

      $('input[name="periode_cuti"]').daterangepicker({
          autoUpdateInput: false,
          locale: {
              cancelLabel: 'Clear'
          }
      });

      $('input[name="periode_cuti"]').on('apply.daterangepicker', function(ev, picker) {
          $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
      });

      $('input[name="periode_cuti"]').on('cancel.daterangepicker', function(ev, picker) {
          $(this).val('');
      });

    });
  </script>

  <!-- <form-surat-pengajuan
    :list="{{ json_encode($list) }}"
    :jenis-cuti="{{ json_encode($jenis_cuti) }}"
    :employee="{{ json_encode($employee) }}"
  ></form-surat-pengajuan> -->
</div>

@endsection
