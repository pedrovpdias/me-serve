<script setup lang="ts">
  import AdminHeader from '../components/AdminHeader.vue'; // Importa o AdminHeader
  import Title from '../components/Title.vue'; // Importa o título
  import SalesChart from '../components/SalesChart.vue'; // Importa o gráfico de vendas
  import LatestOrders from '../components/LatestOrders.vue'; // Importa os ultimos pedidos

  import { computed, ref } from 'vue'; // Importa as bibliotecas do Vue


</script>
<template>
  <main class="flex flex-col gap-8 relative md:w-auto md:flex-1 md:max-w-4xl mx-auto bg-white shadow-xl py-4 min-h-screen">
    <AdminHeader />

    <div class="flex flex-col gap-8 px-8">
      <Title :text="'Dashboard'" />

      <section class="grid gap-4 grid-cols-3">
        <button class="flex flex-col gap-4 py-8 px-2 items-center border border-primary/10 rounded-lg hover:bg-gray-50 focus:bg-gray-50 transition-all active:shadow-inner">
          <span class="text-3xl w-fit mx-auto">
            <i class="bi bi-clipboard2-check-fill"></i>
          </span>
          
          <span class="text-lg">
            Pedidos do dia
          </span>

          <div class="grid text-lg font-highlight">
            <span class="text-3xl font-bold">
              00
            </span>

            pedidos
          </div>
        </button>
        
        <button class="flex flex-col gap-4 py-8 px-2 items-center border border-primary/10 rounded-lg hover:bg-gray-50 focus:bg-gray-50 transition-all active:shadow-inner">
          <span class="text-3xl w-fit mx-auto">
            <i class="bi bi-cash-coin"></i>
          </span>
          
          <span class="text-lg">
            Faturamento
          </span>

          <div class="grid text-lg font-highlight">
            <span class="text-3xl font-bold">
              R$ 00000,00
            </span>

            dd/mm/aaaa
          </div>
        </button>
        
        <button class="flex flex-col gap-4 py-8 px-2 items-center border border-primary/10 rounded-lg hover:bg-gray-50 focus:bg-gray-50 transition-all active:shadow-inner">
          <span class="text-3xl w-fit mx-auto">
            <i class="bi bi-box-seam-fill"></i>
          </span>
          
          <span class="text-lg">
            Produtos vendidos
          </span>

          <div class="grid text-lg font-highlight">
            <span class="text-3xl font-bold">
              00
            </span>

            produtos
          </div>
        </button>
      </section>

      <section class="flex items-start gap-8 no-wrap">
        <SalesChart />

        <LatestOrders />
      </section>
      
    </div>
  </main>
</template>