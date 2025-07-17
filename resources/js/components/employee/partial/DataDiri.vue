<template>
  <div class="kt-form__body">
    <div class="form-group row">
      <div class="col-lg-6">
        <label>No. Pegawai/NIP <span class="text-danger">*</span></label>
        <input class="form-control" type="text" placeholder="No. Pegawai/NIP"
          v-model="dataDiri.nip">
      </div>
      <div class="col-lg-6">
        <label>NRK</label>
        <input class="form-control" type="text" placeholder="NRK"
          v-model="dataDiri.nrk">
      </div>
    </div>

    <div class="form-group row">
      <div class="col-lg-6">
        <label>Nama Pegawai <span class="text-danger">*</span></label>
        <input class="form-control" type="text" placeholder="Nama Pegawai"
          v-model="dataDiri.nama">
      </div>
      <div class="col-lg-6">
        <label>No. Seri Karpeg</label>
        <input class="form-control" type="number" placeholder="No. Seri Karpeg"
          v-model="dataDiri.no_seri_karpeg">
      </div>
    </div>

    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>

    <div class="form-group row">
      <div class="col-lg-6">
        <label>Alamat <span class="text-danger">*</span></label>
        <textarea class="form-control" rows="3"
          v-model="dataDiri.alamat"></textarea>
      </div>
      <div class="col-lg-6">
        <label>Jenis Kelamin <span class="text-danger">*</span></label>
        <div class="kt-radio-list">
          <label class="kt-radio">
            <input type="radio"
              :value="`M`"
              v-model="dataDiri.jenis_kelamin"
            > Laki - Laki
            <span></span>
          </label>
          <label class="kt-radio">
            <input type="radio"
              :value="`F`"
              v-model="dataDiri.jenis_kelamin"
            > Perempuan
            <span></span>
          </label>
        </div>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-lg-6">
        <label>Tempat, Tanggal Lahir <span class="text-danger">*</span></label>
        <div class="row">
          <div class="col-lg-6 col-xl-6">
            <input class="form-control" type="text" placeholder="Tempat Lahir"
              v-model="dataDiri.tempat_lahir">
          </div>
          <div class="col-lg-6 col-xl-6">
            <datepicker
            input-class="form-control"
            name="tgl-lahir-data-diri"
            placeholder="Tanggal Lahir"
            v-model="dataDiri.tgl_lahir"
          ></datepicker>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <label>Status Perkawinan <span class="text-danger">*</span></label>
        <select class="form-control" v-model="dataDiri.status_perkawinan">
          <option disabled value="" selected>Pilih Status Perkawinan</option>
          <option
            v-for="(item, index) in statusPerkawinan" :key="index"
            :value="item"
          >{{ item }}</option>
        </select>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-lg-6">
        <label>Agama <span class="text-danger">*</span></label>
        <select class="form-control" v-model="dataDiri.agama">
          <option disabled value="" selected>Pilih Agama</option>
          <option
            v-for="(item, index) in agama" :key="index"
            :value="item"
          >{{ item }}</option>
        </select>
      </div>
    </div>

    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>

    <div class="form-group row">
      <div class="col-lg-6">
        <label>Nama Pasangan</label>
        <input class="form-control" type="text" placeholder="Nama Pasangan"
          v-model="dataDiri.nama_pasangan">
      </div>
      <div class="col-lg-6">
        <label>No. BPJS Kesehatan</label>
        <input class="form-control" type="number" placeholder="No. BPJS Kesehatan"
          v-model="dataDiri.no_bpjs_kesehatan">
      </div>
    </div>

    <div class="form-group row">
      <div class="col-lg-6">
        <label>Jumlah Anak</label>
        <input type="number" class="form-control touchspin-default"
          v-model="dataDiri.jumlah_anak">
      </div>
      <div class="col-lg-6">
        <label>No. BPJS Ketenagakerjaan</label>
        <input class="form-control" type="number" placeholder="No. BPJS Ketenagakerjaan"
          v-model="dataDiri.no_bpjs_ketenagakerjaan">
      </div>
    </div>

    <div class="form-group row">
      <div class="col-lg-6">
        <label>NPWP <span class="text-danger">*</span></label>
        <input class="form-control" type="text" placeholder="No. NPWP"
          v-model="dataDiri.no_npwp">
      </div>
      <div class="col-lg-6">
        <label>Nama Ibu Kandung <span class="text-danger">*</span></label>
        <input class="form-control" type="text" placeholder="Nama Ibu Kandung"
          v-model="dataDiri.nama_ibu">
      </div>
    </div>

    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>

    <div class="form-group row">
      <div class="col-lg-6">
        <label>No. Rekening</label>
        <input class="form-control" type="number" placeholder="No. Rekening"
          v-model="dataDiri.no_rek">
      </div>
      <div class="col-lg-6">
        <label>No. Telp <span class="text-danger">*</span></label>
        <input class="form-control" type="number" placeholder="No. Telp"
          v-model="dataDiri.no_tlp">
      </div>
    </div>

    <div class="form-group row">
      <div class="col-lg-6">
        <label>No. KTP <span class="text-danger">*</span></label>
        <input class="form-control" type="number" placeholder="No. KTP"
          v-model="dataDiri.no_ktp">
      </div>
      <div class="col-lg-6">
        <label>Email <span class="text-danger">*</span></label>
        <div class="input-group">
          <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
          <input type="text" class="form-control" placeholder="Alamat Email" aria-describedby="basic-addon1"
            v-model="dataDiri.email">
        </div>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-lg-6">
        <label>No. Kartu Keluarga <span class="text-danger">*</span></label>
        <input class="form-control" type="number" placeholder="No. Kartu Keluarga"
          v-model="dataDiri.no_kk">
      </div>

      <div class="col-lg-6">
        <label>Total Cuti <span class="text-danger">*</span></label>
        <input class="form-control" type="number" placeholder="Total Cuti"
          v-model="dataDiri.total_cuti">
      </div>
    </div>

    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>

    <div class="form-group row">
      <div class="col-lg-6">
        <label>Status Pegawai</label>
        <div class="kt-radio-inline">
          <label class="kt-radio" v-for="(item, index) in statusPegawai" :key="index">
            <input type="radio" name="status-pegawai"
              :value="item"
              v-model="dataDiri.status_pegawai"
            >{{ item }}
            <span></span>
          </label>
        </div>
      </div>
      <div class="col-lg-6">
        <label>Unit Kerja</label>
        <v-select
          multiple
          name="unit-kerja"
          placeholder="Pilih Unit Kerja"
          v-model="dataDiri.unit_kerja"
          :options="options.unitKerja">
        </v-select>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-lg-6">
        <label>Jenis Jabatan</label>
        <div class="kt-radio-inline">
          <label class="kt-radio" v-for="(item, index) in jenisJabatan" :key="index">
            <input type="radio" name="jenis-jabatan"
              :value="item"
              v-model="dataDiri.jenis_jabatan"
            >{{ item }}
            <span></span>
          </label>
        </div>
      </div>
      <div class="col-lg-6">
        <label>Jabatan</label>
        <v-select
          multiple
          name="jabatan"
          placeholder="Pilih Jabatan"
          v-model="dataDiri.jabatan"
          :options="options.jabatan">
        </v-select>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-lg-6">
        <label>Periode Kontrak</label>
        <div class="row">
          <div class="col-lg-6 col-xl-6">
            <datepicker
              input-class="form-control"
              name="kontrak-awal-data-diri"
              placeholder="Awal"
              v-model="dataDiri.kontrak_awal"
            ></datepicker>
          </div>
          <div class="col-lg-6 col-xl-6">
            <datepicker
              input-class="form-control"
              name="kontrak-akhir-data-diri"
              placeholder="Akhir"
              v-model="dataDiri.kontrak_akhir"
            ></datepicker>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <label>Gaji</label>
        <input type="number" class="form-control" placeholder="Enter"
          v-model="dataDiri.gaji">
      </div>
    </div>

    <div class="form-group row">
      <div class="col-lg-6">
        <label>TMT Masuk</label>
        <datepicker
          input-class="form-control"
          name="tmt-masuk-data-diri"
          placeholder="TMT Masuk"
          v-model="dataDiri.tmt_masuk"
        ></datepicker>
      </div>
      <div class="col-lg-6">
        <label>Tunjangan</label>
        <input type="number" class="form-control" placeholder="Enter"
          v-model="dataDiri.tunjangan">
      </div>
    </div>

    <div class="form-group row">
      <div class="col-lg-6">
        <label>Bidang</label>
        <div class="kt-radio-inline">
          <label class="kt-radio">
            <input type="radio"
              :value="`Kesehatan`"
              v-model="dataDiri.bidang"
            > Kesehatan
            <span></span>
          </label>
          <label class="kt-radio">
            <input type="radio"
              :value="`Non-Kesehatan`"
              v-model="dataDiri.bidang"
            > Non-Kesehatan
            <span></span>
          </label>
        </div>
      </div>

      <div class="col-lg-6">
        <label>Golongan</label>
        <select class="form-control" v-model="dataDiri.golongan">
          <option disabled value="" selected>Pilih Golongan</option>
          <option
            v-for="(item, index) in golonganList" :key="index"
            :value="item"
          >{{ item }}</option>
        </select>
      </div>
    </div>

    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>

    <div class="form-group row">
      <div v-if="currentPrivilege === 'Administrator'" class="col-lg-6">
        <label>Privilege</label>
        <select class="form-control" v-model="dataDiri.privilege">
          <option disabled value="" selected>Pilih Privilege</option>
          <option
            v-for="(item, index) in privilege" :key="index"
            :value="item"
          >{{ item }}</option>
        </select>
      </div>
      <div class="col-lg-6">
        <label>Upload Foto</label>
        <div class="custom-file">
          <input type="file" class="custom-file-input"
            name="foto"
            accept="image/*"
            ref="pictureUpload"
            @change="handlePictureUpload"
          >
          <label class="custom-file-label" for="customFile">Pilih Gambar</label>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import 'vue-select/dist/vue-select.css';

