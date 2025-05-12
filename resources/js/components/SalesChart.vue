<template>
  <div class="w-full flex-1">
      <Bar
      id="sales-chart"
      :options="chartOptions"
      :data="chartData"
    />
  </div>
</template>

<script lang="ts">
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

export default {
  name: 'BarChart',
  components: { Bar },
  data() {
    return {
      chartData: {
        labels: [
          'Dom',
          'Seg',
          'Ter',
          'Qua',
          'Qui',
          'Sex',
          'Sab',
        ],
        datasets: [ { data: [40, 20, 12] } ],
      },
      chartOptions: {
        responsive: true
      }
    }
  }
}
</script>