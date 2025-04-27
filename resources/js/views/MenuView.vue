<script setup lang="ts">
  import Navbar from '../components/Navbar.vue'; // Importa o navbar
  import Title from '../components/Title.vue'; // Importa o título
  import CategoriesMenu from '../components/CategoriesMenu.vue'; // Importa o menu de categorias
  import CategorySection from '../components/CategorySection.vue'; // Importa a seção de categoria
  import MenuFooter from '../components/MenuFooter.vue'; // Importa o footer com o carrinho
  import PopupCartButton from '../components/PopupCartButton.vue'; // Importa o popup do carrinho (botão no canto inferior direito)
  
  import { ref, onMounted } from 'vue'; // Importa as bibliotecas do Vue
  import axios from 'axios'; // Importa o axios

  // Interfaces
  interface Category {
    id: number;
    name: string;
  }
  const categories = ref<Category[]>([]); // Categorias do cardápio

  // Busca as categorias do cardápio
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
        <div class="grid gap-4">
          <CategorySection
            v-for="category in categories"
            :key="category.id"
            :category="category"
            
          />
        </div>
      </div>
    </section>

    <PopupCartButton />

    <MenuFooter />
  </main>
</template>