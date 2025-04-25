<template>
  <main class="grid gap-8 relative">
    <Navbar />

    <section class="grid">
      <h1 class="text-4xl font-black font-highlight text-red-600 px-4">
        Cardápio
      </h1>

      <div>
        <MenuView />
      </div>
    </section>

    <HomeFooter />
  </main>
</template>

<script setup lang="ts">
  import Navbar from '../components/Navbar.vue';
  import MenuView from './MenuView.vue';
  import HomeFooter from '../components/HomeFooter.vue';

</script>