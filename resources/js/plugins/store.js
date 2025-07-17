import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
  state: {
    employeeId: null,
  },

  mutations: {
    SET_EMPLOYEE_ID: (state, payload) => {
      state.employeeId = payload;
    },
  },

  actions: {
    setEmployeeId({ commit }, payload) {
      commit('SET_EMPLOYEE_ID', payload);
    },
  },
});

export default store;
