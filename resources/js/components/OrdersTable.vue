<script lang="ts" setup>
 import PaginationButtons from './PaginationButtons.vue'; // Importa os botões de paginação
  import { onMounted, ref, computed } from 'vue'; // Importa as bibliotecas do Vue

  import axios from 'axios'; // Importa o axios

  const orders = ref<any[]>([]); // Define a lista de pedidos

  // Interface dos links da paginação
  interface paginationLink {
    url: any | null;
    label: string;
    active: boolean;
  }

  // Define o estado da paginação
  const pagination = ref({
    current_page: 1, // Página atual
    last_page: 1, // Total de páginas / últimá pagina
    per_page: 10, // Itens por página
    total: 0, // Total de itens
    links: [] as paginationLink[], // Links de navegação
  });

  // Define o estado da ordenação
  const sort = ref({
    field: 'id', // Campo de ordenação
    direction: 'asc', // Direção de ordenação
  })

  // Busca os pedidos
  async function getOrders(page: number = 1, perPage: number = 10, sort: string = 'id', direction: 'asc' | 'desc' = 'asc') {
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
      throw error; // Lanca o erro para ser tratado no componente
    }
  }

  // Função para lidar com o evento de mudança de página
  async function handlePageChange(urlString: string) {
    const url = new URL(urlString); // Cria um objeto URL
    const page = Number(url.searchParams.get('page')); // Busca o valor da página no parâmetro 'page'

    // Busca os pedidos
    try {
      const response = await getOrders(page, pagination.value.per_page, sort.value.field, sort.value.direction as 'desc' | 'asc');
      orders.value = response.data; // Atualiza a lista de pedidos
      pagination.value = response; // Atualiza as informações de paginação
    } catch (error) {
      console.error('Erro ao buscar pedidos:', error); // Imprime o erro no console
    }
  }

  // Quando o componente for montado
  onMounted(async () => {
    const response = await getOrders(); // Busca os pedidos
    orders.value = response.data; // Atualiza a lista de pedidos
    pagination.value = response; // Atualiza as informações de paginação
    
  });
</script>

<template>
  <table
    v-if="orders.length > 0" 
    class="w-full flex-none rounded-xl overflow-hidden outline outline-1 outline-primary/10 relative"
    aria-label="Pedidos"
  >
    <thead class="border-b border-primary/10 text-red-600">
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
      <tr v-for="order in orders" :key="order.id" class="odd:bg-red-50 hover:bg-amber-100 focus:bg-amber-100 outline-none">
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

    <tfoot>
      <tr class="text-sm text-primary/80">
        <td class="text-left py-4 px-2" colspan="4">
          <span>
            Total de pedidos: {{ pagination.total }}
          </span>
        </td>

        <td class="text-right p-2">
          <span>
            Exibindo de {{ pagination.per_page * (pagination.current_page - 1) + 1 }} a {{ pagination.per_page * pagination.current_page > pagination.total ? pagination.total : pagination.per_page * pagination.current_page }} de {{ pagination.total }}
          </span>
        </td>
      </tr>

      <tr>
        <td class="text-left p-2" colspan="5">
          <PaginationButtons :pagination="pagination" @page-changed="handlePageChange" />
        </td>
      </tr>
    </tfoot>
  </table>
</template>

<script lang="ts">
  export default {
    name: 'OrdersTable'
  }
</script>