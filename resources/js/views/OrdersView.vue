<script setup lang="ts">
  import AdminHeader from '../components/AdminHeader.vue'; // Importa o AdminHeader
  import Title from '../components/Title.vue'; // Importa o título
</script>

<template>
  <main class="flex flex-col gap-8 relative md:w-auto md:flex-1 md:max-w-4xl mx-auto bg-white shadow-xl py-4 min-h-screen">
    <AdminHeader />

    <div class="flex flex-col gap-8 px-8">
      <Title :text="'Pedidos'" />
    </div>
  </main>
</template>