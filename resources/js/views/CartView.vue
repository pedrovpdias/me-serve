<script setup lang="ts">
  import CartHeader from '../components/CartHeader.vue'; // Importa o CartHeader
  import Title from '../components/Title.vue'; // Importa o título
  import ShoppingCart from '../components/ShoppingCart.vue'; // Importa o carrinho com os itens adicionados ao pedido
  import OrderSummary from '../components/OrderSummary.vue'; // Importa o resumo do pedido

</script>

<template>
  <div class="grid gap-8 relative">
    <CartHeader />

    <main class="grid gap-8 z-20 bg-white p-8 -mt-20 rounded-tl-3xl rounded-tr-3xl -mx-px sticky top-80 border-t border-t-black/5">
      <Title :text="'Pedido'" />

      <ShoppingCart />

      <OrderSummary />
    </main>
  </div>
</template>