<script setup lang="ts">
  import Subtitle from './Subtitle.vue'; // Importa o sub-título

  import { useCartStore } from '../stores/userCartStore'; // Importa o carrinho

  const cart = useCartStore(); // Instancia o carrinho

  const emit = defineEmits(['payment-method-changed']); // Define o evento a ser emitido

  // Função para emitir o evento de mudança de forma de pagamento
  function emitPaymentMethod(event: Event) {
    const target = event.target as HTMLInputElement;
    emit('payment-method-changed', target.value);
  }

</script>

<template>
  <section class="grid gap-2">
    <Subtitle :text="'Forma de pagamento'" />

    <span class="text-sm opacity-80">
      Selecione uma das formas de pagamento abaixo para finalizar o pedido.
    </span>

    <ul class="w-full grid gap-4">
      <li class="flex w-full no-wrap gap-8 border-b border-primary/5 pb-4">
        <div class="grid w-full gap-0 flex-1">
          <label for="pix" class="text-lg font-bold font-highlight flex items-center gap-2">                  
            <input type="radio" name="payment" id="pix" value="pix" class="accent-red-600" @change="emitPaymentMethod">

            Pix
          </label >
        </div>

        <span class="text-sm font-bold text-lg pt-2">
          R$ {{ cart.total.toFixed(2) }}
        </span>
      </li>

      <li class="flex w-full no-wrap gap-8 border-b border-primary/5 pb-4">
        <div class="grid w-full gap-0 flex-1">
          <label for="credit" class="text-lg font-bold font-highlight flex items-center gap-2">
            <input type="radio" name="payment" id="credit" value="credit" class="accent-red-600" @change="emitPaymentMethod">
            Cartão de crédito
          </label >
        </div>

        <span class="text-sm font-bold text-lg pt-2">
          R$ {{ cart.total.toFixed(2) }}
        </span>
      </li>

      <li class="flex w-full no-wrap gap-8 border-b border-primary/5 pb-4">
        <div class="grid w-full gap-0 flex-1">
          <label for="debit" class="text-lg font-bold font-highlight flex items-center gap-2">
            <input type="radio" name="payment" id="debit" value="debit" class="accent-red-600" @change="emitPaymentMethod">

            Cartão de debito
          </label >
        </div>

        <span class="text-sm font-bold text-lg pt-2">
          R$ {{ cart.total.toFixed(2) }}
        </span>
      </li>
    </ul>
  </section>
</template>

<script lang="ts">
  export default {
    name: 'PaymentMethod'
  }
</script>