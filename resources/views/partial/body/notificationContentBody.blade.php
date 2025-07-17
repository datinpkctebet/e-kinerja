<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">
  <!--begin: Head -->
  <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url({{ asset('media/misc/bg-1.jp') }}g)">
    <div class="kt-user-card__avatar">
      <img class="kt-hidden" alt="Pic" src="{{ asset('media/users/300_25.jpg') }}" />
      <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">{{ session('employee')['name'][0] }}</span>
    </div>
    <div class="kt-user-card__name">
      {{ session('employee')['name'] }}
    </div>
    <div class="kt-user-card__badge">
      <span class="btn btn-success btn-sm btn-bold btn-font-md">23 messages</span>
    </div>
  </div>

  <!--begin: Navigation -->
  <div class="kt-notification">
    <a href="" class="kt-notification__item">
      <div class="kt-notification__item-icon">
        <i class="flaticon2-calendar-3 kt-font-success"></i>
      </div>
      <div class="kt-notification__item-details">
        <div class="kt-notification__item-title kt-font-bold">
          My Profile
        </div>
        <div class="kt-notification__item-time">
          Account settings and more
        </div>
      </div>
    </a>
    <div class="kt-notification__custom kt-space-between">
      <a href="{{ URL('/logout') }}" class="btn btn-label btn-label-brand btn-sm btn-bold">Sign Out</a>
      <a href="demo1/custom/user/login-v2.html" target="_blank" class="btn btn-clean btn-sm btn-bold">Upgrade Plan</a>
    </div>
  </div>
</div>