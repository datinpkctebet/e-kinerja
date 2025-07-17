<div class="kt-grid kt-grid--hor kt-grid--root">
  <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

    <!-- Sidebar -->
    <button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
    <div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">
      @include('partial.sidebar.headerSidebar')
      @include('partial.sidebar.contentSidebar')
    </div>

    <!-- Header -->
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
      <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

        <!-- begin:: Header Menu -->
        <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
        <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper"></div>

        <!-- begin:: Header Topbar -->
        <div class="kt-header__topbar">
          <div class="kt-header__topbar-item kt-header__topbar-item--user">
            @include('partial.body.notificationTitleBody')

            @include('partial.body.notificationContentBody')
          </div>
        </div>

      </div>

      <!-- Content -->
      <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        @include('partial.body.subHeaderBody')

        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid" id="app">
          @if (@session('da_message'))
          <div class="alert alert-success fade show" role="alert">
            <div class="alert-icon"><i class="flaticon2-check-mark"></i></div>
            <div class="alert-text">{{ @session('success_message') }}</div>
            <div class="alert-close">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="la la-close"></i></span>
              </button>
            </div>
          </div>
          @endif

          @if ($errors->any())
          <div class="alert alert-warning fade show" role="alert">
            <div class="alert-icon"><i class="flaticon-warning"></i></div>
            <div class="alert-text">{{ $errors->first() }}</div>
            <div class="alert-close">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="la la-close"></i></span>
              </button>
            </div>
          </div>
          @endif

          @if (@$error_message)
          <div class="alert alert-danger fade show" role="alert">
            <div class="alert-icon"><i class="flaticon-warning"></i></div>
            <div class="alert-text">{{ @$error_message }}</div>
            <div class="alert-close">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="la la-close"></i></span>
              </button>
            </div>
          </div>
          @endif

          @yield('content')
        </div>
      </div>

      @include('partial.body.footerBody')
    </div>
  </div>
</div>
