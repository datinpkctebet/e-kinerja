@extends('layout.default')

@section('content')

<div class="kt-container--fluid  kt-grid__item kt-grid__item--fluid">

  {{-- FILTER --}}
  <div class="kt-portlet">
    <div class="kt-portlet__body">

      <form class="kt-form kt-form--label-right" method="GET" action="{{ URL(setPostUrl()) }}">
        <div class="form-group row" style="margin:0">
          @php
            $monthSelect = (@$input['month']) ? $input['month'] : $now->month;
            $yearSelect = (@$input['year']) ? $input['year'] : $now->year;
          @endphp

          <div class="col-2">
            <select class="form-control" name="month">
              @foreach ($month as $key => $value)
                <option value="{{ $key+1 }}" @if($key+1 == $monthSelect) selected @endif>{{ $value }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-2">
            <select class="form-control" name="year">
              @foreach ($year as $value)
                <option value="{{ $value }}" @if($value == $yearSelect) selected @endif>{{ $value }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-2">
            <button type="submit" class="btn btn-block btn-primary">
              <i class="fa fa-search"></i> Cari
            </button>
          </div>
        </div>
      </form>

    </div>
  </div>

  <div class="kt-portlet">
    <div class="kt-portlet__head">
      <div class="kt-portlet__head-label">
        <h3 class="kt-portlet__head-title">
          Daftar Absensi
        </h3>
      </div>
      <div class="mt-2">
        <a href="{{ route('absensi.download') }}">
          <button type="button" class="btn btn-warning btn-wide"><i class="fa fa-download"></i> Template Import</button>
        </a>
        <button type="button" class="btn btn-success btn-wide" data-toggle="modal" data-target="#importModal"><i class="fa fa-file-import"></i> Import</button>
        <a href="{{ route('absensi.add', ['month' => $monthSelect, 'year' => $yearSelect]) }}">
          <button type="button" class="btn btn-primary btn-wide"><i class="fa fa-plus"></i> Tambah</button>
        </a>
      </div>
    </div>

    <div class="kt-portlet__body">
      <div class="kt-section">
        <div class="kt-section__content table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>NIP</th>
                <th>Nama Pegawai</th>
                <th>Total Hari Kerja</th>
                <th>Total Telat</th>
                <th>Total Pulang Cepat</th>
                <th>Sakit</th>
                <th>Izin</th>
                <th>Alfa</th>
                <th></th>
              </tr>
            </thead>

            <tbody>
              @foreach($list as $value)
                @php
                  $rowspan = count($value->absensis); // Calculate the number of rows for rowspan
                @endphp
          
                @foreach ($value->absensis as $index => $absensi)
                  <tr>
                    @if ($index === 0)
                      <td rowspan="{{ $rowspan }}">{{ $value->nip }}</td>
                      <td rowspan="{{ $rowspan }}">{{ $value->name }}</td>
                    @endif

                    <td class="text-center">{{ $absensi->hari_kerja }}</td>
                    <td class="text-center">{{ $absensi->telat }}</td>
                    <td class="text-center">{{ $absensi->pulang_cepat }}</td>
                    <td class="text-center">{{ $absensi->sakit }}</td>
                    <td class="text-center">{{ $absensi->izin }}</td>
                    <td class="text-center">{{ $absensi->alfa }}</td>
                    <td class="text-right" style="min-width: 23rem;">
                      <button type="button" class="btn btn-danger" onclick="deleteRow('/absensi', {{ $absensi->id }})">
                        <i class="fa fa-window-close"></i>
                        Hapus
                      </button>
                    </td>
                  </tr>
                @endforeach
              @endforeach
            </tbody>

          </table>
        </div>

        {{ $list->links() }}
      </div>

    </div>
  </div>
</div>

<!-- Modal Import-->
<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{ route('absensi.import.post') }}" method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="modal-header">
            <h5 class="modal-title" id="importModalLabel">Upload File Import</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="file" name="file" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Import</button>
          </div>
      </form>
    </div>
  </div>
</div>

@endsection
