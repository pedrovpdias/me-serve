<template>
  <main class="grid gap-8">
    <img :src="logo" alt="Logo" class="mx-auto w-1/2">

    <hr class="border-1 border-red-600">

    <section class="grid">
      <h1 class="text-4xl font-black font-highlight text-red-600 px-4 flex gap-4 items-center">
        <img :src="icon" alt="Logo" class="h-6 w-auto">
        Cardápio
      </h1>

      <div>
        <MenuView />
      </div>
    </section>
  </main>
</template>

<script setup lang="ts">
import MenuView from './MenuView.vue';

import logo from '../../images/logo_hr.svg';
import icon from '../../images/icon.svg';

</script>