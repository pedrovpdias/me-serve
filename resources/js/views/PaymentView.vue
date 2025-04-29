<script setup lang="ts">
  import { defineProps } from 'vue'; // Importa defineProps do Vue

  const props = defineProps({
    paymentMethod: {
      type: String,
      required: true
    }
  })
</script>

<template>
  <h1>Payment</h1>
</template>