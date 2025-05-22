<script setup lang="ts">
  import Subtitle from '../components/Subtitle.vue';
  import DashboardTable from './DashboardTable.vue'; // Importa o DashboardTable

  import { ref, onMounted } from 'vue';
  import axios from 'axios';

  const orders = ref<any[]>([]);

  type tableRow = {
    id: string,
    total: string,
    description: string
  }

  type tableProps = {
    table: string,
    columns: string[],
    rows: tableRow[],
    link: string
  }

  const tableProps = ref<tableProps>({
    table: 'Pedidos recentes',
    columns: [
      'Nº do pedido', 
      'Valor', 
      'Status'
    ],
    rows: orders.value,
    link: '/admin/orders'
  })

  onMounted(async () => {
    orders.value = await getOrders();
    
    if (!orders.value.length) {
      return;
    }

    else {
      let orderId: string = '';
      let row: any = {
        col: []
      };
      
      orders.value.forEach((order: any) => {
        orderId = '';
        orderId = order.id; 
        orderId = orderId.toString();

        order.id = `#${orderId.padStart(6, '0')}`;
        order.total = `R$ ${order.total}`;

        row = {
          col: [
            order.id,
            order.total,
            order.description
          ]
        }

        tableProps.value.rows.push(row);
      });
    }

    
  });

  async function getOrders() {
    const { data } = await axios.get('/api/latest-orders');
    return data;
  }
</script>

<template>
  <div class="flex flex-col gap-4 w-fit text-sm flex-1">
    <Subtitle :text="tableProps.table" />

    <DashboardTable v-if="tableProps.rows.length" :tableProps="tableProps" />

    <p v-else class="text-center text-red-600 font-semibold">
      Sem pedidos recentes
    </p>

  </div>
</template>

<script lang="ts">
  export default {
    name: 'LatestOrders'
  }
</script>