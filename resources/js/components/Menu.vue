<script setup lang="ts">
  import CategorySection from './CategorySection.vue'; // Importa a seção de categoria

  // Recebe as categorias
  const { categories } = defineProps<{
    categories: {
      id: number,
      name: string,
    }[]
  }>();

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
    name: 'Menu'
  }
</script>