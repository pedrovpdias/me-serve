<script setup lang="ts">
  import logo from '../../images/logo.svg'; // Importa a logo
  
  import BackButton from './BackButton.vue'; // Importa o botão de voltar

  import { useRoute } from 'vue-router'; // Importa as rotas do Vue
  import { computed } from 'vue'; // Importa as bibliotecas do Vue

  const route = useRoute(); // Instancia as rotas

  // Verifica se a rota atual é a home
  const isHome = computed(() => route.name === 'home');

  // Recebe a rota anterior como parâmetro para o botão de voltar
  const { previousRoute } = defineProps<{ 
    previousRoute: string 
  }>();

</script>

<template>
  <header class="grid gap-8 py-8 z-0 relative" id="header">
    <div v-if="!isHome" class="flex items-center h-fit w-full justify-start p-8 z-10 absolute top-0 left-0">
      <BackButton :path="previousRoute" />
    </div>

    <div class="flex justify-center items-center">
      <img :src="logo" alt="Logo" class="w-1/5">      
    </div>

    <hr class="border-px border-red-600">
  </header>
</template>

<script lang="ts">
  export default {
    name: 'DefaultHeader'
  }
</script>