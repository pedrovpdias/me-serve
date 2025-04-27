<script setup lang="ts">
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  import Subtitle from './Subtitle.vue';
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
    products.value = data;
  });

</script>

<template>
  <section class="grid gap-4">
    <Subtitle :text="category.name" :id="(category.name).toLowerCase()">
      <template #icon>
        <i class="bi bi-grid-fill text-sm"></i>
      </template>
    </Subtitle>

    <div class="py-4 grid grid-cols-2 gap-4">
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