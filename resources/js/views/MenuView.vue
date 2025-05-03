<script setup lang="ts">
  import MenuHeader from '../components/MenuHeader.vue'; // Importa o MenuHeader
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
  <main class="grid relative md:w-auto md:flex-1 md:max-w-4xl mx-auto lg:px-4">
    <MenuHeader />

    <section class="grid z-20 bg-white p-4 md:p-8 -mt-20 md:-mt-10 rounded-tl-3xl rounded-tr-3xl -mx-px sticky border-t border-t-black/5 w-auto">
      <div class="grid gap-8">
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