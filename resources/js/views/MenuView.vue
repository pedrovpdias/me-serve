// src/views/MenuView.vue
<template>
  <div class="p-4 grid grid-cols-2 gap-4">
    <ProductCard
      v-for="product in products"
      :key="product.id"
      :product="product"
      @add="addToCart"
    />
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import axios from 'axios';
import ProductCard from '../components/ProductCard.vue';
import { useCartStore } from '../stores/userCartStore';

const products = ref([]);
const cart = useCartStore();

onMounted(async () => {
  const { data } = await axios.get('/api/products');
  products.value = data;
});

function addToCart(product: any) {
  cart.addItem(product);
}
</script>