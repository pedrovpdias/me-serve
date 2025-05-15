<script setup lang="ts">
  import Subtitle from './Subtitle.vue'; // Importa o sub-título

  import { computed, onMounted, reactive, ref } from 'vue'; // Importa as bibliotecas do Vue

  import axios, { get } from 'axios'; // Importa o axios
  
  import { Bar } from 'vue-chartjs' // Importa o gráfico 
  import 
  {
    Chart as ChartJS, 
    Title, 
    Tooltip, 
    Legend, 
    BarElement, 
    CategoryScale, 
    LinearScale,
    ChartData
  } from 'chart.js' // Importa as bibliotecas do gráfico
  
  ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale); // Registra as bibliotecas

  const options = {
    responsive: true,
  };

  const data = ref<ChartData<'bar'>>({
    datasets: []
  });
      

  async function setChartData(): Promise<ChartData<'bar'>> {
    const response = await axios.get('/api/weekly-products-sold')
      .then((response) => response.data)
      .then((data) => {
        let dayOfWeek = 0;
        const newWeeklySalesData = []

        for (const salesDate in data) {
          dayOfWeek = new Date(salesDate).getDay();

          switch (dayOfWeek) {
            case 0:
              newWeeklySalesData[1] = data[salesDate];
              break;
            case 1:
              newWeeklySalesData[2] = data[salesDate];
              break;
            case 2:
              newWeeklySalesData[3] = data[salesDate];
              break;
            case 3:
              newWeeklySalesData[4] = data[salesDate];
              break;
            case 4:
              newWeeklySalesData[5] = data[salesDate];
              break;
            case 5:
              newWeeklySalesData[6] = data[salesDate];
              break;
            case 6:
              newWeeklySalesData[0] = data[salesDate];
              break;
          }
        }

        return newWeeklySalesData;
      })
      .then((newWeeklySalesData) => {
        return {
          labels: ['Dom','Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
          datasets: [
            {
              label: 'Produtos Vendidos',
              backgroundColor: '#f87979',
              data: newWeeklySalesData
            }
          ]
        }
      })
      .catch((error) => {
        console.log(error);
      });

    return response || { labels: [], datasets: [] };
  }
/////////////////////////////////////////////////////////////
  function getRandomInt() {
    return Math.floor(Math.random() * (50 - 5 + 1)) + 5
  }

////////////////////////////////////////////////////////////////

  onMounted(() => {
    setChartData().then((chartData) => {
      data.value = chartData;
    });
  });
</script>

<template>
  <div class="w-full flex-1">
    <Subtitle :text="'Vendas por dia'" />

    <Bar
      id="sales-chart"
      :options="options"
      :data="data"
    />
  </div>
</template>

<script lang="ts">
  export default {
    name: 'SalesChart'
  }
</script>