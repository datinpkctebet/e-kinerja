@extends('layout.default')

@section('content')

<div class="alert alert-solid-danger alert-bold" role="alert">
  <div class="alert-text">Maksimal Upload Gambar dan Dokumen adalah 500kb</div>
</div>

<form-activity
  :tupoksi="{{ json_encode($tupoksi_list) }}"
  :list="{{ json_encode($list) }}"
  employee-id="{{ session('employee')['id'] }}"
></form-activity>

@endsection
