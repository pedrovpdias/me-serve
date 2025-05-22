<script setup lang="ts">
  const { tableProps } = defineProps<{
    tableProps: {
      table: string,
      columns: string[],
      rows: any,
      link: string
    }
  }>()
</script>

<template>
  <table 
    class="w-full flex-none rounded-xl overflow-hidden outline outline-1 outline-primary/10"
    :aria-label="tableProps.table"
  >
    <thead class="border-b border-primary/10 text-red-600">
      <tr>
        <th v-for="column in tableProps.columns" :key="column" class="text-left p-2">
          {{ column }}
        </th>
      </tr>
    </thead>

    <tbody>
      <tr v-for="row in tableProps.rows" :key="row.col.id" class="odd:bg-red-50 hover:bg-amber-100 focus:bg-amber-100 outline-none">
        <td v-for="colunm in row.col" :key="colunm[0]" class="text-left font-semibold p-2">
          {{ colunm }}
        </td>
      </tr>
    </tbody>

    <tfoot>
      <tr class="text-sm text-primary/80">
        <td class="text-center py-4 px-2" colspan="3">
          <router-link :to="tableProps.link" class="text-sm font-semibold py-1 px-2 text-center text-red-600 hover:text-red-800 focus:text-red-800 outline-none hover:underline focus:underline w-full">
            Ver todos
          </router-link>
        </td>
      </tr>
    </tfoot>
  </table>
</template>

<script lang="ts">
  export default {
    name: 'DashboardTable'
  }
</script>