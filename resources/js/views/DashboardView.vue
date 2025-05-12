<script setup lang="ts">
  import AdminHeader from '../components/AdminHeader.vue'; // Importa o AdminHeader
  import Title from '../components/Title.vue'; // Importa o título
  import { useAuthStore } from '../stores/authStore'; // Importa o usuario

  import { computed, ref } from 'vue'; // Importa as bibliotecas do Vue

  const auth = useAuthStore(); // Instancia o usuario
  const user = computed(() => auth.getUser);  // Pega os dados do usuario

</script>
<template>
  <main class="flex flex-col gap-8 relative md:w-auto md:flex-1 md:max-w-4xl mx-auto bg-white shadow-xl py-4 min-h-screen">
    <AdminHeader />

    <section class="flex flex-col gap-4 px-8">
      <Title :text="'Dashboard'" />
      
    </section>
  </main>
</template>