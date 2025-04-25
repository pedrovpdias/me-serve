<template>
  <div class="grid gap-8 relative">
    <Navbar />

    <main class="grid gap-4 px-4">
      <h1 class="text-4xl font-black font-highlight text-red-600">
        Carrinho
      </h1>

      <ShoppingCart />
    </main>
  </div>
</template>

<script setup lang="ts">
  import Navbar from '../components/Navbar.vue';
  import ShoppingCart from '../components/ShoppingCart.vue';
</script>