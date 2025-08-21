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
        </div>
      </form>
    </div>
  </div>
  <div class="kt-portlet">
    <div class="kt-portlet__head">
      <div class="kt-portlet__head-label">
        <h3 class="kt-portlet__head-title">
          Daftar Liburan
        </h3>
      </div>
      <div class="mt-2">
        <a href="{{ URL('/holiday/add') }}">
          <button type="button" class="btn btn-primary btn-wide"><i class="fa fa-plus"></i> Tambah Liburan</button>
        </a>
        <form action="{{ url('/holiday/sync') }}" method="POST" style="display:inline;">
          @csrf
          <button type="submit" class="btn btn-success btn-wide">
              <i class="fa fa-sync"></i> Sync Liburan
          </button>
        </form>
      </div>
    </div>
    <div class="kt-portlet__body">

      <!--begin::Section-->
      <div class="kt-section">
        <div class="kt-section__content table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody>
              @php $no=1; @endphp
              @foreach($list as $value)
              <tr>
                <th scope="row">{{ $no++ }}</th>
                <td>{{ \Carbon\Carbon::parse($value->date)->format('d F Y') }}</td>
                <td>{{ $value->description }}</td>
                <td>
                  <a href="{{ URL('/holiday/edit/'. $value->id) }}">
                    <button type="button" class="btn btn-warning">
                    <i class="fa fa-edit"></i>
                    Ubah</button>
                  </a>

                  <button type="button" class="btn btn-danger" onclick="deleteRow('/holiday', {{ $value->id }})">
                  <i class="fa fa-window-close"></i>
                  Hapus</button>
                </td>
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
