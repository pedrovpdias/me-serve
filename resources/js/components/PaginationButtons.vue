<script setup lang="ts">
  import { defineEmits } from 'vue'; // Importa as bibliotecas do Vue

  // Interface dos links da paginação
  interface paginationLink {
    url: any | null;
    label: string;
    active: boolean;
  }

  // Recebe os links da paginação
  defineProps({
    pagination: {
      type: Object as () => {
        current_page: number; // Página atual
        last_page: number; // Total de páginas / última pagina
        per_page: number; // Itens por página
        total: number; // Total de itens
        links: paginationLink[]; // Links de navegação
      },
      required: true,
    },
  });

  const emit = defineEmits(['page-changed']); // Define o evento a ser emitido

  // Função para lidar com o evento de clique no botão de navegação
  function handleButtonClick(url: string | null) {
    // Verifica se a URL foi fornecida
    if (url) {
      emit('page-changed', url); // Emite o evento 'page-changed' com a URL
    }
  }
</script>

<template>
  <div class="flex flex-row gap-2 items-center justify-center">
    <button
      v-for="(link, index) in pagination.links"
      :key="index"
      :disabled="link.url === null"
      @click="handleButtonClick(link.url)"
      class="flex items-center gap-2 text-sm font-semibold hover:text-primary/80 focus:text-primary/80 outline-none"
    >
      <span v-html="link.label"></span>
    </button>
  </div>
</template>

<script lang="ts">
  export default {
    name: 'PaginationButtons'
  }
</script>