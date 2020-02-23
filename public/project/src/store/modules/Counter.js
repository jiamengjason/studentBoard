const state = {
  count: 0
};

const getters = {
  getCount: state => state.count
};

const mutations = {
  INCREMENT: state => {
    state.count++;
  },
  DECREMENT: state => {
    state.count--;
  }
};

const actions = {
  increment({ commit }) {
    commit("INCREMENT");
  },
  decrement({ commit }) {
    commit("DECREMENT");
  }
};

export default {
  state,
  getters,
  mutations,
  actions
};
