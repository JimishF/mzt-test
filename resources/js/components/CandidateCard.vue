<template>
  <div class="rounded-lg shadow-lg bg-white max-w-sm overflow-hidden transition-all">
    <div class="aspect-1 relative z-0">
      <div class="bg-slate-200 animate-pulse absolute top-0 left-0 w-full h-full"></div>
      <img class="rounded-t-lg w-full object-center object-cover relative"
           :src="`/avatar.png`" alt=""/>
    </div>

    <div class="p-6">
      <h5 class="text-gray-900 text-xl font-medium mb-2">{{ candidate.name }}</h5>
      <p class="text-gray-700 text-base mb-4">
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
          v-if="canContact(candidate)"
          @click="contact(candidate.id)">
        {{ isContacting ? "Contacting.." : "Contact" }}
      </Button>
      <Button
          class="w-full bg-teal-700 hover:bg-teal-800 active:bg-teal-900 focus:bg-teal-900"
          :disabled="isHiring"
          v-if="canHire(candidate)"
          @click="hire(candidate.id)">
        {{ isHiring ? "Hiring.." : "Hire" }}
      </Button>
    </div>

  </div>

</template>

<script>
  import Button from "./common/Button";

  export default {
    components: {Button},
    props: ['candidate'],
    data() {
      return ({
        isHiring: false,
        isContacting: false,
      })
    },
    methods: {
      canContact(candidate) {
        return !candidate.status
      },
      canHire(candidate) {
        return candidate.status === 'contacted'
      },
      async contact(candidate_id) {
        this.isContacting = true;

        try {
          await axios.post(`/api/candidate/contact/${candidate_id}`)
        } catch (e) {}
        this.isContacting = false;
      },
      async hire(candidate_id) {
        this.isHiring = true;
        try {
          await axios.post(`/api/candidate/hire/${candidate_id}`)
        } catch (e) {}
        this.isHiring = false;
      }
    }
  }
</script>
