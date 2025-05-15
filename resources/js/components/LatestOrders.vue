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

    <table class="w-full flex-none border border-primary/10">
      <thead class="border-b border-primary/10">
        <tr>
          <th class="text-left p-2">Nº do pedido</th>
          <th class="text-left p-2">Valor</th>
          <th class="text-left p-2">Status</th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="order in orders" :key="order.id" class="odd:bg-secondary hover:bg-primary/10">
          <td class="text-left font-semibold p-2">
            #{{ order.id }}
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

    <div class="flex justify-end">
      <router-link to="/orders" class="bg-secondary w-full text-sm font-semibold py-1 px-2 text-center hover:bg-primary/10 focus:bg-primary/10 active:shadow-inner outline-none">
        Ver todos
      </router-link>
    </div>
  </div>
</template>

<script lang="ts">
  export default {
    name: 'LatestOrders'
  }
</script>