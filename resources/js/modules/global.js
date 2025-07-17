// Class definition

var KTBootstrapDatepicker = function() {

  var arrows;
  if (KTUtil.isRTL()) {
    arrows = {
      leftArrow: '<i class="la la-angle-right"></i>',
      rightArrow: '<i class="la la-angle-left"></i>'
    }
  } else {
    arrows = {
      leftArrow: '<i class="la la-angle-left"></i>',
      rightArrow: '<i class="la la-angle-right"></i>'
    }
  }

  // Private functions
  var demos = function() {
    // datepicker minimum setup
    $('.datepicker-default').datepicker({
      rtl: KTUtil.isRTL(),
      todayHighlight: true,
      orientation: "bottom left",
      templates: arrows,
      format: "yyyy-mm-dd",
    });

    // datepicker show year only
    $('.datepicker-year').datepicker({
      rtl: KTUtil.isRTL(),
      todayHighlight: true,
      orientation: "bottom left",
      templates: arrows,
      format: "yyyy",
      viewMode: "years",
      minViewMode: "years"
    });

    // touchspin minimum setup
    $('.touchspin-default').TouchSpin({
      buttondown_class: 'btn btn-secondary',
      buttonup_class: 'btn btn-secondary',

      min: 0,
    });

    // text editor
    $('.summernote').summernote({
      height: 150
    });

    // timepicker
    $('.kt_timepicker_2').timepicker({
      minuteStep: 1,
      showMeridian: false,
      snapToStep: true
    });

    // Private functions
    $('.kt_repeater_1').repeater({
      initEmpty: false,

      defaultValues: {
        'text-input': 'foo'
      },

      show: function() {
        $(this).slideDown();
      },

      hide: function(deleteElement) {
        $(this).slideUp(deleteElement);
      }
    });

    $('#kt_select2_3, #kt_select2_3_validate').select2({
      placeholder: "Pilih Daftar Peserta",
      tags: true,
    });

    $("#kt_select2_3").on("select2:select", function (evt) {
      const element = evt.params.data.element;
      const $element = $(element);

      $element.detach();
      $(this).append($element);
      $(this).trigger("change");
    });

    $('#kt_select2_1').select2({
      placeholder: "Pilih Pegawai",
    });
  }

  return {
    // public functions
    init: function() {
      demos();
    }
  };
}();

jQuery(document).ready(function() {
  KTBootstrapDatepicker.init();
});
