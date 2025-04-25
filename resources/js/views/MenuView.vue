<script setup lang="ts">
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  import ProductCard from '../components/ProductCard.vue';

  interface Product {
    id: number;
    name: string;
    description: string;
    price: number;
    thumbnail: string;
  }
  const products = ref<Product[]>([]);


  onMounted(async () => {
    const { data } = await axios.get('/api/products');
    products.value = data;
  });

</script>

<template>
  <main class="p-4 grid grid-cols-2 gap-4">
    <ProductCard
      v-for="product in products"
      :key="product.id"
      :product="product"
      
    />
  </main>
</template>

<script lang="ts">
  export default {
    name: 'MenuView'
  }
</script>