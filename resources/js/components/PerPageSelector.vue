<script setup lang="ts">
  import { defineEmits } from 'vue';

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
  })

  const emit = defineEmits(['per-page-changed']);
</script>

<template>
  <tr class="text-sm text-primary/80">
    <th class="font-normal text-sm p-2 text-right" :colspan="Object.keys(pagination).length">
      <div class="flex items-center gap-2 justify-end">
        <select 
          v-model="pagination.per_page" 
          @change="$emit('per-page-changed', pagination.per_page)"
          id="perPage"
        >
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="25">25</option>
          <option value="50">50</option>
          <option value="100">100</option>
        </select>

        <label for="perPage">
          {{ table.toLowerCase() }} por página
        </label>
      </div>
    </th>
  </tr>
</template>

<script lang="ts">
  export default {
    name: 'PerPageSelector'
  }
</script>