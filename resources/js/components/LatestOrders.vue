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

    <table 
      v-if="orders.length > 0"
      class="w-full flex-none rounded-xl overflow-hidden outline outline-1 outline-primary/10"
      aria-label="Pedidos recentes"
    >
      <thead class="border-b border-primary/10 text-red-600">
        <tr>
          <th class="text-left p-2">Nº do pedido</th>
          <th class="text-left p-2">Valor</th>
          <th class="text-left p-2">Status</th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="order in orders" :key="order.id" class="odd:bg-red-50 hover:bg-amber-100 focus:bg-amber-100 outline-none">
          <td class="text-left font-semibold p-2">
            #{{ order.id.toString().padStart(6, '0') }}
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

    <p v-else class="text-center text-red-600 font-semibold">
      Sem pedidos recentes
    </p>

    <div class="flex justify-end">
      <router-link to="/admin/orders" class="text-sm font-semibold py-1 px-2 text-center text-red-600 hover:text-red-800 focus:text-red-800 outline-none hover:underline focus:underline w-full">
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