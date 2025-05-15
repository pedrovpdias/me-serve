<script setup lang="ts">
  import AdminHeader from '../components/AdminHeader.vue'; // Importa o AdminHeader
  import Title from '../components/Title.vue'; // Importa o título
  import SalesReports from '../components/SalesReports.vue'; // Importa os relatórios de vendas
  import SalesChart from '../components/SalesChart.vue'; // Importa o gráfico de vendas
  import LatestOrders from '../components/LatestOrders.vue'; // Importa os ultimos pedidos

  const breadcrumbLinks = [
    {
      name: 'Dashboard' as string,
      path: '/admin' as string,
    },
  ];

</script>
<template>
  <main class="flex flex-col gap-8 relative md:w-auto md:flex-1 md:max-w-4xl mx-auto bg-white shadow-xl py-4 min-h-screen">
    <AdminHeader  :breadcrumbLinks="breadcrumbLinks" />

    <div class="flex flex-col gap-8 px-8">
      <Title :text="'Dashboard'" />

      <SalesReports />

      <section class="flex items-start gap-8 no-wrap">
        <SalesChart />

        <LatestOrders />
      </section>
      
    </div>
  </main>
</template>