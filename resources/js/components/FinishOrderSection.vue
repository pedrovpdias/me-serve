<script setup lang="ts">
  import DefaultButton from './DefaultButton.vue'; // Importa o botão padrão
  import ToastError from './ToastError.vue'; // Importa o toast de erro

  import { useCartStore } from '../stores/userCartStore'; // Importa o carrinho

  import { computed, ref } from 'vue'; // Importa as bibliotecas do Vue

  import { useRouter } from 'vue-router'; // Importa o router

  import { useCustomerStore } from '../stores/customerStore'; // Importa o usuario

  const customers = useCustomerStore(); // Instancia o usuario

  const cart = useCartStore(); // Instancia o carrinho

  const hasItems = computed(() => cart.items.length > 0); // Verifica se há itens no carrinho
  const hasCustomer = computed(() => customers.customer.length > 0);

  const router = useRouter(); // Instancia o router

  const toastErrorRef = ref<InstanceType<typeof ToastError> | null>(null); // Instancia o toast de erro

  //let btnDisabled = computed(() => !hasItems.value);
  let btnDisabled = computed(() => !hasCustomer.value || !hasItems.value);

  // Recebe a forma de pagamento como parâmetro
  const { paymentMethod } = defineProps<{ paymentMethod: string }>();

  // Função para finalizar pedido e ir para pagamento
  function finishOrder() {
    // Verifica se a forma de pagamento foi selecionada
    if (!paymentMethod) {
      toastErrorRef.value?.showToast('Por favor, selecione uma forma de pagamento.'); // Exibe o toast de erro
      return;
    }

  // Redireciona para a tela de pagamento com a forma de pagamento como parâmetro
  router.push({
      name: 'payment',
      params: { 
        paymentMethod: paymentMethod 
      }
    });
  }

</script>

<template>
  <section class="grid gap-4 justify-end">
    <ToastError ref="toastErrorRef" />

    <DefaultButton :text="'Finalizar pedido'" :disabled="btnDisabled" :event="finishOrder" />

    <p class="text-sm opacity-80">
      Ao finalizar o pedido você concorda com os termos de uso e política de privacidade.
    </p>
  </section>
</template>

<script lang="ts">
  export default {
    name: 'FinishOrderSection'
  }
</script>
  