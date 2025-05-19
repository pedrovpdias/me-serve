<script lang="ts" setup>
  import PerPageSelector from './PerPageSelector.vue'; // Importa o selector de itens por página
  import TableFooter from './TableFooter.vue'; // Importa o footer da tabela
  import { onMounted, ref, computed } from 'vue'; // Importa as bibliotecas do Vue

  import axios, { get } from 'axios'; // Importa o axios

  const orders = ref<any[]>([]); // Define a lista de pedidos

  const table = 'Pedidos';

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
    direction: 'asc' as 'asc' | 'desc', // Direção de ordenação
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

  // Função para lidar com o evento de mudança de itens por página
  async function handlePerPageChange(perPage: number) {
    try {
      const response = await getOrders(1, perPage, sort.value.field, sort.value.direction);

      orders.value = response.data;
      pagination.value = response;
    } catch (error) {
      console.error('Erro ao buscar pedidos:', error);
    }
  }

  // Função chamada no clique do botão de ordenação
  function onSortClick(field: string) {
    if (sort.value.field === field) {
      sort.value.direction = sort.value.direction === 'asc' ? 'desc' : 'asc'
    } else {
      sort.value.field = field
      sort.value.direction = 'asc'
    }

    handleSort(sort.value.field, sort.value.direction)
  }

  // Função para buscar dados ordenados
  async function handleSort(field: string, direction: 'asc' | 'desc') {
    try {
      const response = await getOrders(1, pagination.value.per_page, field, direction)
      orders.value = response.data
      pagination.value = response
    } catch (error) {
      console.error('Erro ao buscar pedidos:', error)
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
      <PerPageSelector @perPage-changed="handlePerPageChange" :pagination="pagination" :table="table.toLowerCase()" />

      <tr>
        <th class="text-left p-2">
          <button @click="onSortClick('id')" >
            Nº do pedido
            <span v-if="sort.field === 'id' && sort.direction === 'asc'" class="text-xs">
              <i class="bi bi-caret-up-fill"></i>
            </span>
            <span v-else-if="sort.field === 'id' && sort.direction === 'desc'" class="text-xs">
              <i class="bi bi-caret-down-fill"></i>
            </span>
          </button>
        </th>

        <th class="text-left p-2">
          <button @click="onSortClick('client_name')">
            Cliente
            <span v-if="sort.field === 'client_name' && sort.direction === 'asc'" class="text-xs">
              <i class="bi bi-caret-up-fill"></i>
            </span>
            <span v-else-if="sort.field === 'client_name' && sort.direction === 'desc'" class="text-xs">
              <i class="bi bi-caret-down-fill"></i>
            </span>
          </button>
        </th>

        <th class="text-left p-2">
          <button @click="onSortClick('created_at')">
            Data
            <span v-if="sort.field === 'created_at' && sort.direction === 'asc'" class="text-xs">
              <i class="bi bi-caret-up-fill"></i>
            </span>
            <span v-else-if="sort.field === 'created_at' && sort.direction === 'desc'" class="text-xs">
              <i class="bi bi-caret-down-fill"></i>
            </span>
          </button>
        </th>

        <th class="text-left p-2">
          <button @click="onSortClick('total')">
            Valor
            <span v-if="sort.field === 'total' && sort.direction === 'asc'" class="text-xs">
              <i class="bi bi-caret-up-fill"></i>
            </span>
            <span v-else-if="sort.field === 'total' && sort.direction === 'desc'" class="text-xs">
              <i class="bi bi-caret-down-fill"></i>
            </span>
          </button>
        </th>

        <th class="text-left p-2">
          <button @click="onSortClick('description')">
            Status
            <span v-if="sort.field === 'description' && sort.direction === 'asc'" class="text-xs">
              <i class="bi bi-caret-up-fill"></i>
            </span>
            <span v-else-if="sort.field === 'description' && sort.direction === 'desc'" class="text-xs">
              <i class="bi bi-caret-down-fill"></i>
            </span>
          </button>
        </th>

        <th></th>
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

        <td class="text-left p-2">
          <router-link 
            :to="`/admin/orders/${order.id}`" 
            class="btn btn-sm btn-primary rounded-full size-6 grid place-content-center hover:outline-1 hover:outline-primary/30 focus:outline-1 focus:outline-primary/30" 
            title="Detalhes"
          >
            <i class="bi bi-three-dots"></i>
          </router-link>
        </td>
      </tr>
    </tbody>

    <TableFooter
      :table="table.toLowerCase()"
      :pagination="pagination"
      @page-changed="handlePageChange"
    />
  </table>
</template>

<script lang="ts">
  export default {
    name: 'OrdersTable'
  }
</script>