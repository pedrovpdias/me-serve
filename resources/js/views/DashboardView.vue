<script setup lang="ts">
  import { useAuthStore } from '../stores/authStore'; // Importa o usuario

  import { computed } from 'vue'; // Importa as bibliotecas do Vue

  import logo from '../../images/logo_hr.svg'; // Importa a logo

  const auth = useAuthStore(); // Instancia o usuario
  const user = computed(() => auth.getUser);  // Pega os dados do usuario

</script>
<template>
  <main class="grid gap-4 relative px-4 md:px-8 md:w-auto md:flex-1 md:max-w-4xl mx-auto lg:px-4 border">
    <header class="w-full flex justify-between items-center">
      <img :src="logo" alt="Logo" class="w-1/3 md:w-1/5">

      <div class="flex gap-4">
        {{ user.name }}
      </div>
    </header>
  </main>
</template>