@extends('layout.default')

@section('content')

@php
    $date = \Carbon\Carbon::parse(isset($list['date']) ? $list['date'] : null)->format('m/d/Y');
@endphp

<div class="kt-portlet">
  <div class="kt-portlet__head">
    <div class="kt-portlet__head-label">
      <h3 class="kt-portlet__head-title">
        Input Liburan
      </h3>
    </div>
  </div>

  <!--begin::Form-->
  <form class="kt-form kt-form--label-right" method="POST" action="{{ URL(setPostUrl()) }}">
    {{ csrf_field() }}

    <div class="kt-portlet__body">

      <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label">Tanggal Liburan</label>
        <div class="col-9">
          <input class="form-control" type="text" name="date" value="{{ $date }}" placeholder="Tanggal Liburan">
        </div>
      </div>

      <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label">Keterangan Liburan</label>
        <div class="col-9">
          <textarea name="description" class="form-control" placeholder="Keterangan Liburan">{{ @$list['description'] }}</textarea>
        </div>
      </div>

    </div>
    <div class="kt-portlet__foot">
      <div class="kt-form__actions">
        <div class="row">
          <div class="col-9">
          </div>
          <div class="col-9">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ URL('/holiday') }}">
              <button type="button" class="btn btn-secondary">Cancel</button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<script type="text/javascript">
  $(function() {
    $('input[name="date"]').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      locale: {
        cancelLabel: 'Clear'
      }
    });

    $('input[name="date"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY'));
    });

    $('input[name="date"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
  });
</script>

@endsection