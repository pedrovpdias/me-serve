<template>
  <main class="grid gap-10">
    <img :src="logo" alt="Logo" class="mx-auto w-1/2">

    <section class="border-t-2 border-red-600">
      <h1 class="text-4xl font-black font-highlight text-red-600 p-4">
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

</script>