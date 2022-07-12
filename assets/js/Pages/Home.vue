<template>
  <h1>Home Page</h1>

  <h2>{{ message }}</h2>

  <Link :href="`/contact`">Contact</Link>

  <Link :href="`/invalid`">404</Link>
</template>

<script>
  import { Link } from '@inertiajs/inertia-vue3'
  export default {
    components: {
      Link
    },
    props: {
      message: ''
    }
  }
</script>