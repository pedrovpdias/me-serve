<script setup lang="ts">
  // Recebe as categorias
  defineProps<{
    categories: {
      id: number, 
      name: string 
    }[];
  }>();

  // Função para rolar para a categoria selecionada
  function scrollToCategory(categoryId: string) {
    const categoryElement = document.getElementById(categoryId); // Pega o elemento da categoria
    if (categoryElement) {
      categoryElement.scrollIntoView({ behavior: 'smooth' }); // Rola para a categoria
    }
  }
</script>

<template>
  <div class="flex flex-col md:grid gap-2 w-full md:justify-end pb-4 md:pb-0">
    <h4 class="flex items-end gap-2 font-semibold font-highlight text-2xl md:px-4">
      <span class="pb-1 text-base">
        <i class="bi bi-list"></i>
      </span>

      Menu
    </h4>

    <ul class="flex flex-col md:flex-row gap-1 md:gap-4 md:items-center w-full md:w-fit">
      <li v-for="category in categories" :key="category.id" class="grid md:place-content-center w-full md:w-fit">
        <button @click="scrollToCategory(category.name.toLowerCase())" class="flex justify-start w-full md:w-fit text-sm px-4 py-2 md:rounded-full md:border border-primary/10 cursor-pointer transition-all hover:scale-105 focus:scale-105 font-semibold">
          {{ category.name }}
        </button>
      </li>
    </ul>
  </div>
</template>

<script lang="ts">
  export default {
    name: 'CategoriesMenu'
  }
</script>