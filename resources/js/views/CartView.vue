<template>
  <main class="grid gap-8 relative">
    <Navbar />

    <section class="grid">
      <h1 class="text-4xl font-black font-highlight text-red-600 px-4">
        Carrinho
      </h1>

      <div>
        <ShoppingCart />
      </div>
    </section>
  </main>
</template>

<script setup lang="ts">
  import Navbar from '../components/Navbar.vue';
</script>