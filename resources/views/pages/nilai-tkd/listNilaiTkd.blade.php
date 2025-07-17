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
          List TKD Pegawai
        </h3>
      </div>
      <div class="mt-2">
        {{-- <button type="button" class="btn btn-primary btn-wide"></button> --}}
      </div>
    </div>
    <div class="kt-portlet__body">

      <!--begin::Section-->
      <div class="kt-section">
        <div class="kt-section__content table-responsive">
          <table class="table table-hover">
            <thead class="thead-dark">
              <tr>
                <th>Nama Pegawai</th>
                <th>Absensi (30%)</th>
                <th>Aktifitas (30%)</th>
                <th>KBK (10%)</th>
                <th>Penilaian (10%)</th>
                <th>Penyerapan (20%)</th>
                <th>Total (100%)</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($employee as $item)
              <tr>
                <td>{{ $item->name }}</td>
                <td class="text-nilai">{{ $item->nilai_absensi }}</td>
                <td class="text-nilai">{{ $item->nilai_activity }}</td>
                <td class="text-nilai">{{ $item->nilai_kbk }}</td>
                <td class="text-nilai">{{ $item->nilai_penilaian }}</td>
                <td class="text-nilai">{{ $item->nilai_penyerapan }}</td>
                <td class="text-nilai">{{ $item->nilai_total }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        {{ $employee->links() }}
      </div>

      <!--end::Section-->
    </div>

    <!--end::Form-->
  </div>
</div>

@endsection

<style scoped>
  .text-nilai {
    text-align: center;
    padding-right: 2rem !important;
  }
</style>
