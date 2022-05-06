<template>
  <div class="rounded-lg shadow-lg bg-white w-full overflow-hidden transition-all">
    <div class="aspect-1 relative z-0">
      <div class="bg-slate-200 animate-pulse absolute top-0 left-0 w-full h-full"></div>
      <img class="rounded-t-lg w-full object-center object-cover relative"
           :src="`/avatar.png`" alt=""/>
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

        } catch ({ response }) {
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
