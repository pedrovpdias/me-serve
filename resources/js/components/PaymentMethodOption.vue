<script setup lang="ts">
  import { useCartStore } from '../stores/userCartStore'; // Importa o carrinho

  const cart = useCartStore(); // Instancia o carrinho

  const emit = defineEmits(['payment-method-changed']); // Define o evento a ser emitido

  // Função para emitir o evento de mudança de forma de pagamento
  function emitPaymentMethod(event: Event) {
    const target = event.target as HTMLInputElement;
    emit('payment-method-changed', target.value);
  }

  // Recebe o nome e o valor da forma de pagamento
  defineProps<{ 
    name: string, 
    value: string
  }>();

</script>

<template>
  <div class="flex w-full no-wrap gap-8 border-b border-primary/5 pb-4">
    <div class="grid w-full gap-0 flex-1">
      <label for="credit" class="text-lg font-bold font-highlight flex items-center gap-2">
        <input type="radio" name="payment" :id="value" :value="value" class="accent-red-600" @change="emitPaymentMethod">
        
        {{ name }}
      </label >
    </div>

    <span class="text-sm font-bold text-lg pt-2">
      R$ {{ cart.total.toFixed(2) }}
    </span>
  </div>
</template>
  
<script lang="ts">
  export default {
    name: 'PaymentMethodOption'
  }
</script>