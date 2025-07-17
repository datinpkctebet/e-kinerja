<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="description" content="Tabbed subheader example">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Aplikasi | Puskesmas Tebet</title>

  @include('partial.head.scriptHead')
  @include('partial.head.styleHead')
  @stack('css')
</head>

<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">
  @include('partial.headerMobile')

  @include('partial.body.indexBody')

  @include('partial.script')

  @stack('scripts')
  @stack('js')
</body>
</html>
