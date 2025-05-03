<script setup lang="ts">
  import DefaultHeader from '../components/DefaultHeader.vue'; // Importa o DefaultHeader
  import Title from '../components/Title.vue'; // Importa o título
  import CustomerIdentificationSection from '../components/CustomerIdentificationSection.vue'; // Importa a seção de identificação do cliente
  import OrderConfirmation from '../components/OrderConfirmation.vue'; // Importa o resumo do pedido
  import PaymentMethod from '../components/PaymentMethod.vue'; // Importa as formas de pagamento
  import FinishOrderSection from '../components/FinishOrderSection.vue'; // Importa o botão de finalizar pedido

  import {  ref } from 'vue'; // Importa as bibliotecas do Vue

  // Cria o estado para armazenar a forma de pagamento
  const paymentMethod = ref(''); // Define a forma de pagamento como vazia

  // Função para lidar com o evento de mudança na forma de pagamento
  const handlePaymentMethodChange = (newPaymentMethod: string) => {
    paymentMethod.value = newPaymentMethod;
  };
  
</script>

<template>
  <div class="grid gap-4 md:gap-8 relative px-4 md:px-8 md:w-auto md:flex-1 md:max-w-4xl mx-auto lg:px-4">
    <DefaultHeader :previousRoute="'/cart'" />

    <main class="grid gap-8">
      <Title :text="'Confirmar pedido'" />

      <CustomerIdentificationSection />

      <OrderConfirmation />

      <PaymentMethod @payment-method-changed="handlePaymentMethodChange" />

      <FinishOrderSection :paymentMethod="paymentMethod" />
    </main>
  </div>
</template>