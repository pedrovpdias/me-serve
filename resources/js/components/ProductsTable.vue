<script lang="ts" setup>
  import PerPageSelector from './PerPageSelector.vue'; // Importa o selector de itens por página
  import TableFooter from './TableFooter.vue'; // Importa o footer da tabela
  import { onMounted, ref } from 'vue'; // Importa as bibliotecas do Vue

  import axios from 'axios'; // Importa o axios

  const products = ref<any[]>([]); // Define a lista de produtos

  const table = 'produtos';

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

  // Busca os produtos
  async function getProducts(page: number = 1, perPage: number = 10, sort: string = 'id', direction: 'asc' | 'desc' = 'asc') {
    try {
      const response = await axios.get('/api/products-list', {
        params: {
          page: page,
          per_page: perPage,
          sort: sort,
          direction: direction,
        },
      });
      return response.data; // O Laravel paginate retorna um objeto com 'data', 'links', 'meta'
    } catch (error) {
      console.error('Erro ao buscar produtos:', error);
      throw error; // Lanca o erro para ser tratado no componente
    }
  }

  // Função para lidar com o evento de mudança de página
  async function handlePageChange(urlString: string) {
    const url = new URL(urlString); // Cria um objeto URL
    const page = Number(url.searchParams.get('page')); // Busca o valor da página no parâmetro 'page'

    // Busca os produtos
    try {
      const response = await getProducts(page, pagination.value.per_page, sort.value.field, sort.value.direction as 'desc' | 'asc');
      products.value = response.data; // Atualiza a lista de produtos
      pagination.value = response; // Atualiza as informações de paginação
    } catch (error) {
      console.error('Erro ao buscar produtos:', error); // Imprime o erro no console
    }
  }

  // Função para lidar com o evento de mudança de itens por página
  async function handlePerPageChange(perPage: number) {
    try {
      const response = await getProducts(1, perPage, sort.value.field, sort.value.direction);

      products.value = response.data;
      pagination.value = response;
    } catch (error) {
      console.error('Erro ao buscar produtos:', error);
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
      const response = await getProducts(1, pagination.value.per_page, field, direction)
      products.value = response.data
      pagination.value = response
    } catch (error) {
      console.error('Erro ao buscar produtos:', error)
    }
  }

  // Quando o componente for montado
  onMounted(async () => {
    const response = await getProducts(); // Busca os produtos
    products.value = response.data; // Atualiza a lista de produtos
    pagination.value = response; // Atualiza as informações de paginação
    
  });
</script>

<template>
  <table
    v-if="products.length > 0" 
    class="w-full flex-none rounded-xl overflow-hidden outline outline-1 outline-primary/10 relative"
    aria-label="produtos"
  >
    <thead class="border-b border-primary/10 text-red-600">
      <PerPageSelector @perPage-changed="handlePerPageChange" :pagination="pagination" :table="table.toLowerCase()" />

      <tr>
        <th class="text-left p-2">
          <button @click="onSortClick('id')" >
            ID
            <span v-if="sort.field === 'id' && sort.direction === 'asc'" class="text-xs">
              <i class="bi bi-caret-up-fill"></i>
            </span>
            <span v-else-if="sort.field === 'id' && sort.direction === 'desc'" class="text-xs">
              <i class="bi bi-caret-down-fill"></i>
            </span>
          </button>
        </th>

        <th></th>

        <th class="text-left p-2">
          <button @click="onSortClick('name')">
            Nome
            <span v-if="sort.field === 'name' && sort.direction === 'asc'" class="text-xs">
              <i class="bi bi-caret-up-fill"></i>
            </span>
            <span v-else-if="sort.field === 'name' && sort.direction === 'desc'" class="text-xs">
              <i class="bi bi-caret-down-fill"></i>
            </span>
          </button>
        </th>

        <th class="text-left p-2">
          <button @click="onSortClick('category_name')">
            Categoria
            <span v-if="sort.field === 'category_name' && sort.direction === 'asc'" class="text-xs">
              <i class="bi bi-caret-up-fill"></i>
            </span>
            <span v-else-if="sort.field === 'category_name' && sort.direction === 'desc'" class="text-xs">
              <i class="bi bi-caret-down-fill"></i>
            </span>
          </button>
        </th>

        <th class="text-left p-2">
          <button @click="onSortClick('price')">
            Preço
            <span v-if="sort.field === 'price' && sort.direction === 'asc'" class="text-xs">
              <i class="bi bi-caret-up-fill"></i>
            </span>
            <span v-else-if="sort.field === 'price' && sort.direction === 'desc'" class="text-xs">
              <i class="bi bi-caret-down-fill"></i>
            </span>
          </button>
        </th>

        <th></th>
      </tr>

    </thead>

    <tbody>
      <tr v-for="product in products" :key="product.id" class="odd:bg-red-50 hover:bg-amber-100 focus:bg-amber-100 outline-none">
        <td class="text-left font-semibold p-2">
          #{{ product.id.toString().padStart(6, '0') }}
        </td>

        <td>
          <img 
            :src="`/${product.thumbnail}`"
            :alt="product.name"
            class="w-auto h-6 mx-auto" 
          />
        </td>

        <td class="text-left p-2">
          {{ product.name }}
        </td>

        <td class="text-left p-2">
          {{ product.category_name }}
        </td>

        <td class="text-left p-2">
          R$ {{ product.price }}
        </td>

        <td class="text-left p-2">
          <router-link 
            :to="`/admin/products/${product.id}`" 
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
    name: 'ProductsTable'
  }
</script>