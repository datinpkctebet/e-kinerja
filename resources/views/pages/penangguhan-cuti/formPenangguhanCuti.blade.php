@extends('layout.default')

@section('content')


<div class="kt-portlet">
  <div class="kt-portlet__head">
    <div class="kt-portlet__head-label">
      <h3 class="kt-portlet__head-title">
        Input Penangguhan Cuti
      </h3>
    </div>
  </div>

  <!--begin::Form-->
  <form class="kt-form kt-form--label-right" method="POST" action="{{ URL(setPostUrl()) }}">
    {{ csrf_field() }}

    <div class="kt-portlet__body">

      <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label">Bulan</label>
        <div class="col-9">
          <input class="form-control" type="number" name="month" value="{{ isset($list) ? $list['month'] : '' }}" placeholder="Bulan" max="12" min="1">
        </div>
      </div>

      <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label">Status Aktif</label>
        <div class="col-9">
          <div class="custom-control custom-switch" style="margin-top: 7px;">
            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" {{ (isset($list) && $list['is_active']) ? 'checked' : '' }}>
            <label class="custom-control-label" for="is_active"></label>
          </div>
        </div>
      </div>

      <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label">Keterangan</label>
        <div class="col-9">
          <textarea name="description" class="form-control" placeholder="Keterangan">{{ @$list['description'] }}</textarea>
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
            <a href="{{ URL('/penangguhan-cuti') }}">
              <button type="button" class="btn btn-secondary">Cancel</button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    // Jalankan sekali saat load page
    if($("#is_active").is(":checked")) {
        $("label[for='is_active']").text("Aktif");
    } else {
        $("label[for='is_active']").text("Tidak Aktif");
    }

    // Saat toggle diubah
    $("#is_active").change(function() {
        if($(this).is(":checked")) {
            $("label[for='is_active']").text("Aktif");
        } else {
            $("label[for='is_active']").text("Tidak Aktif");
        }
    });
  });
</script>

@endsection