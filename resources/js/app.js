import '~/plugins/bootstrap';
import store from '~/plugins/store';
import bus from '~/plugins/bus';

Vue.config.devtools = true;
Vue.config.performance = true;

import UpdateEmployee from './components/employee/UpdateEmployee';
import FormActivity from './components/activity/FormActivity';
import FormPenilaian from './components/penilaian/FormPenilaian';
import FormSuratPengajuan from './components/surat-pengajuan/FormSuratPengajuan';

window.app = new Vue({
  el: '#app',

  store,
  bus,

  components: {
    UpdateEmployee,
    FormActivity,
    FormPenilaian,
    FormSuratPengajuan,
  },
});
