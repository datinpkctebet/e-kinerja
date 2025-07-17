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

  <div class="row">
    <div class="col-xl-6">
      <div class="kt-portlet">
        <div class="kt-portlet__head">
          <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
              Absensi
            </h3>
          </div>
        </div>

        <div class="kt-portlet__body">
          <div class="kt-section">
            <table class="table table-hover">
              <thead class="thead-dark">
                <tr>
                  <th>Keterangan</th>
                  <th class="text-center">Jumlah Hari</th>
                </tr>
              </thead>

              <tbody>
                <tr>
                  <td>Total Hari Kerja</td>
                  <td class="text-center">{{ @$employee->absensis[0]->hari_kerja }}</td>
                </tr>
                <tr>
                  <td>Total Telat</td>
                  <td class="text-center">{{ @$employee->absensis[0]->telat }}</td>
                </tr>
                <tr>
                  <td>Total Pulang Cepat</td>
                  <td class="text-center">{{ @$employee->absensis[0]->pulang_cepat }}</td>
                </tr>
                <tr>
                  <td>Total Sakit</td>
                  <td class="text-center">{{ @$employee->absensis[0]->sakit }}</td>
                </tr>
                <tr>
                  <td>Total Izin</td>
                  <td class="text-center">{{ @$employee->absensis[0]->izin }}</td>
                </tr>
                <tr>
                  <td>Total Alfa</td>
                  <td class="text-center">{{ @$employee->absensis[0]->alfa }}</td>
                </tr>
              </tbody>

              <tfoot class="thead-light">
                <tr>
                  <th>Total akumulasi telat dalam tahun berjalan = </th>
                  <th style="text-align: right; padding-right: 10%; width:150px;">{{ @$total_telat }} (Menit)</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-6">
      <div class="kt-portlet">
        <div class="kt-portlet__head">
          <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
              TKD
            </h3>
          </div>
        </div>
        <div class="kt-portlet__body">

          <!--begin::Section-->
          <div class="kt-section">
            <table class="table table-hover">
              <thead class="thead-dark">
                <tr>
                  <th>Keterangan</th>
                  <th class="text-center">Nilai</th>
                </tr>
              </thead>

              <tbody>
                <tr>
                  <td>Absensi(30%)</td>
                  <td style="text-align: right; padding-right: 10%;">{{ $employee->nilai_absensi }}</td>
                </tr>
                <tr>
                  <td>Aktifitas(30%)</td>
                  <td style="text-align: right; padding-right: 10%;">{{ $employee->nilai_activity }}</td>
                </tr>
                <tr>
                  <td>KBK(10%)</td>
                  <td style="text-align: right; padding-right: 10%;">{{ $employee->nilai_kbk }}</td>
                </tr>
                <tr>
                  <td>Penilaian(10%)</td>
                  <td style="text-align: right; padding-right: 10%;">{{ $employee->nilai_penilaian }}</td>
                </tr>
                <tr>
                  <td>Penyerapan(20%)</td>
                  <td style="text-align: right; padding-right: 10%;">{{ $employee->nilai_penyerapan }}</td>
                </tr>
              </tbody>

              <tfoot class="thead-light">
                <tr>
                  <th>Total</th>
                  <th style="text-align: right; padding-right: 10%;">{{ $employee->nilai_total }}</th>
                </tr>
              </tfoot>
            </table>
          </div>

          <!--end::Section-->
        </div>

        <!--end::Form-->
      </div>
    </div>
  </div>
</div>

@endsection
