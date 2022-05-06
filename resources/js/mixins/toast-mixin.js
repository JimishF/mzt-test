export default  {
  methods: {
    showSuccessToast(text){
      this.$root.$emit('flash-message',{ type: 'success', text} )
    },
    showErrorToast(text){
      this.$root.$emit('flash-message',{ type: 'error', text} )
    }
  }
}