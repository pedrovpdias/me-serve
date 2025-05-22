<script setup lang="ts">
  import Subtitle from '../components/Subtitle.vue';
  import DashboardTable from './DashboardTable.vue'; // Importa o DashboardTable

  import { ref, onMounted } from 'vue';
  import axios from 'axios';

  const products = ref<any[]>([]);

  type tableRow = {
    id: string,
    total: string,
    name: string
  }

  type tableProps = {
    table: string,
    columns: string[],
    rows: tableRow[],
    link: string
  }

  const tableProps = ref<tableProps>({
    table: 'Produtos recentes',
    columns: [
      'ID', 
      'Nome',
      'Valor', 
    ],
    rows: products.value,
    link: '/admin/products'
  })

  onMounted(async () => {
    products.value = await getProducts();
    
    if (!products.value.length) {
      return;
    }

    else {
      let productsId: string = '';
      let row: any = {
        col: []
      };
      
      products.value.forEach((products: any) => {
        productsId = '';
        productsId = products.id; 
        productsId = productsId.toString();

        products.id = `#${productsId.padStart(6, '0')}`;
        products.price = `R$ ${products.price}`;

        row = {
          col: [
            products.id,
            products.name,
            products.price,
          ]
        }

        tableProps.value.rows.push(row);
      });
    }

    
  });

  async function getProducts() {
    const { data } = await axios.get('/api/latest-products');
    return data;
  }
</script>

<template>
  <div class="flex flex-col gap-4 w-fit text-sm flex-1">
    <Subtitle :text="tableProps.table" />

    <DashboardTable v-if="tableProps.rows.length" :tableProps="tableProps" />

    <p v-else class="text-center text-red-600 font-semibold">
      Sem produtos recentes
    </p>

  </div>
</template>

<script lang="ts">
  export default {
    name: 'LatestProducts'
  }
</script>