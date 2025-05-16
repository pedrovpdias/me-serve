<script lang="ts" setup>
  import { onMounted, ref, computed } from 'vue';

  import axios from 'axios';

  const orders = ref<any[]>([]);

  function getOrders() {
    return axios.get('/api/orders').then((response) => {
      return response.data;
    });
  }

  onMounted(async () => {
    orders.value = await getOrders();
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
</template>

<script lang="ts">
  export default {
    name: 'OrdersTable'
  }
</script>