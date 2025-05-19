<script setup lang="ts">
  import AdminHeader from '../components/AdminHeader.vue'; // Importa o AdminHeader
  import Title from '../components/Title.vue'; // Importa o título

  import axios from 'axios'; // Importa o axios

  import { onMounted } from 'vue'; // Importa as bibliotecas do Vue

  import { useRoute } from 'vue-router'; // Importa o router

  const $route = useRoute();
  const id = $route.params.orderId;

  const breadcrumbLinks = [
    {
      name: 'Dashboard' as string,
      path: '/admin' as string,
    },
    {
      name: 'Pedidos' as string,
      path: '/admin/orders' as string,
    },
    {
      name: 'Detalhes' as string,
      path: `/admin/orders/${id}` as string,
    },
  ];

  async function getOrderDetails(id: string) {
    try {
      const response = await axios(`/api/orders/${id}`);
      console.log(response.data);
      return response.data; 
    } catch (error) {
      console.error('Erro ao buscar detalhes do pedido:', error);
      throw error; // Lanca o erro para ser tratado no componente
    }
  }

  onMounted(async () => {
    try {
      const order = await getOrderDetails(id);
      console.log(order);
    } catch (error) {
      console.error('Erro ao buscar detalhes do pedido:', error);
    }
  })
</script>

<template>
  <main class="flex flex-col gap-8 relative md:w-auto md:flex-1 md:max-w-4xl mx-auto bg-white shadow-xl py-4 min-h-screen">
    <AdminHeader :breadcrumbLinks="breadcrumbLinks" />

    <div class="flex flex-col gap-8 px-8">
      <Title :text="`Pedido #${id.toString().padStart(6, '0')}`" />

    </div>
  </main>
</template>