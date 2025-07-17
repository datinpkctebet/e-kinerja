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
