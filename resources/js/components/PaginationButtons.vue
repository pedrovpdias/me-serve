<script setup lang="ts">
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
  <div class="flex flex-row items-center justify-center gap-2 rounded-full border border-primary/10 w-fit mx-auto text-red-600">
    <button
      v-for="(link, index) in pagination.links"
      :key="index"
      :disabled="link.url === null"
      @click="handleButtonClick(link.url)"
      class="flex place-content-center py-2 px-4 gap-2 text-sm first:rounded-l-full last:rounded-r-full font-semibold hover:bg-red-600/5 focus:bg-red-600/5 outline-none disabled:opacity-50 disabled:pointer-events-none"
      :class="{ 'bg-red-600/5 relative z-0 before:absolute before:-top-1.5 before:-left-1.5 before:-bottom-1.5 before:-right-1.5 before:w-auto before:h-auto before:bg-red-600 text-white before:rounded-lg before:shadow before:z-10': link.active }"
    >
      <span v-html="link.label" class="pointer-events-none z-20"></span>
    </button>
  </div>
</template>

<script lang="ts">
  export default {
    name: 'PaginationButtons'
  }
</script>