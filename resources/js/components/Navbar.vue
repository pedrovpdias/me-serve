<script setup lang="ts">
  import logo from '../../images/logo.svg'; // Importa a logo
  
  import CustomerSpan from './CustomerSpan.vue';
  import CartButton from './CartButton.vue'; // Importa o botão do carrinho

  import { useRoute } from 'vue-router'; // Importa as rotas do Vue
  import { computed } from 'vue'; // Importa as bibliotecas do Vue

  import { useCustomerStore } from '../stores/customerStore';

  const customers = useCustomerStore(); // Instancia o usuario
  const customer = computed(() => customers.customer[0]);

  const route = useRoute(); // Instancia as rotas

  // Verifica se a rota atual é a home
  const isHome = computed(() => route.name === 'menu');

</script>

<template>
  <header class="grid gap-8" id="header">
    <nav class="flex justify-between items-end">
      <img :src="logo" alt="Logo" class="w-1/5">

      <div class="flex items-end gap-8">
        <CustomerSpan v-if="customer" :customer="customer" />

        <CartButton v-if="isHome" />
      </div>      
    </nav>

    <hr class="border-1 border-red-600">
  </header>
</template>

<script lang="ts">
  export default {
    name: 'Navbar'
  }
</script>