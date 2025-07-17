@extends('layout.default')

@section('content')

<div class="kt-portlet">
  <div class="kt-portlet__head">
    <div class="kt-portlet__head-label">
      <h3 class="kt-portlet__head-title">
        Reset Password
      </h3>
    </div>
  </div>

  <!--begin::Form-->
  <form class="kt-form kt-form--label-right" method="POST" action="{{ URL(setPostUrl()) }}">
    {{ csrf_field() }}

    <div class="kt-portlet__body">

      <div class="form-group row">
        <label for="example-number-input" class="col-3 col-form-label">Password</label>
        <div class="col-9">
          <input class="form-control" type="password" name="password" placeholder="Password">
        </div>
      </div>

      <div class="form-group row">
        <label for="example-number-input" class="col-3 col-form-label">Retype Password</label>
        <div class="col-9">
          <input class="form-control" type="password" name="retype_password" placeholder="Retype Password">
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
            <a href="{{ URL('/employee') }}">
              <button type="button" class="btn btn-secondary">Cancel</button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

@endsection