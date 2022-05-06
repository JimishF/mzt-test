import Vuex from "vuex";

const storeConfig = ({
  state: {
    candidates: [],
    coins: 0
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
  },
  actions: {
    async fetchCandidates({commit}) {
      const response = await axios.get('/api/candidate/list');
      commit('setCandidates', response.data);
    },
    async contactCandidate({commit}, {candidate_id}) {
      const response = await axios.post(`/api/candidate/contact/${candidate_id}`)
      commit('setCandidateStatus', {candidate_id, status: 'contacted'});
      return response;
    },
    async hireCandidate({commit}, {candidate_id}) {
      const response = await axios.post(`/api/candidate/hire/${candidate_id}`)
      commit('setCandidateStatus', {candidate_id, status: 'hried'});
      return response;
    }
  }
})

export default storeConfig;