import bus from '~/plugins/bus';
import vSelect from 'vue-select'
import Datepicker from 'vuejs-datepicker';
import Mixin from '~/mixins/Mixin';

export default {
  name: 'DataDiriEmployee',

  mixins: [
    Mixin,
  ],

  data() {
    return {
      fotoUploaded: '',
    };
  },

  props: {
    dataDiri: {
      type: Object,
      required: true,
    },

    agama: {
      type: Array,
      required: true,
    },

    statusPegawai: {
      type: Array,
      required: true,
    },

    statusPerkawinan: {
      type: Array,
      required: true,
    },

    jabatan: {
      type: Array,
      required: true,
    },

    jenisJabatan: {
      type: Array,
      required: true,
    },

    unitKerja: {
      type: Array,
      required: true,
    },

    privilege: {
      type: Array,
      required: true,
    },

    currentPrivilege: {
      type: String,
      required: true,
    },

    education: {
      type: Array,
      required: true,
    },

    options: {
      type: Object,
      required: false,
    },

    golonganList: {
      type: Array,
      required: true,
    },
  },

  components: {
    vSelect,
    Datepicker,
  },

  methods: {
    handlePictureUpload() {
      const pictureUploaded = this.$refs.pictureUpload.files[0];

      const pictureData = {
        file: pictureUploaded,
        name: this.generatePictureName(pictureUploaded),
      };

      bus.$emit('set-picture-upload', pictureData);
    },

    generatePictureName(file) {
			const employeeId = this.$store.state.employeeId;
      const employeeNIP = this.dataDiri.nip;
      const ext = file.name.substr(file.name.lastIndexOf('.') + 1);

      return `${employeeId}-${employeeNIP}.${ext}`;
    },
  },
}
</script>
