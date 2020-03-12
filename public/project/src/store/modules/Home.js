const state = {
  mobile: ""
};

const getters = {
  getMobile: state => state.mobile
};

const mutations = {
  setMobile: (state, data) => {
    state.mobile = data;
  }
};

const actions = {};

export default {
  state,
  getters,
  mutations,
  actions
};
