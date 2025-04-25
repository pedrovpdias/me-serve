<script setup lang="ts">
  import logo from '../../images/logo.svg';

  import { useCartStore } from '../stores/userCartStore';
  
  import { computed } from 'vue';

  const cart = useCartStore(); // Instancia o carrinho
  const hasItems = computed(() => cart.items.length > 0); // Verifica se há itens no carrinho

</script>

<template>
  <div class="grid gap-8">
    <nav class="flex justify-between items-end px-4">
      <img :src="logo" alt="Logo" class="w-1/5">

      <button
        id="cart-button"
        @click="$router.push('/cart')"
        :class="['grid place-content-center relative shadow text-red-600 rounded-full w-12 h-12 outline-none', hasItems ? 'hover:bg-secondary/50 focus:bg-secondary/50' : 'opacity-50']"
        :disabled="!hasItems"
      >
        <span v-if="hasItems" class="absolute top-0 right-0 text-xs bg-red-600 text-white rounded-full w-4 h-4 flex justify-center items-center">
          {{ cart.items.length }}
        </span>

        <i v-if="hasItems" class="bi bi-basket-fill"></i>
        <i v-else class="bi bi-basket opacity-50"></i>
      </button>
      
    </nav>

    <hr class="border-1 border-red-600 mx-4">
  </div>
</template>

<script lang="ts">
  export default {
    name: 'Navbar'
  }
</script>