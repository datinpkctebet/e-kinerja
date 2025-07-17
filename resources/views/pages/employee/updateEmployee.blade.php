@extends('layout.default')

@section('content')

<div class="alert alert-solid-danger alert-bold" role="alert">
  <div class="alert-text">Maksimal Upload Gambar dan Dokumen adalah 500kb</div>
</div>

@php
  $employee_privilege = session('employee')['privilege'];
@endphp

<update-employee
  :tingkat-hukdis="{{ json_encode($tingkat_hukdis) }}"
  :education="{{ json_encode($education) }}"
  :hubungan="{{ json_encode($hubungan) }}"
  :agama="{{ json_encode($religion) }}"
  :status-pegawai="{{ json_encode($status_pegawai) }}"
  :status-perkawinan="{{ json_encode($status_perkawinan) }}"
  :jabatan="{{ json_encode($profession) }}"
  :jenis-jabatan="{{ json_encode($jenis_jabatan) }}"
  :unit-kerja="{{ json_encode($unit) }}"
  :golongan-list="{{ json_encode($golongan) }}"
  :privilege="{{ json_encode($privilege) }}"
  :list="{{ json_encode($list) }}"
  current-privilege="{{ $employee_privilege }}"
  :jenis-diklat="{{ json_encode($jenis_diklat) }}"
>
</update-employee>

@endsection
