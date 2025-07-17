<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
  <div class="kt-header__topbar-user">
    <span class="kt-header__topbar-welcome kt-hidden-mobile">Hi,</span>
    <span class="kt-header__topbar-username kt-hidden-mobile">{{ session('employee')['name'] }}</span>
    <img class="kt-hidden" alt="Pic" src="{{ asset('media/users/300_25.jpg') }}" />
    <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">{{ session('employee')['name'][0] }}</span>
  </div>
</div>