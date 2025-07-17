<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
var KTAppOptions = {
  "colors": {
      "state": {
      "brand": "#5d78ff",
      "dark": "#282a3c",
      "light": "#ffffff",
      "primary": "#5867dd",
      "success": "#34bfa3",
      "info": "#36a3f7",
      "warning": "#ffb822",
      "danger": "#fd3995"
    },
    "base": {
      "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
      "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
    }
  }
};
</script>

<!--begin:: Global Mandatory Vendors -->
<script src="{{ asset('vendors/general/jquery/dist/jquery.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/popper.js/dist/umd/popper.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/js-cookie/src/js.cookie.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/moment/min/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/tooltip.js/dist/umd/tooltip.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/perfect-scrollbar/dist/perfect-scrollbar.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/sticky-js/dist/sticky.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/wnumb/wNumb.js') }}" type="text/javascript"></script>

<!--begin:: Global Optional Vendors -->
<script src="{{ asset('vendors/general/jquery-form/dist/jquery.form.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/block-ui/jquery.blockUI.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/custom/js/vendors/bootstrap-datepicker.init.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/custom/js/vendors/bootstrap-timepicker.init.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/bootstrap-daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/bootstrap-maxlength/src/bootstrap-maxlength.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/custom/vendors/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/bootstrap-select/dist/js/bootstrap-select.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/bootstrap-switch/dist/js/bootstrap-switch.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/custom/js/vendors/bootstrap-switch.init.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/select2/dist/js/select2.full.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/ion-rangeslider/js/ion.rangeSlider.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/typeahead.js/dist/typeahead.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/handlebars/dist/handlebars.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/inputmask/dist/jquery.inputmask.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/inputmask/dist/inputmask/inputmask.date.extensions.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/inputmask/dist/inputmask/inputmask.numeric.extensions.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/nouislider/distribute/nouislider.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/owl.carousel/dist/owl.carousel.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/autosize/dist/autosize.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/clipboard/dist/clipboard.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/dropzone/dist/dropzone.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/summernote/dist/summernote.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/markdown/lib/markdown.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/bootstrap-markdown/js/bootstrap-markdown.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/custom/js/vendors/bootstrap-markdown.init.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/bootstrap-notify/bootstrap-notify.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/custom/js/vendors/bootstrap-notify.init.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/jquery-validation/dist/jquery.validate.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/jquery-validation/dist/additional-methods.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/custom/js/vendors/jquery-validation.init.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/toastr/build/toastr.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/raphael/raphael.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/morris.js/morris.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/chart.js/dist/Chart.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/custom/vendors/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/custom/vendors/jquery-idletimer/idle-timer.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/waypoints/lib/jquery.waypoints.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/counterup/jquery.counterup.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/es6-promise-polyfill/promise.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/sweetalert2/dist/sweetalert2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/custom/js/vendors/sweetalert2.init.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/jquery.repeater/src/lib.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/jquery.repeater/src/jquery.input.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/jquery.repeater/src/repeater.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/general/dompurify/dist/purify.js') }}" type="text/javascript"></script>

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="{{ asset('js/scripts.bundle.js') }}" type="text/javascript"></script>

<!--begin::Page Vendors(used by this page) -->
<script src="{{ asset('vendors/custom/fullcalendar/fullcalendar.bundle.js') }}" type="text/javascript"></script>

<!--begin::Page Scripts(used by this page) -->
<script src="{{ asset('js/all.js?v=1.0.1') }}" type="text/javascript"></script>

{{-- VUE JS --}}
<script src="{{ mix('js/manifest.js') }}"></script>
<script src="{{ mix('js/vendor.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>
