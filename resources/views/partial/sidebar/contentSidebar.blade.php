<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
  <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
    <ul class="kt-menu__nav ">

      @foreach (setMenu() as $item)
      <li class="kt-menu__item @if(Request::segment(1) === parseMenuUrl($item['url'])) kt-menu__item--active @endif" aria-haspopup="true">
        <a href="/{{ $item['url'] }}" class="kt-menu__link ">
          <i class="kt-menu__link-icon {{ $item['icon'] }}"></i>
          <span class="kt-menu__link-text">{{ $item['name'] }}</span>
        </a>
      </li>
      @endforeach

    </ul>
  </div>
</div>
