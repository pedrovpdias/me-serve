<script setup lang="ts">
  import productsIcon from '../../images/products.svg'; // Importa o icone de produtos
  import ordersIcon from '../../images/orders.svg'; // Importa o icone de pedidos
  import billingIcon from '../../images/billing.svg'; // Importa o icone de faturamento

  import { computed, onMounted, reactive } from 'vue'; // Importa as bibliotecas do Vue
  import axios from 'axios'; // Importa o axios


  const billingDate = computed(() => new Date().toLocaleDateString('pt-BR')); // Define a data do faturamento
  console

  const reports = reactive(
    {
      dailyOrders: {
        title: 'Pedidos',
        icon: ordersIcon,
        value: 0,
        span: 'pedidos',
      },
      dailyBilling: {
        title: 'Faturamento',
        icon: billingIcon,
        value: 'R$ 0,00',
        span: billingDate,
      },
      dailyProductsSold: {
        title: 'Produtos Vendidos',
        icon: productsIcon,
        value: 0,
        span: 'produtos',
      },
    }
  );

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
    reports.dailyOrders.value = await getDailyOrders(); // Pega os pedidos do dia
    
    reports.dailyBilling.value =`R$ ${await getDailyBilling()}` ; // Pega o faturamento do dia
    
    reports.dailyProductsSold.value = await getDailyProductsSold(); // Pega os produtos vendidos do dia

  });


</script>

<template>
  <section class="grid gap-4 grid-cols-3">
    <div v-for="report in reports" :key="report.title" class="flex flex-col gap-4 py-8 px-2 items-center border border-primary/10 rounded-lg">
      <div class="w-fit mx-auto">
        <img :src="report.icon" :alt="report.title" class="w-auto h-16" loading="lazy">
      </div>
      
      <span class="text-lg">
        {{ report.title }}
      </span>

      <div class="grid text-lg font-highlight">
        <span class="text-3xl font-bold text-center">
          {{ report.value }}
        </span>

        <span class="text-sm opacity-80 text-center">
          {{ report.span }}
        </span>            
      </div>
    </div>
  </section>
</template>

<script lang="ts">
  export default {
    name: 'SalesReports',
  }
</script>