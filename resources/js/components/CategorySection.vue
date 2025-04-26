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


  const { category } = defineProps<{
    category: {
      id: number,
      name: string,
    }
  }>();

  onMounted(async () => {
    const { data } = await axios.get('/api/products', {
      params: {
        category_id: category.id
      }
    });
    products.value = data; console.log(data);
  });

</script>

<template>
  <section class="grid gap-4">
    <h2 class="text-2xl font-bold font-highlight text-amber-500 px-4">
      {{ category.name }}
    </h2>

    <div class="p-4 grid grid-cols-2 gap-4">
      <ProductCard
        v-for="product in products"
        :key="product.id"
        :product="product"
      />
    </div>
  </section>
</template>

<script lang="ts">
  export default {
    name: 'CategorySection'
  }
</script>