<script setup lang="ts">
  import PaginationButtons from './PaginationButtons.vue'; // Importa os botões de paginação

  // Interface dos links da paginação
  interface paginationLink {
    url: any | null;
    label: string;
    active: boolean;
  }

  // Recebe as informações de paginação
  defineProps({
    // Recebe as informações de paginação
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
    // Recebe o nome da tabela
    table: {
      type: String, // Tipo string
      required: true, // Requerido
    },
  });


</script>

<template>
  <tfoot>
    <tr class="text-sm text-primary/80">
      <td class="text-left py-4 px-2" :colspan="Object.keys(pagination).length">
        <div class="flex items-center justify-between">
          <span>
            Total de {{ table }}: {{ pagination.total }}
          </span>

          <span>
            Exibindo de {{ pagination.per_page * (pagination.current_page - 1) + 1 }} a {{ pagination.per_page * pagination.current_page > pagination.total ? pagination.total : pagination.per_page * pagination.current_page }} de {{ pagination.total }} {{ table }}
          </span>
        </div>
      </td>
    </tr>

    <tr>
      <td class="text-left p-2" colspan="5">
        <PaginationButtons :pagination="pagination" @page-changed="$emit('page-changed', $event)" />
      </td>
    </tr>
  </tfoot>
</template>

<script lang="ts">
  export default {
    name: 'TableFooter'
  }
</script>