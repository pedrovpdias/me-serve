// src/components/ProductCard.vue
<script setup lang="ts">
  defineProps<{ product: { id: number, name: string, price: number, image: string } }>();
</script>


<template>
  <div class="border rounded-xl p-4 shadow hover:scale-105 transition">
    <img :src="product.image" alt="product" class="w-full h-32 object-cover mb-2 rounded" />
    <h2 class="text-lg font-bold">{{ product.name }}</h2>
    <p class="text-sm text-gray-600">R$ {{ product.price.toFixed(2) }}</p>
    <button @click="$emit('adicionar', product)" class="mt-2 bg-yellow-500 text-white py-1 px-4 rounded">Adicionar</button>
  </div>
</template>


<script>
  export default {
    name: 'ProductCard'
  }
</script>