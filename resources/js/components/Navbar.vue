<script setup lang="ts">
  import logo from '../../images/logo.svg'; // Importa a logo

  import { useRoute } from 'vue-router'; // Importa as rotas do Vue
  import { computed } from 'vue'; // Importa as bibliotecas do Vue

  const route = useRoute(); // Instancia as rotas

  // Verifica se a rota atual é a home
  const isHome = computed(() => route.name === 'home');

</script>

<template>
  <header class="grid gap-8" id="header">
    <nav class="flex justify-between items-end">
      <img :src="logo" alt="Logo" class="w-1/5">

      <CartButton v-if="isHome" />
      
    </nav>

    <hr class="border-1 border-red-600">
  </header>
</template>

<script lang="ts">
  import CartButton from './CartButton.vue';

  export default {
    name: 'Navbar'
  }
</script>