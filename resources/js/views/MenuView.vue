<script setup lang="ts">
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  import CategorySection from '../components/CategorySection.vue';

  interface Category {
    id: number;
    name: string;
  }
  const categories = ref<Category[]>([]);


  onMounted(async () => {
    const { data } = await axios.get('/api/categories');
    categories.value = data;
  });

</script>

<template>
  <main class="grid gap-4">
    <CategorySection
      v-for="category in categories"
      :key="category.id"
      :category="category"
      
    />
  </main>
</template>

<script lang="ts">
  export default {
    name: 'MenuView'
  }
</script>