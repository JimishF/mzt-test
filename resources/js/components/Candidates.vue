<template>
  <div>
    <header>
      <h1 class="text-4xl font-bold">Candidates</h1>
    </header>
    <div class="p-10 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-5">
      <div  v-for="candidate in candidates">
        <candidate-card :candidate="candidate"></candidate-card>
      </div>
    </div>
  </div>
</template>

<script>
  import Button from "./common/Button";
  import CandidateCard from './CandidateCard';

  export default {
    components: {Button, CandidateCard},
    data() {
      return ({
        candidates: [],
      })
    },
    methods:{
        async fetchCandidates(){
          const response = await axios.get('/api/candidate/list');
          this.candidates = response.data;
        }
    },
    async mounted() {
      await this.fetchCandidates()
    }
  }
</script>
