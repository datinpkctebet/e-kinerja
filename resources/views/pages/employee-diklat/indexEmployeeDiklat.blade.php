@extends('layout.default')

@section('content')

<div class="kt-container--fluid  kt-grid__item kt-grid__item--fluid">
  <div class="kt-portlet">
    <div class="kt-portlet__body">

      <form class="kt-form kt-form--label-right" method="GET" action="{{ URL(setPostUrl()) }}">
        <div class="form-group row" style="margin:0">
          @php
            $yearSelect = (@$input['year']) ? $input['year'] : $current_year;
          @endphp

          <div class="col-2">
            <select class="form-control" name="year">
              @foreach ($years as $value)
                <option 
                  value="{{ $value }}" 
                  @if($value == $yearSelect) selected @endif
                >{{ $value }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-2">
            <button type="submit" class="btn btn-block btn-primary">
              <i class="fa fa-search"></i> Cari
            </button>
          </div>

          @if (@$total)
          <div class="col-8 text-right">
            <span>
              Total JPL Diklat
              <h2 
                class="kt-font-danger"
                style=" display: inline; vertical-align: middle; margin-left: 1rem;"
              >
                {{ $total }}
              </h2>
            </span>
          </div>
          @endif
        </div>
      </form>

    </div>
  </div>
  
  <div class="kt-portlet">
    <div class="kt-portlet__head">
      <div class="kt-portlet__head-label">
        @if (@$employee->name)
        <h3 class="kt-portlet__head-title">
          Daftar Diklat: {{ $employee->name }} ({{ $employee->first_array_jabatan }})
        </h3>
        @else
        <h3 class="kt-portlet__head-title">
          Daftar Diklat
        </h3>
        @endif
        
      </div>
      @if (!isAdmin())
      <div class="mt-2">
        <a href="{{ URL('/diklat/add') }}">
          <button type="button" class="btn btn-primary btn-wide">Tambah Diklat</button>
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
                <th style="min-width: 150px">Nama Pelatihan</th>
                <th style="min-width: 150px">Nama Institusi</th>
                <th style="min-width: 100px">Lokasi Kota</th>
                <th class="text-center">Akreditasi Lembaga Penyelenggara</th>
                <th class="text-center" style="min-width: 100px">Tanggal Mulai</th>
                <th class="text-center" style="min-width: 100px">Tanggal Selesai</th>
                <th style="min-width: 100px">Jenis Diklat</th>
                <th style="min-width: 120px">No. Sertifikat</th>
                <th class="text-right" style="min-width: 100px">JPL Diklat</th>
                <th class="text-center" style="min-width: 150px">Download Sertifikat</th>
                <th class="text-center"></th>
              </tr>
            </thead>
            <tbody>

              @foreach($diklats as $value)
              <tr>
                <td>{{ $value->nama_pelatihan }}</td>
                <td>{{ $value->nama_institusi }}</td>
                <td>{{ $value->lokasi_kota }}</td>
                <td  class="text-center">{{ $value->akreditasi }}</td>
                <td  class="text-center">{{ $value->tanggal_mulai }}</td>
                <td  class="text-center">{{ $value->tanggal_selesai }}</td>
                <td>{{ $value->jenis_diklat }}</td>
                <td>{{ $value->no_sertifikat }}</td>
                <td class="text-right">{{ $value->jpl_diklat }}</td>
                <td class="text-center">
                  @if ($value->file)
                    <a href="{{ URL(env('PATH_DIKLAT') .'/'. $value->file) }}" target="_blank">
                      Download
                    </a>
                  @endif
                </td>

                @if (!isAdmin())
                <td  class="text-center" style="min-width: 17rem;">
                  <a href="{{ URL('/diklat/update/'. $value->id) }}">
                    <button type="button" class="btn btn-warning">
                    <i class="fa fa-edit"></i>
                    Ubah</button>
                  </a>

                  <button 
                    type="button" 
                    class="btn btn-danger" 
                    onclick="deleteRow('/diklat', {{ $value->id }})"
                  >
                    <i class="fa fa-window-close"></i>
                    Hapus
                  </button>
                </td>
                @endif

              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <!--end::Section-->
    </div>

    <!--end::Form-->
  </div>
</div>

@endsection