<script setup lang="ts">
  import Subtitle from './Subtitle.vue'; // Importa o sub-título

  import { useCustomerStore } from '../stores/customerStore'; // Importa o usuario

  import { computed } from 'vue'; // Importa as bibliotecas do Vue

  const customers = useCustomerStore(); // Instancia o usuario
  const customer = computed(() => customers.customer[0]); // Define o nome do cliente

</script>

<template>
  <section class="grid gap-2">
    <Subtitle :text="'Identificação do cliente'" />

    <div class="grid gap-2">
      <span class="text-lg flex items-end gap-2 font-highlight">
        Nome do cliente: <strong>{{ customer ? customer.name : 'N/A' }}</strong>
      </span>

      <span class="text-sm opacity-80">
        O painel exibirá este nome quando seu pedido estiver pronto para retirada.
      </span>
    </div>

  </section>
</template>

<script lang="ts">
  export default {
    name: 'CustomerIdentificationSection'
  }
</script>