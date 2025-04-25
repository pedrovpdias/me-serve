<script setup lang="ts">
  import logo from '../../images/logo.svg';

  import { useRoute } from 'vue-router';
  import { computed } from 'vue';

  const route = useRoute();

  // Verifica se a rota atual é a home
  const isHome = computed(() => route.name === 'home');

</script>

<template>
  <div class="grid gap-8">
    <nav class="flex justify-between items-end px-4">
      <img :src="logo" alt="Logo" class="w-1/5">

      <CartButton v-if="isHome" />
      
    </nav>

    <hr class="border-1 border-red-600 mx-4">
  </div>
</template>

<script lang="ts">
  import CartButton from './CartButton.vue';

  export default {
    name: 'Navbar'
  }
</script>