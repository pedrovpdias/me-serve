<script lang="ts" setup>
 import PaginationButtons from './PaginationButtons.vue'; // Importa os botões de paginação
  import { onMounted, ref, computed } from 'vue';

  import axios from 'axios';

  const orders = ref<any[]>([]);

  interface paginationLink {
    url: any | null;
    label: string;
    active: boolean;
  }

  const pagination = ref({
    current_page: 1,
    last_page: 1,
    per_page: 10,
    total: 0,
    links: [] as paginationLink[],
  });

  const sort = ref({
    field: 'id',
    direction: 'asc',
  })

  async function getOrders(page: number = 1, perPage: number = 5, sort: string = 'id', direction: 'asc' | 'desc' = 'asc') {
    try {
      const response = await axios.get('/api/orders', {
        params: {
          page: page,
          per_page: perPage,
          sort: sort,
          direction: direction,
        },
      });
      return response.data; // O Laravel paginate retorna um objeto com 'data', 'links', 'meta'
    } catch (error) {
      console.error('Erro ao buscar pedidos:', error);
      throw error; // É uma boa prática relançar o erro para tratamento no componente
    }
  }


  async function handlePageChange(urlString: string) {
    const url = new URL(urlString);
    const page = Number(url.searchParams.get('page'));

    try {
      const response = await getOrders(page, pagination.value.per_page, sort.value.field, sort.value.direction as 'desc' | 'asc');
      orders.value = response.data;
      pagination.value = response; // Atualize as informações de paginação
    } catch (error) {
      console.error('Erro ao buscar pedidos:', error);
    }
  }


  onMounted(async () => {
    const response = await getOrders();
    orders.value = response.data;
    pagination.value = response;
    
  });
</script>

<template>
  <table class="w-full flex-none border border-primary/10">
    <thead class="border-b border-primary/10">
      <tr>
        <th class="text-left p-2">
          Nº do pedido
        </th>

        <th class="text-left p-2">
          Cliente
        </th>

        <th class="text-left p-2">
          Data
        </th>

        <th class="text-left p-2">
          Valor
        </th>

        <th class="text-left p-2">
          Status
        </th>
      </tr>
    </thead>

    <tbody>
      <tr v-for="order in orders" :key="order.id" class="odd:bg-secondary hover:bg-primary/10">
        <td class="text-left font-semibold p-2">
          #{{ order.id.toString().padStart(6, '0') }}
        </td>

        <td class="text-left p-2">
          {{ order.client_name }}
        </td>

        <td class="text-left p-2">
          {{ order.created_at.split('T')[0].split('-').reverse().join('/') }}
        </td>

        <td class="text-left p-2">
          R$ {{ order.total }}
        </td>

        <td class="text-left p-2">
          {{ order.description }}
        </td>
      </tr>
    </tbody>
  </table>

  <PaginationButtons :pagination="pagination"  @page-changed="handlePageChange" />
</template>

<script lang="ts">
  export default {
    name: 'OrdersTable'
  }
</script>