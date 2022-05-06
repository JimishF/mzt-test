<template>
  <div class="fixed top-16 right-0 m-6 z-50">
    <Transition name="slide-fade">
      <div v-if="message"
           :class="{
          'bg-red-200 text-red-900': message.type === 'error',
          'bg-green-200 text-green-900': message.type === 'success'
        }"
           class="flex items-center w-full max-w-xs p-4 mb-4 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800 min-w-[240]"
           role="alert">

        <div class="ml-3 text-sm font-normal">{{ message.text }}</div>
        <button type="button"
                class="ml-auto -mx-1.5 -my-1.5 text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                @click="message=null" aria-label="Close">
          <span class="sr-only">Close</span>
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                  clip-rule="evenodd"></path>
          </svg>
        </button>
      </div>
      Item moved successfully.

    </Transition>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        message: null
      };
    },
    mounted() {
      let timer;
      this.$root.$on('flash-message', message => {
        this.message = null;

        clearTimeout(timer);
        this.message = message;
        timer = setTimeout(() => {
          this.message = null;
        }, 5000);
      });
    }
  };
</script>

<style scoped>
  .slide-fade-enter-active,
  .slide-fade-leave-active {
    transition: all 0.4s;
  }

  .slide-fade-enter,
  .slide-fade-leave-to {
    transform: translateX(400px);
    opacity: 0;
  }
</style>