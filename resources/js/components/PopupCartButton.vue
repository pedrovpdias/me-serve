<script setup lang="ts">
  import { computed } from 'vue'; // Importa as bibliotecas do Vue
  import { useCartStore } from '../stores/userCartStore'; // Importa o carrinho

  const cart = useCartStore(); // Instancia o carrinho
  const hasItems = computed(() => cart.items.length > 0); // Verifica se há itens no carrinho

</script>

<template>
  <button v-if="hasItems">
    <router-link to="/cart" class="fixed bottom-4 right-4 bg-red-600 text-white hidden md:grid place-content-center size-12 rounded-full shadow hover:bg-red-700 focus:bg-red-700 active:shadow-inner">
      <i class="bi bi-bag-fill pointer-events-none"></i>

      <span class="sr-only">
        Carrinho
      </span>
    </router-link>
  </button>
</template>

<script lang="ts">
  export default {
    name: 'PopupCartButton'
  }
</script>