@extends('layout.default')

@section('content')

<div class="row">
  <div class="col-xl-12">
    @include('pages.employee.partial.dataDiri');
  </div>
</div>

<div class="col-xs-12">
  {{-- PENDIDIKAN --}}
  <div class="row">
    <div class="col-xl-12">
      @if($data->pendidikans)
        @include('pages.employee.partial.pendidikan');
      @endif
    </div>
  </div>

  {{-- KELUARGA --}}
  <div class="row">
    <div class="col-xl-12">
      @if($data->keluargas)
        @include('pages.employee.partial.keluarga');
      @endif
    </div>
  </div>

  {{-- RIWAYAT JABATAN --}}
  <div class="row">
    <div class="col-xl-12">
      @if($data->riwayat_jabatan)
        @include('pages.employee.partial.riwayatJabatan');
      @endif
    </div>
  </div>

  {{-- RIWAYAT MUTASI --}}
  <div class="row">
    <div class="col-xl-12">
      @if($data->riwayat_mutasi)
        @include('pages.employee.partial.riwayatMutasi');
      @endif
    </div>
  </div>

  {{-- DIKLAT --}}
  <div class="row">
    <div class="col-xl-12">
      @if($data->diklats)
        @include('pages.employee.partial.diklat');
      @endif
    </div>
  </div>

  {{-- HUKUMAN DISIPLIN --}}
  <div class="row">
    <div class="col-xl-12">
      @if($data->hukuman_disiplin)
        @include('pages.employee.partial.hukumanDisiplin');
      @endif
    </div>
  </div>

  {{-- PENINGKATAN PENDIDIKAN --}}
  <div class="row">
    <div class="col-xl-12">
      @if($data->peningkatan_pendidikan)
        @include('pages.employee.partial.peningkatanPendidikan');
      @endif
    </div>
  </div>

  {{-- DOKUMEN LAINYA --}}
  <div class="row">
    <div class="col-xl-12">
      @if($data->dokumen)
        @include('pages.employee.partial.dokumen');
      @endif
    </div>
  </div>

</div>

@endsection
