
@extends('layout.blank')

@section('login')

<div class="kt-login__form">
  <div class="kt-login__title">
    <h3>Login</h3>
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
  <form class="kt-form" method="POST" action="{{ setPostUrl() }}" novalidate="novalidate">
    {{ csrf_field() }}

    <div class="form-group">
      <input class="form-control" type="text" placeholder="No Pegawai" name="nip" autocomplete="off">
    </div>
    <div class="form-group">
      <input class="form-control" type="password" placeholder="Password" name="password">
    </div>

    <!--begin::Action-->
    <div class="kt-login__actions">
      <a href="#" class="kt-link kt-login__link-forgot">
        {{-- Forgot Password ? --}}
      </a>
      <button type="submit" class="btn btn-primary btn-elevate kt-login__btn-primary">Masuk</button>
    </div>

    <!--end::Action-->
  </form>

  <!--end::Form-->

  <!--begin::Divider-->
  <div class="kt-login__divider">
    <div class="kt-divider">
      <span></span>
      <span style="color :black">Klik dibawah untuk Menuju</span>
      <span></span>
    </div>
  </div>

  <!--end::Divider-->

  <!--begin::Options-->
  <div class="kt-login__options">
    {{-- <a href="#" class="btn btn-primary kt-btn">
      <i class="fab fa-facebook-f"></i>
      Facebook
    </a>
    <a href="#" class="btn btn-info kt-btn">
      <i class="fab fa-twitter"></i>
      Twitter
    </a> --}}
    <a href="https://puskesmastebet.co.id/heroes" class="btn btn-danger kt-btn">
      <i class="flaticon2-rocket-2"></i>
      Link : Aplikasi Heroes 
    </a>
  </div>
<br>
  <div class="kt-login__options">
    {{-- <a href="#" class="btn btn-primary kt-btn">
      <i class="fab fa-facebook-f"></i>
      Facebook
    </a>
    <a href="#" class="btn btn-info kt-btn">
      <i class="fab fa-twitter"></i>
      Twitter
    </a> --}}
    <a href="https://puskesmastebet.co.id/pilihan_emoticon.html" class="btn btn-info kt-btn">
      <i class="flaticon2-rocket-2"></i>
      Link : Aplikasi SKM ( Emoticon )
    </a>
  </div>

  <!--end::Options-->
</div>

@endsection