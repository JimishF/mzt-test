<template>
  <div>
    <header class="flex justify-between items-center">
      <h1 class="text-4xl font-bold">Candidates</h1>
      <div>
        <ul class="flex">
          <li class="mx-2">
            <input class="sr-only peer" type="radio" v-model="statusType" name="statusType" value="all" id="all">
            <label
                class="px-2 py-1.5 bg-white border border-gray-300 rounded-full cursor-pointer focus:outline-none hover:bg-gray-50 peer-checked:bg-yellow-600 peer-checked:text-white peer-checked:border-transparent"
                for="all">All Candidiates</label>

          <li class="mx-2">
            <input class="sr-only peer" type="radio" v-model="statusType" name="statusType" value="contacted"
                   id="contacted">
            <label
                class="px-2 py-1.5 bg-white border border-gray-300 rounded-full cursor-pointer focus:outline-none hover:bg-gray-50 peer-checked:bg-blue-600 peer-checked:text-white peer-checked:border-transparent"
                for="contacted">Contacted</label>
          </li>

          <li class="mx-2">
            <input class="sr-only peer" type="radio" v-model="statusType" name="statusType" value="hired" id="hired">
            <label
                class="px-2 py-1.5 bg-white border border-gray-300 rounded-full cursor-pointer focus:outline-none hover:bg-gray-50 peer-checked:bg-teal-600 peer-checked:text-white peer-checked:border-transparent"
                for="hired">Hired</label>
          </li>
        </ul>
      </div>
    </header>
    <div v-if="filteredCandidates && filteredCandidates.length" class="pt-10 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-8">

      <candidate-card  v-for="candidate in filteredCandidates" :key="candidate.id"
                      :candidate="candidate"></candidate-card>
    </div>
    <div v-else class="p-[100] text-center text-gray-500 italic">
        No Candidates found.
      </div>
  </div>
</template>

<script>
  import CandidateCard from '../general/CandidateCard';
  import {mapGetters} from 'vuex'

  export default {
    components: {CandidateCard},
    data() {
      return {
        statusType: 'all'
      }
    },
    computed: {
      ...mapGetters(['candidates']),

      filteredCandidates() {
        if (this.statusType === 'hired' || this.statusType === 'contacted') {
          return this.candidates.filter(({status}) => status === this.statusType)
        }
        return this.candidates;
      }
    },
    async mounted() {
      this.$store.dispatch('fetchCandidates')
    }
  }
</script>
