<script setup lang="ts">
  import CartButton from './CartButton.vue'; // Importa o botão de carrinho
  import BackButton from './BackButton.vue'; // Importa o botão de voltar

  import { ref, onMounted, onUnmounted } from 'vue'; // Importa as bibliotecas do Vue

  import background from '../../images/restaurant_facade.png'; // Importa o background do header

  const isCollapsed = ref(false); // Define a visibilidade do header
  const scrollThreshold = 100; // Define o threshold de scroll

  // Função para lidar com o scroll
  const handleScroll = () => {
    isCollapsed.value = window.scrollY > scrollThreshold; // Se o scroll for maior que o threshold, define a visibilidade como true
  };

  // Quando o componente for montado
  onMounted(() => {
    window.addEventListener('scroll', handleScroll); // Adiciona o listener de scroll
  });

  // Quando o componente for desmontado
  onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll); // Remove o listener de scroll
  });


</script>

<template>
  <header class="h-64 md:h-96 sticky top-0 realtive overflow-hidden w-full">
    <img :src="background" alt="meServe" class="w-full h-auto object-cover absolute top-0 left-0 -z-10">

    <div
      class="absolute top-0 left-0 w-full flex justify-center items-center py-2 bg-black/40 z-0 transition-opacity transition-transform duration-300 ease-in-out h-200"
      :class="{ 'opacity-100 translate-y-0': isCollapsed, 'opacity-0 translate-y-[-100%]': !isCollapsed }"
    ></div>

    <div class="flex items-center h-fit w-full justify-between p-4 md:p-8 z-10">
      <BackButton :path="'/'" />

      <CartButton />
    </div>
  </header>
</template>

<script lang="ts">
  export default {
    name: 'MenuHeader'
  }
</script>