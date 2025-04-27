<script setup lang="ts">
  import Navbar from '../components/Navbar.vue'; // Importa o navbar
  import Title from '../components/Title.vue'; // Importa o título
  import ShoppingCart from '../components/ShoppingCart.vue'; // Importa o carrinho com os itens adicionados ao pedido
  import OrderSummary from '../components/OrderSummary.vue'; // Importa o resumo do pedido

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