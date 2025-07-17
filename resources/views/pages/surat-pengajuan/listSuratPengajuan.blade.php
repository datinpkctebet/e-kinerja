@extends('layout.default')

@section('content')

<div class="kt-container--fluid  kt-grid__item kt-grid__item--fluid">
  <div class="kt-portlet">
    <div class="kt-portlet__head">
      <div class="kt-portlet__head-label">
        <h3 class="kt-portlet__head-title">
          Daftar Surat Pengajuan
        </h3>
      </div>

      @if(session('employee')['privilege'] === 'Pegawai')
      <div class="mt-2">
        <a href="{{ URL('/surat-pengajuan/add') }}">
          <button type="button" class="btn btn-primary btn-wide">Tambah Surat Pengajuan</button>
        </a>
      </div>
      @endif
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
                <th class="text-center">Status</th>
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
                <td class="text-center">{!! isVerifyHtml($value->status) !!}</td>
                <td  class="text-right" style="min-width: 18rem;">
                  @if (session('employee')['privilege'] === 'Pegawai' AND $value->status != 4)
                  <a href="{{ URL('/surat-pengajuan/edit/'. $value->id) }}">
                    <button type="button" class="btn btn-warning">
                    <i class="fa fa-edit"></i>
                    Ubah</button>
                  </a>

                  <button type="button" class="btn btn-danger" onclick="deleteRow('/surat-pengajuan', {{ $value->id }})">
                    <i class="fa fa-window-close"></i> Hapus
                  </button>
                  @endif

                  @if ($value->status == 1 AND session('employee')['privilege'] === 'Administrator')
                  <a href="{{ URL('/pemberian-cuti/'. $value->id) }}">
                    <button type="button" class="btn btn-warning">
                    <i class="fa fa-edit"></i>
                    buat form</button>
                  </a>
                  @endif

                  @if (session('employee')['privilege'] === 'Administrator')
                    @if ($value->status == 2 || $value->status == null)
                    <a href="{{ URL('/surat-cuti/accept/'. $value->id) }}">
                      <button type="button" class="btn btn-success">
                      <i class="fa fa-check"></i>
                      terima</button>
                    </a>
                    @endif

                    @if ($value->status == 1 || $value->status == null)
                    <a href="{{ URL('/surat-cuti/decline/'. $value->id) }}">
                      <button type="button" class="btn btn-danger">
                      <i class="fa fa-times"></i>
                      tolak</button>
                    </a>
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
