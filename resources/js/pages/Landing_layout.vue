<template>
  <div>
    <Header />
    <!-- Assuming you have a Header component -->
    <router-view />
    <!-- This is where the nested routes will be rendered -->
    <Footer />
    <!-- Your existing Footer component -->
  </div>
</template>

<script lang="ts">
  import Header from '../../components/landingPage_comp/Header.vue'; // Adjust the path as necessary
  import Footer from '../../components/landingPage_comp/Footer.vue'; // Adjust the path as necessary

  export default {
    components: {
      Header,
      Footer,
    },
  };
</script>

<style scoped>
  /* Add any styles for your layout here */
</style>
