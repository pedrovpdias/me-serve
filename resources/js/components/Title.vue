<script setup lang="ts">
  // Recebe o texto do título
  defineProps<{
    text: string;
  }>()
</script>

<template>
  <h1 class="text-4xl font-black font-highlight text-red-600">
    {{ text }}
  </h1>
</template>

<script lang="ts">
  export default {
    name: 'Title'
  }
</script>