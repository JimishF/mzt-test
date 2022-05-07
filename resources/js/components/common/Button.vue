<template>
  <button
      @click="$emit('click')"
      type="button"
      class="px-6 py-2.5 font-medium text-xs leading-tight uppercase rounded shadow-md hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out disabled:opacity-50">
    <slot></slot>
  </button>
</template>
<script>
  export default  {}
</script>
