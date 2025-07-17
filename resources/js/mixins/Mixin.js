import moment from 'moment';

export default {
	methods: {
		dateFormat(date) {
			if (!date) return null;
			return moment(date).format('YYYY-MM-DD');
		},

		numberFormat(number) {
			if (!number) number = 0;
			return parseInt(number);
		},

		addItem(type) {
			if (type === 'pendidikan') {
				this.form.pendidikans.push({
					jenjang: null,
					jurusan: null,
					nama_sekolah: null,
					tgl_masuk: null,
					tgl_keluar: null,
					kota: null,
					no_ijazah: null,
					tgl_ijazah: null,
				});
			}

			if (type === 'keluarga') {
				this.form.keluargas.push({
					nama: null,
					tempat_lahir: null,
					tgl_lahir: null,
					jenis_kelamin: null,
					hubungan: '',
					pendidikan: '',
					keterangan: null,
				});
			}

			if (type === 'riwayat-jabatan') {
				this.form.riwayat_jabatan.push({
					unit_kerja_lama: null,
					masa_kerja: null,
					no_sk: null,
					jenis_pegawai: null,
					tgl_sk: null,
					jabatan: null,
					tmt_sk: null,
					rumpun_jabatan: null,
				});
			}

			if (type === 'riwayat-mutasi') {
				this.form.riwayat_mutasi.push({
					unit_kerja_sekarang: null,
					unit_kerja_lama: null,
					no_sk: null,
					tgl_sk: null,
					no_spmt: null,
					tgl_spmt: null,
					keterangan: null,
				});
			}

			if (type === 'diklat') {
				this.form.diklats.push({
					pelatihan: null,
					institusi: null,
					mulai: null,
					selesai: null,
					jenis: '',
					no_sertifikat: null,
				    durasi: null,
				});
			}

			if (type === 'hukuman-disiplin') {
				this.form.hukuman_disiplin.push({
					no_sk: null,
					tgl_sk: null,
					mulai: null,
					selesai: null,
					pejabat_menetapkan: null,
					nama_pejabat: null,
					tingkat: null,
					keterangan: null,
				});
			}

			if (type === 'peningkatan-pendidikan') {
				this.form.peningkatan_pendidikan.push({
					jenis: '',
					no_sertifikat: null,
					tgl_sertifikat: null,
					no_izin: null,
					tgl_izin: null,
					keterangan: null,
				});
			}

			if (type === 'dokumen-lain') {
				this.form.dokumen_lain.push({
					keterangan: null,
				});
			}
		},

		removeItem(item, object) {
			this.$swal({
				title: 'Delete Item',
				text: 'Are you sure to delete this item?',
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#666',
				confirmButtonText: 'Yes',
			}).then((result) => {
				if (result.value) {
					const index = object.indexOf(item);
					object.splice(index, 1);
				}
			});
		},

		generateArrFile(ref, type) {
			if (typeof ref === 'undefined') return [];

			const data = ref.map((item, index) => {
				if (item.files.length > 0) {
					return {
						id: index,
						file: item.files[0],
						name: this.generateFileName(type, item.files[0], index),
					}
				}
			}).filter(el => {
				return el != null;
			});

			return data;
		},

		generateFileName(type, file, index) {
			const employeeId = this.$store.state.employeeId;
			const ext = file.name.substr(file.name.lastIndexOf('.') + 1);

			return `${employeeId}-${type}-${index}.${ext}`;
		},

		getFileName(index, arr) {
			if (arr.length > 0) {
				const obj = arr.find(item => item.id === index);
				return obj ? obj.name : null;
			}

			return null;
		},

		handleFileUpload(e) {
      const validate = this.validateFileUpload(e);

      if (validate) {
        let message = '';

        if (validate === 'extension') {
          message = 'File tidak valid!';
        }

        if (validate === 'size') {
          message = 'Ukuran file tidak valid!';
        }

        Swal.fire(
          'error!',
          message,
          'error'
        );

        return;
      }
    },

    validateFileUpload(file) {
      const allowedExtensions = /(\.jpg|\.jpeg|\.png|\.doc|\.docx|\.pdf|\.xls|\.xlsx)$/i;
      const fileName = file[0].name;
      const fileSize = file[0].size;

      if (!allowedExtensions.exec(fileName)) {
        return 'extension';
      }

      if (fileSize > 2000000) {
        return 'size';
      }

      return null;
    },
	},
}
