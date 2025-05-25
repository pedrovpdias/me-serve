<script setup lang="ts">
  import AdminHeader from '../components/AdminHeader.vue'; // Importa o AdminHeader
  import Title from '../components/Title.vue'; // Importa o título
  import ToastError from '../components/ToastError.vue'; // Importa o toast de erro
  import ToastSuccess from '../components/ToastSuccess.vue'; // Importa o toast de sucesso

  import { onMounted, ref } from 'vue'; // Importa as bibliotecas do Vue

  import { useRoute } from 'vue-router'; // Importa o router

  const $route = useRoute(); // Instancia o router
  const id = $route.params.orderId; // Recebe o id do pedido como parâmetro da rota

  const toastErrorRef = ref<InstanceType<typeof ToastError> | null>(null); // Instancia o toast de erro
  const errorMessage = ref(''); // Para exibir mensagens de erro
  const toastSuccessRef = ref<InstanceType<typeof ToastSuccess> | null>(null); // Instancia o toast de sucesso
  const successMessage = ref(''); // Para exibir mensagens de sucesso

  const breadcrumbLinks = [
    {
      name: 'Dashboard' as string,
      path: '/admin' as string,
    },
    {
      name: 'Produtos' as string,
      path: '/admin/products' as string,
    },
    {
      name: 'Detalhes' as string,
      path: `/admin/products/${id}` as string,
    },
  ];
</script>

<template>
  <main class="flex flex-col gap-8 relative md:w-auto md:flex-1 md:max-w-4xl mx-auto bg-white shadow-xl py-4 min-h-screen">
    <AdminHeader :breadcrumbLinks="breadcrumbLinks" />

    <ToastError ref="toastErrorRef" />
    <ToastSuccess ref="toastSuccessRef" />

    <div class="flex flex-col gap-8 px-8">
      <Title :text="'Nome do produto'" />

      
    </div>
  </main>
</template>