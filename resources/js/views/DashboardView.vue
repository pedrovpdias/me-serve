<script setup lang="ts">
  import AdminHeader from '../components/AdminHeader.vue'; // Importa o AdminHeader
  import Title from '../components/Title.vue'; // Importa o título
  import SalesChart from '../components/SalesChart.vue'; // Importa o gráfico de vendas
  import LatestOrders from '../components/LatestOrders.vue'; // Importa os ultimos pedidos

  import productsIcon from '../../images/products.svg'; // Importa o icone de produtos
  import ordersIcon from '../../images/orders.svg'; // Importa o icone de pedidos
  import billingIcon from '../../images/billing.svg'; // Importa o icone de faturamento

  import { computed, ref, onMounted } from 'vue'; // Importa as bibliotecas do Vue
  import axios from 'axios'; // Importa o axios

  const dailyOrders = ref(0); // Define o dailyOrders como 0

  const billingDate = computed(() => new Date().toLocaleDateString('pt-BR')); // Define a data do faturamento
  const dailyBilling = ref(0); // Define o dailyBilling como 0

  const dailyProductsSold = ref(0); // Define o dailyProductsSold como 0

  // Função para pegar os pedidos do dia
  async function getDailyOrders() {
    const { data } = await axios.get('/api/daily-orders-counter'); // Realiza a requisição para pegar os pedidos do dia
    return data; // Retorna os dados
  }

  // Função para pegar o faturamento do dia
  async function getDailyBilling() {
    const { data } = await axios.get('/api/daily-billing'); // Realiza a requisição para pegar o faturamento do dia
    return data; // Retorna os dados
  }

  // Função para pegar os produtos vendidos do dia
  async function getDailyProductsSold() {
    const { data } = await axios.get('/api/daily-products-sold'); // Realiza a requisição para pegar os produtos vendidos do dia
    return data; // Retorna os dados
  }

  // Quando o componente for montado
  onMounted(async () => {
    dailyOrders.value = await getDailyOrders(); // Pega os pedidos do dia
    dailyBilling.value = await getDailyBilling(); // Pega o faturamento do dia
    dailyProductsSold.value = await getDailyProductsSold(); // Pega os produtos vendidos do dia
  });


</script>
<template>
  <main class="flex flex-col gap-8 relative md:w-auto md:flex-1 md:max-w-4xl mx-auto bg-white shadow-xl py-4 min-h-screen">
    <AdminHeader />

    <div class="flex flex-col gap-8 px-8">
      <Title :text="'Dashboard'" />

      <section class="grid gap-4 grid-cols-3">
        <button class="flex flex-col gap-4 py-8 px-2 items-center border border-primary/10 rounded-lg hover:bg-gray-50 focus:bg-gray-50 transition-all active:shadow-inner">
          <div class="w-fit mx-auto">
            <img :src="ordersIcon" alt="Pedidos" class="w-auto h-16" loading="lazy">
          </div>
          
          <span class="text-lg">
            Pedidos do dia
          </span>

          <div class="grid text-lg font-highlight">
            <span class="text-3xl font-bold">
              {{ dailyOrders }}
            </span>

            pedidos
          </div>
        </button>
        
        <button class="flex flex-col gap-4 py-8 px-2 items-center border border-primary/10 rounded-lg hover:bg-gray-50 focus:bg-gray-50 transition-all active:shadow-inner">
          <div class="w-fit mx-auto">
            <img :src="billingIcon" alt="Faturamento" class="w-auto h-16" loading="lazy">
          </div>
          
          <span class="text-lg">
            Faturamento
          </span>

          <div class="grid text-lg font-highlight">
            <span class="text-3xl font-bold">
              R$ {{ dailyBilling }}
            </span>

            {{ billingDate }}
          </div>
        </button>
        
        <button class="flex flex-col gap-4 py-8 px-2 items-center border border-primary/10 rounded-lg hover:bg-gray-50 focus:bg-gray-50 transition-all active:shadow-inner">
          <div class="w-fit mx-auto">
            <img :src="productsIcon" alt="Produtos" class="w-auto h-16" loading="lazy">
          </div>
          
          <span class="text-lg">
            Produtos vendidos
          </span>

          <div class="grid text-lg font-highlight">
            <span class="text-3xl font-bold">
              {{ dailyProductsSold }}
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