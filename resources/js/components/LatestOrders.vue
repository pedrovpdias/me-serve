<script setup lang="ts">
  import Subtitle from '../components/Subtitle.vue';

  import { ref, onMounted } from 'vue';
  import axios from 'axios';

  const orders = ref<any[]>([]);

  onMounted(async () => {
    orders.value = await getOrders();
  });

  async function getOrders() {
    const { data } = await axios.get('/api/latest-orders');
    return data;
  }
</script>

<template>
  <div class="flex flex-col gap-4 w-fit text-sm flex-1">
    <Subtitle :text="'Pedidos recentes'" />

    <table class="w-fit flex-none border-separate border-spacing-2">
      <thead>
        <tr>
          <th class="text-left">Nº do pedido</th>
          <th class="text-left">Valor</th>
          <th class="text-left">Status</th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="order in orders" :key="order.id">
          <td class="text-left font-semibold">
            #{{ order.id }}
          </td>
          <td class="text-left">
            R$ {{ order.total }}
          </td>
          <td class="text-left">
            {{ order.description }}
          </td>
        </tr>
      </tbody>
    </table>

    <div class="flex justify-end">
      <router-link to="/pedidos" class="bg-secondary w-full text-sm font-semibold py-1 px-2 text-center">Ver todos</router-link>
    </div>
  </div>
</template>

<script lang="ts">
  export default {
    name: 'LatestOrders'
  }
</script>