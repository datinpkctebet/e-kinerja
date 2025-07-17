<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root">
  <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v1" id="kt_login">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile" >

      <!--begin::Aside-->
      @include('partial.login.aside')
      <!--begin::Aside-->

      <!--begin::Content-->
      <div class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper" style="background-image: url(/media//bg/bg-100.jpg);">
        <!--begin::Head-->
        <div class="kt-login__head">
          @php
            if (Request::segment(1) == "register") {
              $txt = "Sudah punya akun ?";
              $btn = "Login!";
              $url = '/login';
            } else {
              $txt = "Tidak punya akun?";
              $btn = "Daftar disini !";
              $url = '/register';
            }
          @endphp
          <span class="kt-login__signup-label">{{ @$txt }}</span>&nbsp;&nbsp;
          <a href="{{ @$url }}" class="kt-link kt-login__signup-link">{{ @$btn }}</a>
        </div>

        <!--end::Head-->

        <!--begin::Body-->
        <div class="kt-login__body">

          @yield('login')
        </div>

        <!--end::Body-->
      </div>

      <!--end::Content-->
    </div>
  </div>
</div>

<!-- end:: Page -->
