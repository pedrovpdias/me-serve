<script setup lang="ts">
  import Navbar from '../components/Navbar.vue';
  import Title from '../components/Title.vue';
  import CategoriesMenu from '../components/CategoriesMenu.vue';
  import Menu from '../components/Menu.vue';
  import HomeFooter from '../components/HomeFooter.vue';
  import PopupCartButton from '../components/PopupCartButton.vue';
  
  import { ref, onMounted } from 'vue';
  import axios from 'axios';

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
  <main class="grid gap-4 relative">
    <Navbar />

    <section class="grid">
      <div class="grid gap-2">
        <div class="grid gap-px">
          <Title :text="'Cardápio'" />

          <span class="text-sm opacity-80">
            Escolha o item desejado e clique em "Adicionar"
          </span>
        </div>

        <CategoriesMenu :categories="categories" />
      </div>

      <div class="pt-2">
        <Menu :categories="categories" />
      </div>
    </section>

    <PopupCartButton />

    <HomeFooter />
  </main>
</template>