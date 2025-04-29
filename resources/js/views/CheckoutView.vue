<script setup lang="ts">
  import Navbar from '../components/Navbar.vue'; // Importa o navbar
  import Title from '../components/Title.vue'; // Importa o título
  import CustomerIdentificationSection from '../components/CustomerIdentificationSection.vue'; // Importa a seção de identificação do cliente
  import OrderConfirmation from '../components/OrderConfirmation.vue'; // Importa o resumo do pedido
  import PaymentMethod from '../components/PaymentMethod.vue'; // Importa as formas de pagamento

  import {  ref } from 'vue'; // Importa as bibliotecas do Vue

  // Cria o estado para armazenar a forma de pagamento
  const paymentMethod = ref(''); // Define a forma de pagamento como vazia

  const selectedPaymentMethod = ref(''); // Define a forma de pagamento selecionada como vazia

  // Função para lidar com o evento de mudança na forma de pagamento
  const handlePaymentMethodChange = (newPaymentMethod: string) => {
    paymentMethod.value = newPaymentMethod;
    console.log('Forma de pagamento selecionada:', newPaymentMethod);
  };
  
</script>

<template>
  <div class="grid gap-8 relative">
    <Navbar />

    <main class="grid gap-4">
      <Title :text="'Confirmar pedido'" />

      <CustomerIdentificationSection />

      <OrderConfirmation />

      <PaymentMethod :paymentMethod="selectedPaymentMethod" @payment-method-changed="handlePaymentMethodChange" />

      //
    </main>
  </div>
</template>