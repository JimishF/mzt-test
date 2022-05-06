<template>
  <div>
    <header>
      <h1 class="text-4xl font-bold">Candidates</h1>
    </header>

    <div class="pt-10 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-8">
        <candidate-card v-for="candidate in candidates" :key="candidate.id" :candidate="candidate"></candidate-card>
    </div>
  </div>
</template>

<script>
  import CandidateCard from '../general/CandidateCard';
import { mapGetters } from 'vuex'

  export default {
    components: {CandidateCard},
    computed:{
      ...mapGetters(['candidates'])
    },
    async mounted() {
      this.$store.dispatch('fetchCandidates')
    }
  }
</script>
