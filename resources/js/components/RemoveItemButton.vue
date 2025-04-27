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
    @click="cart.removeItem(product.id)"
    type="button"
    class="size-6 grid place-content-center shadow rounded text-red-600 outline-none hover:bg-red-400/5 focus:bg-red-400/5 active:shadow-inner flex-none"
  >
    <i class="bi bi-dash"></i>
  </button>
</template>

<script lang="ts">
  export default {
    name: 'RemoveItemButton'
  }
</script>