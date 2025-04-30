<script setup lang="ts">
  import { useCartStore } from '../stores/userCartStore'; // Importa o carrinho
  
  import { computed } from 'vue'; // Importa as bibliotecas do Vue

  const cart = useCartStore(); // Instancia o carrinho
  const hasItems = computed(() => cart.items.length > 0); // Verifica se há itens no carrinho

</script>

<template>
  <button
    id="cart-button"
    @click="$router.push('/cart')"
    :class="['grid place-content-center relative shadow text-red-600 rounded-full w-12 h-12 outline-none bg-white', hasItems ? 'hover:brightness-90 focus:brightness-90 active:shadow-inner' : 'opacity-90']"
    :disabled="!hasItems"
  >
    <span v-if="hasItems" class="absolute top-0 right-0 text-xs bg-red-600 text-white rounded-full w-4 h-4 flex justify-center items-center">
      {{ cart.items.length }}
    </span>

    <i v-if="hasItems" class="bi bi-bag-fill pointer-events-none"></i>
    <i v-else class="bi bi-bag opacity-50 pointer-events-none"></i>
  </button>
</template>

<script lang="ts">
export default {
  name: 'CartButton'
}
</script>