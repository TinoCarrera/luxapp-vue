<template>
  <primary-button :disabled="loading">
    <div v-if="loading" class="btn-spinner mr-2" />
    <slot />
  </primary-button>
</template>

<script>
  import PrimaryButton from './../../Jetstream/Button'

  export default {
    components: {
      PrimaryButton,
    },
    props: {
      loading: Boolean,
    },
  }
</script>
