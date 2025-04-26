<script setup lang="ts">
  import Navbar from '../components/Navbar.vue';
  import Title from '../components/Title.vue';
  import Menu from '../components/Menu.vue';
  import HomeFooter from '../components/HomeFooter.vue';

</script>

<template>
  <main class="grid gap-8 relative">
    <Navbar />

    <section class="grid">
      <Title :text="'Cardápio'" />

      <div class="pt-8">
        <Menu />
      </div>
    </section>

    <HomeFooter />
  </main>
</template>