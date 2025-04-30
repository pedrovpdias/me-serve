<script setup lang="ts">
  import { useCartStore } from '../stores/userCartStore'; // Importa o carrinho

  const cart = useCartStore(); // Instancia o carrinho

  // Recebe o produto
  defineProps<{
    product: any;
  }>();
</script>

<template>
  <button
    @click="cart.addItem(product)"
    type="button"
    class="size-6 grid place-content-center shadow rounded text-red-600 outline-none hover:bg-gray-50 focus:bg-gray-50 transition-all active:shadow-inner flex-none"
  >
    <i class="bi bi-plus pointer-events-none"></i>
  </button>
</template>

<script lang="ts">
  export default {
    name: 'AddItemButton'
  }
</script>