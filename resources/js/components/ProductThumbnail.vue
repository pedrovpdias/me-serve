<script setup lang="ts">
  // Recebe o produto
  defineProps<{
    product: any;
  }>();
</script>

<template>
  <div class="grid place-content-center rounded-lg overflow-hidden size-18 aspect-square flex-none bg-secondary shadow flex-none p-2">
    <img :src="product.thumbnail" :alt="product.name" class="w-auto h-full max-h-16" loading="lazy">
  </div>
</template>

<script lang="ts">
  export default {
    name: 'ProductThumbnail'
  }
</script>