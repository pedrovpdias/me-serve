<script setup lang="ts">
  // Recebe o texto do link
  defineProps<{
    text: string;
  }>()
</script>

<template>
  <button
    @click="$router.push('/')"
    class="flex items-center gap-1 font-bold outline-none text-red-600 hover:text-red-800 focus:text-red-800 group"
  >
    <i class="bi bi-arrow-left-short"></i>

    <span class="group-hover:underline group-focus:underline">
      {{ text }}
    </span>
  </button>
</template>

<script lang="ts">
  export default {
    name: 'BackHomeAnchor'
  }
</script>