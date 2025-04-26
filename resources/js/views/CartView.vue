<script setup lang="ts">
  import Navbar from '../components/Navbar.vue';
  import Title from '../components/Title.vue';
  import ShoppingCart from '../components/ShoppingCart.vue';
  import OrderSummary from '../components/OrderSummary.vue';

</script>

<template>
  <div class="grid gap-8 relative">
    <Navbar />

    <main class="grid gap-4">
      <Title :text="'Pedido'" />

      <ShoppingCart />

      <OrderSummary />
    </main>
  </div>
</template>