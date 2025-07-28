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

function deleteRow(url, id) {
	swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Yes, delete it!'
	}).then(function (result) {
		if (result.value) {
			$.ajax({
				type: "GET",
				url: `${url}/delete/${id}`,
				success: function () {
					swal.fire({
						title: 'Deleted',
						text: 'Your data was successfully deleted!',
						type: 'success'
					}).then(function () {
						window.location.reload();
					});
				},
				failure: function () {
					swal.fire(
						'Oops',
						'We couldnt connect to the server!',
						'error'
					);
				}
			})
		}
	});
}

function setNilaiKbk() {
	Swal.fire({
		title: 'Set Nilai KBK',
		input: 'text',
		showCancelButton: true,
		confirmButtonText: 'Save',
		showLoaderOnConfirm: true
	}).then((result) => {
		if (result.value) {
			const params = {
				'value' : result.value,
			};

			$.ajax({
				type: "POST",
				url: "nilai-kbk/store",
				data: params,
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				success: function () {
					swal.fire({
						title: 'Berhasil',
						text: 'Nilai KBK berhasil diubah',
						type: 'success'
					}).then(function () {
						window.location.reload();
					});
				},
				failure: function () {
					swal.fire(
						'Oops',
						'We couldnt connect to the server!',
						'error'
					);
				}
			})
		}
	})
}

function lockCuti(url, id) {
	swal.fire({
		title: 'Apakah Anda Yakin?',
		text: "You won't be able to revert this!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Yes, lock it!'
	}).then(function (result) {
		if (result.value) {
			$.ajax({
				type: "GET",
				url: `${url}/${id}`,
				success: function (response) {
					swal.fire({
						title: 'Updated',
						text: 'Your data was successfully locked!',
						type: 'success'
					}).then(function () {
						window.location.reload();
					});
				},
				error: function (error) {
					swal.fire(
						'Oops',
						error.responseJSON.message,
						'error'
					);
				},
				failure: function (error) {
					swal.fire(
						'Oops',
						'We couldnt connect to the server!',
						'error'
					);
				}
			})
		}
	});
}
