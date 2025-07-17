<template>

<div class="kt-portlet">
  <div class="kt-portlet__head">
    <div class="kt-portlet__head-label">
      <h3 class="kt-portlet__head-title">
        Input Aktifitas Harian
      </h3>
    </div>
  </div>

  <!--begin::Form-->
  <div class="kt-form kt-form--label-right">
    <div class="kt-portlet__body">
      <div class="form-group row">
        <label for="example-text-input" class="col-3 col-form-label">Tanggal</label>
        <div class="col-9">
          <datepicker
            input-class="form-control"
            name="date"
            placeholder="Tanggal Aktifitas"
            v-model="form.date"
            :disabled-dates="disabledDate"
          >
          </datepicker>
        </div>
      </div>

      <div class="form-group row">
        <label for="example-number-input" class="col-3 col-form-label">Aktifitas</label>
        <div class="col-9">
          <v-select
            name="aktifitas"
            placeholder="Pilih Aktifitas"
            v-model="form.name"
            :options="options.aktifitas"
            @input="getTime">
          </v-select>
        </div>
      </div>

      <div class="form-group row">
        <label for="efective-time" class="col-3 col-form-label">Waktu Efektif</label>
        <div class="col-2">
          <div class="input-group">
            <input class="form-control" type="number" v-model="form.time" disabled>
            <div class="input-group-append"><span class="input-group-text">menit</span></div>
          </div>
        </div>
      </div>

      <div class="form-group row">
        <label for="time-start" class="col-3 col-form-label">Jam Mulai</label>
        <div class="col-9">
          <vue-timepicker
            :format="timepickerFormat"
            :minute-interval="form.time"
            :disabled="this.form.time === null"
            v-model="form.start"
            hour-label="jam"
            minute-label="menit"
            close-on-complete
            @change="changeTimePicker"
          ></vue-timepicker>
        </div>
      </div>

      <div class="form-group row">
        <label for="time-end" class="col-3 col-form-label">Jam Selesai</label>
        <div class="col-9">
          <vue-timepicker
            :format="timepickerFormat"
            :minute-interval="form.time"
            :disabled="this.form.start === null || this.form.time === null"
            :hour-range="range.end.hours"
            :minute-range="range.end.minutes"
            v-model="form.end"
            hour-label="jam"
            minute-label="menit"
            close-on-complete
            @change="getVol"
          ></vue-timepicker>
        </div>
      </div>

      <div class="form-group row">
        <label for="volume" class="col-3 col-form-label">Volume</label>
        <div class="col-2">
          <div class="input-group">
            <input class="form-control" type="number" v-model="form.vol" disabled>
            <div class="input-group-append"><span class="input-group-text">Jam</span></div>
          </div>
        </div>
      </div>

      <div class="form-group row">
        <label for="example-number-input" class="col-3 col-form-label">Keterangan Aktifitas</label>
        <div class="col-9">
          <textarea class="form-control" name="description" rows="3" v-model="form.description"></textarea>
        </div>
      </div>

      <div class="form-group row">
        <label for="volume" class="col-3 col-form-label">Gambar</label>
        <div class="col-2">
          <div class="custom-file">
            <input type="file" class="custom-file-input"
              name="image"
              accept="image/*"
              ref="imageUpload"
              @change="handleFileUpload($event.target.files)"
            >
            <label class="custom-file-label" for="customFile">Pilih Gambar</label>
          </div>
        </div>
      </div>
    </div>

    <div class="kt-portlet__foot">
      <div class="kt-form__actions">
        <div class="row">
          <div class="col-9">
          </div>
          <div class="col-9">
            <button type="submit" class="btn btn-primary"
              :class="{ 'kt-spinner kt-spinner--right kt-spinner--md kt-spinner--light': isLoading }"
              :disabled="isDisabled"
              @click="init">Submit</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</template>

<script>
import 'vue-select/dist/vue-select.css';

import vSelect from 'vue-select'
import swal from 'sweetalert2';
import Datepicker from 'vuejs-datepicker';
import VueTimepicker from 'vue2-timepicker';
import 'vue2-timepicker/dist/VueTimepicker.css';

import Mixin from '~/mixins/Mixin';
import moment from 'moment';

