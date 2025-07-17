@extends('layout.default')

@section('content')

<div class="kt-portlet">
  <div class="kt-portlet__head">
    <div class="kt-portlet__head-label">
      <h3 class="kt-portlet__head-title">
        Input Surat Pengajuan
      </h3>
    </div>
  </div>

  <!--begin::Form-->
  <form-surat-pengajuan
    :list="{{ json_encode($list) }}"
    :jenis-cuti="{{ json_encode($jenis_cuti) }}"
    :employee="{{ json_encode($employee) }}"
  ></form-surat-pengajuan>
</div>

@endsection
