<div class="kt-portlet kt-portlet--height-fluid">
  <div class="kt-portlet__body">
    <div class="kt-widget kt-widget--user-profile-3">
      <div class="kt-widget__top">
        {{-- PHOTO PROFILE --}}
        <div class="kt-widget__media kt-hidden-">
          <img src="{{ isImage(env('PATH_PICTURE'), $data->foto) }}">
        </div>
        <div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-font-light kt-hidden">
          JM
        </div>

        <div class="kt-widget__content">
          {{-- 1 --}}
          <div class="kt-widget__head">
            <a href="#" class="kt-widget__username">
              {{ $data->name }}
              <span class="kt-badge kt-badge--bolder kt-badge kt-badge--inline kt-badge--unified-success">{{ $data->privilege }}</span>
            </a>
            <div class="kt-widget__action">
              @if (isAdmin())
              <a href="{{ URL('/employee/' ) }}">
                <button type="button" class="btn btn-clean btn-bold">Kembali</button>
              </a>
              <a href="{{ URL('/employee/reset/'. $data->id ) }}">
                <button type="button" class="btn btn-warning btn-bold">Reset Password</button>
              </a>
              @endif
              <a href="{{ URL('/employee/export/'. $data->id ) }}">
                <button type="button" class="btn btn-danger btn-bold">Export Data</button>
              </a>
              <a href="{{ URL('/employee/update/'. $data->id ) }}">
                <button type="button" class="btn btn-brand btn-bold">Ubah</button>
              </a>
            </div>
          </div>

          {{-- 2 --}}
          <div class="kt-widget__subhead">
            <i class="flaticon2-placeholder"></i> {{ $data->tempat_lahir }}, {{ $data->tgl_lahir }}
            <i class="flaticon2-calendar-3 pl-4"></i> {{ $data->no_tlp }}
            <i class="flaticon2-new-email pl-4"></i> {{ $data->email }}
          </div>

          {{-- 3 --}}
          <div class="kt-widget__info">
            <div class="kt-widget__desc">
              {{ $data->alamat }}
            </div>
          </div>
        </div>
      </div>

      <div class="kt-widget__bottom">
        <div class="row w-100">
          <div class="col-lg-6">
            <div class="kt-portlet__body">
              @include('pages.employee.partial.data-diri.row-1')
            </div>
          </div>

          <div class="col-lg-6">
            <div class="kt-portlet__body">
              @include('pages.employee.partial.data-diri.row-2')
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
