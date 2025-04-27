<script setup lang="ts">
  // Recebe o texto e o evento a ser executado ao clicar no link
  defineProps<{
    text: string;
    event: string | (() => void);
  }>()
</script>

<template>
  <button
    @click="typeof event === 'function' ? event() : $router.push(event)"
    class="text-red-600 underline hover:text-red-800 focus:text-red-800 outline-none cursor-pointer"
  >
    {{ text }}
  </button>
</template>

<script lang="ts">
  export default {
    name: 'Anchor'
  }
</script>