export default {
  mixins: [
    Mixin,
  ],

  data() {
    return {
      isLoading: false,
      isDisabled: false,

      disabledDate: {
        to: moment().startOf('month')._d,
        from: moment().endOf('month')._d,
      },

      timepickerFormat: 'HH:mm',
      range: {
        end: {
          minutes: [[0, 59]],
          hours: [[0, 23]],
        },
      },

      form: {
        date: null,
        name: '',
        time: null,
        start: null,
        end: null,
        vol: null,
        description: null,
      },

      defaultActivity: [
        'Cuti',
        'Sakit',
        'Libur',
        'Izin',
      ],

      options: {
        aktifitas: [],
      },
    };
  },

  props: {
    list: {
      type: Object,
      required: false,
    },

    tupoksi: {
      type: Array,
      required: false,
    },

    employeeId: {
      type: String,
      required: true,
    },
  },

  components: {
    vSelect,
    Datepicker,
    VueTimepicker,
  },

  computed: {
    updateUrl() {
      let url = '/add/activity';

      if (this.form.id) {
        url = `/activity/edit/${this.form.id}`;
      }

      return url;
    },
  },

  methods: {
    setForm() {
      this.form.id = this.list.id;
      this.form.date = this.list.date;
      this.form.name = this.options.aktifitas.find(element => element.value == this.list.name);
      this.form.time = this.list.time;
      this.form.start = this.timeFormat('start', this.list.start);
      this.form.end = this.timeFormat('end', this.list.end);
      this.form.vol = this.list.vol;
      this.form.description = this.list.description;
    },

    timeFormat(object, value) {
      if (!value) return;

      const time = value.split(":");

      return {
        'HH': time[0],
        'mm': time[1],
      }
    },

    cutiData() {
      const vol = 8;
      this.form.vol = vol.toFixed(3);
      this.form.time = null;
      this.resetTime();
    },

    resetTime() {
      this.form.start = {
        HH: '00',
        mm: '00',
      };
      this.form.end = {
        HH: '00',
        mm: '00',
      };;
    },

    getTime() {
      this.resetTime();
      if (this.defaultActivity.includes(this.form.name.value)) {
        this.cutiData();
      } else {
        const time = this.tupoksi.filter((item) => {
          return item.id == this.form.name.value;
        });

        this.form.time = time[0].time;
        this.form.vol = null;

        if (this.form.start && this.form.end) {
          this.getVol();
        }
      }
    },

    changeTimePicker(e) {
      const hour = e.data.H;
      this.range.end.hours = [[hour, 23]];

      if (this.form.end) {
        this.getVol();
      };
    },

    getVol() {
      if (!this.defaultActivity.includes(this.form.name.value)) {
        // Get difference time in minutes
        const start  = moment(`${this.form.start.HH}:${this.form.start.mm}:00`, "HH:mm:ss");
        const end = moment(`${this.form.end.HH}:${this.form.end.mm}:00`, "HH:mm:ss");
        const minutes =  (end.diff(start)) / 60000;

        // RUMUS
        // (jam selesai - jam mulai) / waktu efektif * nilai vol
        const total = minutes / 60;

        this.form.vol = total.toFixed(3);
      }
    },

    generateData() {
      const formData = new FormData();
      formData.append('date', this.dateFormat(this.form.date));
      formData.append('name', this.form.name.value);
      formData.append('time', this.form.time);
      formData.append('vol', this.form.vol);
      formData.append('description', this.form.description);

      // time start and end
      if (this.form.time) {
        const start = `${this.form.start.HH}:${this.form.start.mm}`;
        const end = `${this.form.end.HH}:${this.form.end.mm}`;

        formData.append('start', start);
        formData.append('end', end);
      }

      // image data
      const imageUpload = this.$refs.imageUpload.files[0];
      if (imageUpload) {
        const imageExtension = imageUpload.name.substr(imageUpload.name.lastIndexOf('.') + 1);
        const imageName = `${this.employeeId}-${this.dateFormat(this.form.date)}-${this.form.name.value}.${imageExtension}`;

        formData.append('image', imageUpload, imageName);
      }

      return formData;
    },

    totalVolToday() {
      const data = {
        date: this.dateFormat(this.form.date),
        activity_id: this.form.id || null,
      };

      return new Promise((resolve) => {
        this.axios.post('/activity/check-vol', data)
          .then((result) => {
            resolve(result.data);
          })
          .catch((error) => {
            console.log('update error', error);
          });
      });
    },

    async checkVol() {
      if (this.form.vol > 8) {
        this.alertInvalidVol();
        return false;
      }

      const totalVol = await this.totalVolToday();
      if (parseFloat(totalVol) + parseFloat(this.form.vol) > 8) {
        this.alertInvalidVol();
        return false;
      }

      return true;
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
      // check there is null date
      const required = this.alertRequired();
      if (!required) return;

      this.isLoading = true;
      this.isDisabled = true;

      const isValid = await this.checkVol();
      if (isValid) {
        const data = await this.generateData();
        await this.update(data);
        window.location.href = '/activity';
      } else {
        this.alertInvalidVol();
        this.isLoading = false;
        this.isDisabled = false;
      }
    },

    alertRequired() {
      if (!this.form.date) {
        Swal.fire('Required', 'Tanggal Wajib diisi!', 'warning');
        return false;
      }

      if (!this.form.name) {
        Swal.fire('Required', 'Tupoksi Wajib diisi!', 'warning');
        return false;
      }

      if (!this.form.start && !this.defaultActivity.includes(this.form.name.value)) {
        Swal.fire('Required', 'Jam Mulai Wajib diisi!', 'warning');
        return false;
      }

      if (!this.form.end && !this.defaultActivity.includes(this.form.name.value)) {
        Swal.fire('Required', 'Jam Selesai Wajib diisi!', 'warning');
        return false;
      }

      return true;
    },

    alertInvalidVol() {
      Swal.fire(
        'Error',
        'Volume Aktifitas Anda sudah Maksimal Hari ini atau melebihi batas maksimal!',
        'error'
      );
    },

    setAktifitasOption() {
      const base = this.defaultActivity.map(item => ({
        label: item,
        value: item,
      }));

      const aktifitas = this.tupoksi.map(item => ({
        label: item.description,
        value: item.id,
      }));

      return [
        ...base,
        ...aktifitas,
      ];
    },
  },

  created() {
    this.options.aktifitas = this.setAktifitasOption();

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
