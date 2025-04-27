<script setup lang="ts">
  defineProps<{
    categories: {
      id: number, 
      name: string 
    }[];
  }>();

  function scrollToCategory(categoryId: string) {
    const categoryElement = document.getElementById(categoryId);
    if (categoryElement) {
      categoryElement.scrollIntoView({ behavior: 'smooth' });
    }
  }
</script>

<template>
  <div class="grid gap-2 w-full justify-end">
    <h4 class="flex items-end gap-2 font-semibold font-highlight text-2xl px-4">
      <span class="pb-1 text-base">
        <i class="bi bi-list"></i>
      </span>

      Menu
    </h4>

    <ul class="flex gap-4 items-center">
      <li v-for="category in categories" :key="category.id" class="grid place-content-center">
        <button @click="scrollToCategory(category.name.toLowerCase())" class="text-sm px-4 py-2 rounded-full border border-primary/10 cursor-pointer transition-all hover:scale-105 focus:scale-105 font-semibold">
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