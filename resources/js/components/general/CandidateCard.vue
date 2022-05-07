<template>
  <div class="rounded-lg shadow-lg bg-white w-full overflow-hidden transition-all">
    <div class="aspect-1 relative z-0">
      <div class="bg-slate-200 animate-pulse absolute top-0 left-0 w-full h-full"></div>
      <img class="rounded-t-lg w-full object-center object-cover relative"
           :src="`/avatar.png`" alt=""/>

      <span v-if="candidateStatus === 'hired'"
            class="bg-teal-100 px-3 absolute top-4 right-2 text-teal-800 text-sm font-semibold inline-flex items-center p-1.5 rounded-full dark:bg-teal-200 dark:text-teal-800">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path
            fill-rule="evenodd"
            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
            clip-rule="evenodd"></path></svg>
          <span class="uppercase">Hired</span>
      </span>

      <span v-if="candidateStatus === 'contacted'"
            class="bg-blue-100 px-3 absolute top-4 right-2 text-blue-800 text-sm font-semibold inline-flex items-center p-1.5 rounded-full dark:bg-blue-200 dark:text-teal-800">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5 mr-2" viewBox="0 0 443.984 325.584"><path d="M399.882 325.584H44.102C19.832 325.584 0 305.752 0 281.482V44.102C0 19.832 19.832 0 44.102 0h355.78c24.27 0 44.102 19.832 44.102 44.102v237.38c0 24.27-19.832 44.102-44.102 44.102zM44.102 29.604c-7.992 0-14.504 6.512-14.504 14.504v237.38c0 7.992 6.512 14.504 14.504 14.504h355.78c7.992 0 14.504-6.512 14.504-14.504V44.108c0-7.992-6.512-14.504-14.504-14.504z"/><path d="M221.992 184.554c-9.621 0-19.238-3.109-27.379-9.324L20.573 41.3c-6.512-5.031-7.695-14.207-2.664-20.719s14.207-7.695 20.719-2.664l174.04 133.79c5.477 4.144 13.172 4.144 18.648 0l174.04-133.79c6.512-5.031 15.836-3.699 20.719 2.664 5.031 6.512 3.699 15.836-2.664 20.719l-174.04 133.93c-7.992 6.215-17.758 9.324-27.379 9.324z"/></svg>
          <span class="uppercase">Contacted</span>
      </span>


    </div>

    <div class="p-6">
      <h5 class="text-gray-900 text-xl font-medium mb-2">{{ candidate.name }}</h5>
      <p class="text-gray-700 text-base mb-4 height-200 line-clamp-3">
        {{ candidate.description }}
      </p>
      <div class="py-4 pb-2">
              <span v-for="strength in candidate.strengths"
                    class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{
                  strength
                }}</span>
      </div>
      <Button
          class="w-full"
          :disabled="isContacting"
          v-if="canContact"
          @click="contact()">
        {{ isContacting ? "Contacting.." : "Contact" }}
      </Button>
      <Button
          class="w-full bg-teal-700 hover:bg-teal-800 active:bg-teal-900 focus:bg-teal-900"
          :disabled="isHiring"
          v-if="canHire"
          @click="hire()">
        {{ isHiring ? "Hiring.." : "Hire" }}
      </Button>
    </div>

  </div>

</template>

<script>
  import Button from "../common/Button";
  import ToastMixin from "../../mixins/toast-mixin";

  export default {
    components: {Button},
    mixins: [ToastMixin],
    props: ['candidate'],
    data() {
      return ({
        isHiring: false,
        isContacting: false,
        candidateStatus: null,
      })
    },
    watch: {
      'candidate.status': function (status) {
        this.candidateStatus = status;
      },
    },
    mounted() {
      this.candidateStatus = this.candidate.status;
    },
    computed: {
      canContact() {
        return !this.candidateStatus;
      },
      canHire() {
        return this.candidateStatus === 'contacted';
      },
    },
    methods: {

      async contact() {
        this.isContacting = true;
        try {
          const response = await this.$store.dispatch('contactCandidate', {candidate_id: this.candidate.id})
          this.showSuccessToast(response.data.message)

        } catch ({response}) {
          this.showErrorToast(response.data.message)
        }
        this.isContacting = false;
      },
      async hire() {
        this.isHiring = true;
        try {
          const response = await this.$store.dispatch('hireCandidate', {candidate_id: this.candidate.id})
          this.showSuccessToast(response.data.message)
        } catch ({response}) {
          this.showErrorToast(response.data.message)
        }
        this.isHiring = false;
      }
    }
  }
</script>
