<template>
  <form class="kt-form kt-form--label-right">
    <div class="kt-portlet__body">

      <div class="form-group row">
        <label class="col-3 col-form-label">Jenis Cuti</label>
        <div class="col-9">
          <select class="form-control" v-model="form.jenis">
            <option disabled value="" selected>Pilih Jenis Cuti</option>
            <option
              v-for="(item, index) in jenisCuti" :key="index"
              :value="item"
            >{{ item }}</option>
          </select>
        </div>
      </div>

      <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label">Nama</label>
        <div class="col-9">
          <input class="form-control"
            type="text"
            v-model="employee.name"
            :disabled="true"
          >
        </div>
      </div>

      <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label">NIP</label>
        <div class="col-9">
          <input class="form-control"
            type="text"
            v-model="employee.nip"
            :disabled="true"
          >
        </div>
      </div>

      <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label">Pangkat / Golongan</label>
        <div class="col-9">
          <input class="form-control"
            type="text"
            v-model="employee.golongan"
            :disabled="true"
          >
        </div>
      </div>

      <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label">Jabatan</label>
        <div class="col-9">
          <input class="form-control"
            type="text"
            v-model="employee.first_array_jabatan"
            :disabled="true"
          >
        </div>
      </div>

      <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label">Tempat Bekerja</label>
        <div class="col-9">
          <input class="form-control"
            type="text"
            placeholder="Tempat Bekerja"
            v-model="form.tempat"
          >
        </div>
      </div>

      <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label">Satuan Organisasi</label>
        <div class="col-9">
          <input class="form-control"
            type="text"
            v-model="form.satuanOrganisasi"
            :disabled="true"
          >
        </div>
      </div>

      <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label">Periode Cuti</label>
        <div class="row col-9">
          <div class="col-6">
            <datepicker
              input-class="form-control"
              name="mulai-cuti"
              placeholder="Dari"
              v-model="form.mulai"
            ></datepicker>
          </div>
          <div class="col-6">
            <datepicker
              input-class="form-control"
              name="selesai-cuti"
              placeholder="Sampai"
              v-model="form.selesai"
            ></datepicker>
          </div>
        </div>
      </div>
    </div>

    <div class="kt-portlet__foot">
      <div class="kt-form__actions">
        <div class="row">
          <div class="col-9">
            <button class="btn btn-clean btn-bold" @click.prevent="back()">Kembali</button>
            <button class="btn btn-brand btn-bold"
              :class="{ 'kt-spinner kt-spinner--right kt-spinner--md kt-spinner--light': isSubmit }"
              :disabled="isSubmit"
              @click.prevent="init()"
            >Simpan</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</template>

<script>
import Datepicker from 'vuejs-datepicker';

import Mixin from '~/mixins/Mixin';

export default {
  mixins: [
    Mixin,
  ],

  data() {
    return {
      isSubmit: false,

      form: {
        id: null,
        jenis: 'Cuti Tahunan',
        tempat: null,
        satuanOrganisasi: 'Suku Dinas Kesehatan Kota Administrasi Jakarta Selatan',
        mulai: null,
        selesai: null,
      },
    };
  },

  props: {
    list: {
      type: Object,
      required: false,
    },

    jenisCuti: {
      type: Array,
      required: false,
    },

    employee: {
      type: Object,
      required: true,
    },
  },

  components: {
    Datepicker,
  },

  computed: {
    updateUrl() {
      let url = '/surat-pengajuan/add';

      if (this.form.id) {
        url = `/surat-pengajuan/edit/${this.form.id}`;
      }

      return url;
    },
  },

  methods: {
    back() {
      window.location.href = '/surat-pengajuan';
    },

    setForm() {
      this.form.id = this.list.id;
      this.form.jenis = this.list.jenis;
      this.form.tempat = this.list.tempat;
      this.form.mulai = this.list.mulai;
      this.form.selesai = this.list.selesai;
    },

    generateData() {
      return {
        employee_id: this.employee.id,
        jenis: this.form.jenis,
        tempat: this.form.tempat,
        satuan_organisasi: this.form.satuanOrganisasi,
        mulai: this.dateFormat(this.form.mulai),
        selesai: this.dateFormat(this.form.selesai),
      };
    },

    update(data) {
      return new Promise((resolve) => {
        this.axios.post(this.updateUrl, data)
        .then(() => {
            resolve();
        })
        .catch((error) => {
          console.log('update error', error);
        });
      });
    },

    async init() {
      this.isSubmit = true;

      const required = this.alertRequired();
      if (!required) {
        this.isSubmit = false;
        return;
      }

      const data = await this.generateData();

      await this.update(data);
      await this.back();
    },

    alertRequired() {
      if (!this.form.tempat) {
        Swal.fire('Required', 'Tempat Bekerja Wajib diisi!', 'warning');
        return false;
      }

      if (!this.form.mulai) {
        Swal.fire('Required', 'Tanggal Mulai Cuti Wajib diisi!', 'warning');
        return false;
      }

      if (!this.form.selesai) {
        Swal.fire('Required', 'Tanggal Selesai Cuti Wajib diisi!', 'warning');
        return false;
      }

      return true;
    },
  },

  created() {
    if (this.list) {
      this.setForm();
    }
  },
}
</script>

<style scoped>
.custom-file-label {
  text-align: left !important;
}
</style>
