<script setup lang="ts">
  import Subtitle from './Subtitle.vue'; // Importa o sub-título
  import PaymentMethodOption from './PaymentMethodOption.vue'; // Importa a opção de forma de pagamento

  // Lista de opções de forma de pagamento
  const paymentMethods = [
    { 
      name: 'Cartão de crédito', 
      value: 'credit' 
    },
    { 
      name: 'Cartão de debito', 
      value: 'debit' 
    },
    { 
      name: 'Pix', 
      value: 'pix' 
    }
  ];

  const emit = defineEmits(['payment-method-changed']); // Define o evento a ser emitido

  // Função para repassar o evento de mudança na forma de pagamento para <CheckoutView.vue />
  function onPaymentMethodChanged(paymentMethod: string) {
    emit('payment-method-changed', paymentMethod);
  }

</script>

<template>
  <section class="grid gap-2">
    <Subtitle :text="'Forma de pagamento'" />

    <span class="text-sm opacity-80">
      Selecione uma das formas de pagamento abaixo para finalizar o pedido.
    </span>

    <ul class="w-full grid gap-4 py-4">
      <li v-for="paymentMethod in paymentMethods" :key="paymentMethod.value">
        <PaymentMethodOption 
          :name="paymentMethod.name" 
          :value="paymentMethod.value"
          @payment-method-changed="onPaymentMethodChanged"
        />
      </li>
    </ul>
  </section>
</template>

<script lang="ts">
  export default {
    name: 'PaymentMethod'
  }
</script>