<script setup lang="ts">
import AddItemButton from './AddItemButton.vue';
import RemoveItemButton from './RemoveItemButton.vue';

defineProps<{
  product: {
    id: number;
    quantity: number;
  };
}>();
</script>

<template>
  <span class="flex items-center no-wrap justify-end w-fit flex-none">
    <RemoveItemButton :product="product" />

    <span class="w-8 h-6 grid place-content-center flex-none">
      {{ product.quantity }}
    </span>

    <AddItemButton :product="product" />
  </span>
</template>

<script lang="ts">
  export default {
    name: 'CartItemCounter'
  }
</script>