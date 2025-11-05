
@extends('layout.blankIdCardEmployee')

@section('idCard')

<div class="kt-login__form">
  <div class="kt-login__title">
    <h3>Masukkan NIP</h3>
  </div>

  @if (@$error_message)
  <div class="alert alert-solid-danger alert-bold" role="alert">
    <div class="alert-text">{{ $error_message }}</div>
  </div>
  @endif

  @if (@session('success_message'))
  <div class="alert alert-solid-success alert-bold" role="alert">
    <div class="alert-text">{{ @session('success_message') }}</div>
  </div>
  @endif

  <!--begin::Form-->
  <form class="kt-form" method="POST" action="{{ setPostUrl() }}">
    {{ csrf_field() }}

    <div class="form-group">
      <input class="form-control" type="text" placeholder="NIP" name="nip" autocomplete="off">
    </div>

    <!--begin::Action-->
    <div class="kt-login__actions">
      <a href="#" class="kt-link kt-login__link-forgot">
        {{-- Forgot Password ? --}}
      </a>
      <button type="submit" class="btn btn-primary btn-elevate kt-login__btn-primary">Check Pegawai</button>
    </div>

    <!--end::Action-->
  </form>

  <!--end::Form-->
</div>

@endsection