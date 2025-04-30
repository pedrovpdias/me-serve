<script setup lang="ts">
  import { ref, onMounted } from 'vue'; // Importa as bibliotecas do Vue
  import axios from 'axios'; // Importa o axios
  import Subtitle from './Subtitle.vue'; // Importa o sub-título
  import ProductCard from '../components/ProductCard.vue'; // Importa o card de produto

  // Interfaces do produto
  interface Product {
    id: number;
    name: string;
    description: string;
    price: number;
    thumbnail: string;
  }
  const products = ref<Product[]>([]); // Instancia os produtos

  // Recebe a categoria
  const { category } = defineProps<{
    category: {
      id: number,
      name: string,
    }
  }>();

  // Busca os produtos da categoria
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

    <div class="py-4 grid grid-cols-1 md:grid-cols-2 gap-4">
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