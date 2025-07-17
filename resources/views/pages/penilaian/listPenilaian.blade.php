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
          Daftar Pegawai
        </h3>
      </div>

      <div class="mt-3">
        <a href="{{ route('penilaian.add', ['month' => $monthSelect, 'year' => $yearSelect]) }}">
          <button type="button" class="btn btn-primary btn-wide">Tambah Penilaian Pegawai</button>
        </a>
      </div>
    </div>

    <div class="kt-portlet__body">
      <!--begin::Section-->
      <div class="kt-section">
        <div class="kt-section__content table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Nama Pegawai</th>
                <th class="text-center">No Pegawai</th>
                <th class="text-center">Total Nilai</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($list as $value)
              <tr>
                <td>{{ $value->name }}</td>
                <td class="text-center">{{ $value->nip }}</td>
                <td class="text-center">{{ $value->penilaians[0]->score }}</td>
                <td  class="text-right" style="min-width: 17rem;">
                  <button type="button" class="btn btn-danger" onclick="deleteRow('/penilaian', {{ $value->penilaians[0]->id }})">
                    <i class="fa fa-window-close"></i>
                    Hapus</button>
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
