@extends('layout.default')

@section('content')

<form-penilaian
  :question="{{ json_encode($question) }}"
  :employee="{{ json_encode($employee) }}"
></form-penilaian>

@endsection
