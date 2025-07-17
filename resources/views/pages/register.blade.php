
@extends('layout.blank')

@section('login')

<div class="kt-login__form">
  <div class="kt-login__title">
    <h3>Daftar Akun</h3>
  </div>

  @if (@$error_message)
  <div class="alert alert-solid-danger alert-bold" role="alert">
    <div class="alert-text">{{ $error_message }}</div>
  </div>
  @endif

  <!--begin::Form-->
  <form class="kt-form" method="POST" action="{{ setPostUrl() }}" novalidate="novalidate">
    {{ csrf_field() }}

    <div class="form-group">
      <input type="text" class="form-control" name="nip" placeholder="No Pegawai">
    </div>

    <div class="form-group">
      <input type="text" class="form-control" name="name" placeholder="Nama Lengkap">
    </div>

    <div class="form-group">
      <input type="password" class="form-control" name="password" placeholder="Password">
    </div>

    <div class="form-group">
      <input type="password" class="form-control" name="retype_password" placeholder="Retype Password">
    </div>

    <!--begin::Action-->
    <div class="kt-login__actions">
      <a href="#" class="kt-link kt-login__link-forgot">
      </a>
      <button type="submit" class="btn btn-primary btn-elevate kt-login__btn-primary">Daftar</button>
    </div>

    <!--end::Action-->
  </form>

  <!--end::Form-->

</div>

@endsection