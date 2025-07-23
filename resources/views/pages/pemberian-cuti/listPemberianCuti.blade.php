@extends('layout.default')

@section('content')

<div class="kt-container--fluid  kt-grid__item kt-grid__item--fluid">
  <div class="kt-portlet">
    <div class="kt-portlet__head">
      <div class="kt-portlet__head-label">
        <h3 class="kt-portlet__head-title">
          Daftar Pemberian Surat Cuti
        </h3>
      </div>
    </div>

    <div class="kt-portlet__body">
      <!--begin::Section-->
      <div class="kt-section">
        <div class="kt-section__content table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th class="text-center">Nama Pegawai</th>
                <th class="text-center">Jenis Surat</th>
                <th class="text-center">Tempat Bekarja</th>
                <th class="text-center">Tanggal Mulai</th>
                <th class="text-center">Tanggal Selesai</th>

                @if (Request::segment(1) === 'surat-cuti')
                  <th class="text-center">Status</th>
                @endif
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($list as $value)
              <tr>
                <td>{{ @$value->employee->name }}</td>
                <td>{{ $value->jenis }}</td>
                <td>{{ $value->tempat }}</td>
                <td class="text-center">{{ $value->mulai }}</td>
                <td class="text-center">{{ $value->selesai }}</td>

                @if (Request::segment(1) === 'surat-cuti')
                  <td class="text-center">{!! isVerifyHtml($value->status) !!}</td>
                @endif

                <td  class="text-right" style="min-width: 18rem;">
                  <a href="{{ URL('/pemberian-cuti/export/'. $value->id) }}" target="_blank" rel="noopener">
                    <button type="button" class="btn btn-success">
                    <i class="fa fa-file-pdf"></i>
                    Preview</button>
                  </a>

                  @if (session('employee')['privilege'] === 'Administrator')
                    @if ($value->status != 4)
                      <button type="button" class="btn btn-info" onclick="lockCuti('/surat-cuti/lock', {{ $value->id }})">
                        <i class="fa fa-lock"></i> Setujui
                      </button>

                      <a href="{{ URL('/pemberian-cuti/edit/'. $value->id) }}">
                        <button type="button" class="btn btn-warning">
                        <i class="fa fa-pencil-alt"></i>
                        Ubah</button>
                      </a>

                      <button type="button" class="btn btn-danger" onclick="deleteRow('/surat-cuti', {{ $value->id }})">
                        <i class="fa fa-window-close"></i> Tolak
                      </button>
                    @endif
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        {{ $list->links() }}
      </div>
    </div>
  </div>
</div>

@endsection
