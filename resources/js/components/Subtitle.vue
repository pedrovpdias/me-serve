<script setup lang="ts">
  defineProps<{
    text: string;
  }>()
</script>

<template>
  <h2 class="text-2xl font-black font-highlight text-primary flex gap-2 items-center">
    <slot name="icon" />

    {{ text }}
  </h2>
</template>

<script lang="ts">
  export default {
    name: 'Subtitle'
  }
</script>