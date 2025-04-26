<script setup lang="ts">
  import { useCartStore } from '../stores/userCartStore';
  
  import { computed } from 'vue';

  const cart = useCartStore(); // Instancia o carrinho
  const hasItems = computed(() => cart.items.length > 0); // Verifica se há itens no carrinho

</script>

<template>
  <button
    id="cart-button"
    @click="$router.push('/cart')"
    :class="['grid place-content-center relative shadow text-red-600 rounded-full w-12 h-12 outline-none', hasItems ? 'hover:bg-secondary/50 focus:bg-secondary/50 hover:shadow-inner focus:shadow-inner' : 'opacity-50']"
    :disabled="!hasItems"
  >
    <span v-if="hasItems" class="absolute top-0 right-0 text-xs bg-red-600 text-white rounded-full w-4 h-4 flex justify-center items-center">
      {{ cart.items.length }}
    </span>

    <i v-if="hasItems" class="bi bi-basket-fill"></i>
    <i v-else class="bi bi-basket opacity-50"></i>
  </button>
</template>

<script lang="ts">
export default {
  name: 'CartButton'
}
</script>