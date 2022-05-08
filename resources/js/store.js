import Vuex from "vuex";

const storeConfig = ({
  state: {
    candidates: [],
    coins: null,
  },
  getters: {
    candidates(state) {
      return state.candidates;
    },
    coins(state) {
      return state.coins;
    },
  },
  mutations: {
    setCandidates(state, candidates) {
      state.candidates = candidates;
    },
    setCandidateStatus(state, {candidate_id, status}) {
      const item = state.candidates.find(({id}) => id === candidate_id);
      Object.assign(item, {status: status});
    },
    setCoins(state, coins) {
      state.coins = coins;
    }
  },
  actions: {
    async fetchCandidates({commit}) {
      const response = await axios.get('/api/candidate/list');
      const candidatesWithStatus = response.data.map(candidate => {
        const pivot = candidate.companies_pivot[0]
        const status = pivot ? pivot.status : null

        return ({...candidate, status});
      })
      commit('setCandidates', candidatesWithStatus);
    },
    async contactCandidate({commit, dispatch}, {candidate_id}) {
      const response = await axios.post(`/api/candidate/contact/${candidate_id}`)
      commit('setCandidateStatus', {candidate_id, status: 'contacted'});
      dispatch('refreshBalance');
      return response;
    },
    async hireCandidate({commit, dispatch}, {candidate_id}) {
      const response = await axios.post(`/api/candidate/hire/${candidate_id}`)
      commit('setCandidateStatus', {candidate_id, status: 'hired'});
      dispatch('refreshBalance');
      return response;
    },
    async refreshBalance({commit}) {
      commit('setCoins', null);
      let coins = 0;
      try {
        const response = await axios.get(`api/wallet`);
        coins = response.data.coins;
      } catch (e) {}
      commit('setCoins', coins);
    }
  }
})

export default storeConfig;