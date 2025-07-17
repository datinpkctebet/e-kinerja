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

          @if (@$total)
          <div class="col-6 text-right">
            <span>
              Total Vol
              <h2 class="kt-font-danger"
                style="
                display: inline;
                vertical-align: middle;
                margin-left: 1rem;
                ">{{ $total }}</h2>
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
        <h3 class="kt-portlet__head-title">
          Daftar Inputan Aktifitas
        </h3>
      </div>
      @if (session('employee')['privilege'] === 'Pegawai')
      <div class="mt-3">
        <a href="{{ URL('/activity/export/'. $year_now .'/'. $month_now) }}">
          <button type="button" class="btn btn-primary btn-wide">Export</button>
        </a>
      </div>
      @endif

      @if (@$isKapuskes)
      <div class="mt-3">
        <a href="{{ URL('/validation/'. $employee_id .'/accept_all') }}">
          <button type="button" class="btn btn-success">
            <i class="fa fa-check"></i> diterima semua
          </button>
        </a>
      </div>
      @endif
    </div>

    <div class="kt-portlet__body">
      <!--begin::Section-->
      <div class="kt-section">
        <div class="kt-section__content table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th class="text-center" style="min-width: 8rem;">Tanggal</th>
                <th class="text-center" style="min-width: 15rem;">Aktifitas</th>
                <th class="text-center" style="min-width: 8rem;">Waktu Efektif</th>
                <th class="text-center" style="min-width: 8rem;">Jam Mulai</th>
                <th class="text-center" style="min-width: 8rem;">Jam Selesai</th>
                <th class="text-center">Vol</th>
                <th class="text-center" style="min-width: 20rem;">Keterangan Aktifitas</th>
                <th class="text-center">Foto</th>
                <th class="text-center">Status</th>
                <th class="text-center"></th>
              </tr>
            </thead>
            <tbody>
              @foreach($list as $value)
              <tr class="@if(empty($value->tupoksi->description)) table-warning @endif">
                <td class="text-center">{{ $value->date }}</td>

                @if (@$value->tupoksi->description)
                <td>{{ $value->tupoksi->description  }}</td>
                <td class="text-center">{{ $value->time }} Menit</td>
                <td class="text-center">{{ $value->start }}</td>
                <td class="text-center">{{ $value->end }}</td>
                <td class="text-center">{{ $value->vol }}</td>
                <td>{{ $value->description }}</td>
                @else
                <td colspan="6">{{ $value->name  }}</td>
                @endif
                <td class="text-center">{!! isVerifyHtml($value->foto) !!}</td>
                <td>
                  @if ($value->image)
                  <img src="{{ isImage(env('PATH_ACTIVITY'), $value->image) }}" width="200px">
                  @endif
                </td>
                <td class="text-center">{!! isVerifyHtml($value->status) !!}</td>

                <td  class="text-center" style="min-width: 18rem;">
                  @if (@$isKapuskes)
                    @if (@$value->status == 0 || @$value->status == 1)
                    <a href="{{ URL('/validation/'. $value->id .'/reject') }}">
                    <button type="button" class="btn btn-warning">
                      <i class="fa fa-times"></i>
                      ditolak</button>
                    </a>
                    @endif

                    @if (@$value->status == 0 || @$value->status == 2)
                    <a href="{{ URL('/validation/'. $value->id .'/accept') }}">
                      <button type="button" class="btn btn-success">
                      <i class="fa fa-check"></i>
                      diterima</button>
                    </a>
                    @endif
                  @else
                    <a href="{{ URL('/activity/edit/'. $value->id) }}">
                      <button type="button" class="btn btn-warning">
                      <i class="fa fa-edit"></i>
                      Ubah</button>
                    </a>

                    <button type="button" class="btn btn-danger" onclick="deleteRow('/activity', {{ $value->id }})">
                      <i class="fa fa-window-close"></i>
                      Hapus</button>
                  @endif
                </td>

              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        {{ $list->links() }}
      </div>

      <!--end::Section-->
    </div>

    <!--end::Form-->
  </div>
</div>

@endsection
