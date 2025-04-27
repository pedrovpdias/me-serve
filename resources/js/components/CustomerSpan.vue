<script setup lang="ts">
  defineProps<{ 
    customer: { 
      name: string 
    } 
  }>();
</script>

<template>
  <span class="flex items-end text-red-600 font-semibold">
    Olá, {{ customer.name }}
  </span>
</template>

<script lang="ts">
  export default {
    name: 'CustomerSpan'
  }
</script>