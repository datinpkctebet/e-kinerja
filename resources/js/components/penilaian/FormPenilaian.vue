<template>

<div class="kt-portlet">
  <div class="kt-portlet__head">
    <div class="kt-portlet__head-label">
      <h3 class="kt-portlet__head-title">
        Base Controls
      </h3>
    </div>
  </div>

  <form class="kt-form">
    <div class="kt-portlet__body">
      <div class="form-group">
        <label><h2><b>NAMA PEGAWAI</b></h2></label>
        <select class="form-control" v-model="name">
          <option disabled value="" selected>Pilih Nama Pegawai</option>
          <option
            v-for="(item, index) in employee" :key="index"
            :value="item.id"
          >{{ item.name }}</option>
        </select>
      </div>

      <div class="form-group" v-for="(item, key) in question" :key="key">
        <label>{{ key+1 }}. {{ item.name }} <b>({{ item.category }})</b></label>
        <div class="kt-radio-inline">
          <label class="kt-radio" v-for="n in 10" :key="n">
            <input type="radio"
              :name="`question${key}`"
              :value="n"
              v-model="answerScore[key]"
            > {{ n }}
            <span></span>
          </label>
        </div>

        <div class="error invalid-feedback" v-if="typeof answerScore[key] == 'undefined'">Harus diisi.</div>
      </div>
    </div>

    <div class="kt-portlet__foot">
      <div class="kt-form__actions">
        <button
          type="submit"
          class="btn btn-primary"
          :class="{ 'kt-spinner kt-spinner--right kt-spinner--md kt-spinner--light': isLoading }"
          :disabled="isDisabled"
          @click.prevent="submit"
        >Submit</button>

        <button type="reset" class="btn btn-secondary">Cancel</button>
      </div>
    </div>
  </form>
</div>

</template>

<script>
import { groupBy, mean, filter } from 'lodash';
import swal from 'sweetalert2';

export default {
  data() {
    return {
      isLoading: false,
      isDisabled: false,

      answerScore: [],
      name: null,
    };
  },

  props: {
    question: {
      type: Array,
      required: false,
    },

    employee: {
      type: Array,
      required: false,
    },
  },

  computed: {
    totalQuestion() {
      return this.question.length;
    },
  },

  methods: {
    average() {
      return mean(this.answerScore);
    },

    validate() {
      if (this.name === null) {
        Swal.fire('Required', 'Silahkan isi nama pegawai terlebih dahulu!', 'warning');
        return false;
      }

      if (this.totalQuestion !== this.answerScore.length) {
        Swal.fire('Required', 'Silahkan isi semua jawaban terlebih dahulu!', 'warning');
        return false;
      };

      const arrUndefined = filter(this.answerScore, value => { return typeof value === 'undefined' });
      if (arrUndefined.length > 0) {
        Swal.fire('Required', 'Silahkan isi semua jawaban terlebih dahulu!', 'warning');
        return false;
      }

      return true;
    },

    update(data) {
      return new Promise((resolve) => {
        this.axios.post('/penilaian/add', data)
        .then(() => {
          resolve();
        })
        .catch((error) => {
          this.isLoading = true;
          this.isDisabled = true;
          console.log('update error', error);
        });
      });
    },

    async submit() {
      const isValid = await this.validate();
      if (!isValid) return;

      this.isLoading = true;
      this.isDisabled = true;
      const totalScore = await this.average();

      const data = {
        employee_id: this.name,
        score: totalScore,
      };

      console.log('data ', data);

      await this.update(data);
      await this.back();
    },

    back() {
      window.location.href = '/penilaian';
    },
  },
}
</script>

<style lang="scss" scoped>
  .invalid-feedback {
    display: block;
    position: absolute;
  }
</style>
