<script setup lang="ts">
  import Navbar from '../components/Navbar.vue'; // Importa o navbar
  import Title from '../components/Title.vue'; // Importa o título
  import Subtitle from '../components/Subtitle.vue'; // Importa o sub-título
  import DefaultButton from '../components/DefaultButton.vue'; // Importa o botão padrão
  import ToastError from '../components/ToastError.vue'; // Importa o toast de erro
  import CustomerIdentificationSection from '../components/CustomerIdentificationSection.vue';
  import OrderConfirmation from '../components/OrderConfirmation.vue';

  import { useCustomerStore } from '../stores/customerStore'; // Importa o usuario

  import { useCartStore } from '../stores/userCartStore'; // Importa o carrinho
  import { computed, ref } from 'vue'; // Importa as bibliotecas do Vue

  import { useRouter } from 'vue-router'; // Importa o router

  const customers = useCustomerStore(); // Instancia o usuario
  const customer = computed(() => customers.customer[0]);

  const cart = useCartStore(); // Instancia o carrinho
  const products = computed(() => cart.items); // Itens do carrinho

  const hasItems = computed(() => cart.items.length > 0); // Verifica se há itens no carrinho
  const hasCustomer = computed(() => customers.customer.length > 0);
  
  //let btnDisabled = computed(() => !hasItems.value);
  let btnDisabled = computed(() => !hasCustomer.value || !hasItems.value);

  // Cria o estado para armazenar a forma de pagamento
  const paymentMethod = ref(''); // Define a forma de pagamento como vazia
  const router = useRouter(); // Instancia o router

  const toastErrorRef = ref<InstanceType<typeof ToastError> | null>(null); // Instancia o toast de erro

  // Função para finalizar pedido e ir para pagamento
  function finishOrder() {
    // Verifica se a forma de pagamento foi selecionada
    if (!paymentMethod.value) {
      toastErrorRef.value?.showToast('Por favor, selecione uma forma de pagamento.'); // Exibe o toast de erro
      return;
    }

    // Redireciona para a tela de pagamento com a forma de pagamento como parâmetro
    router.push({
      name: 'payment',
      params: { 
        paymentMethod: paymentMethod.value 
      }
    });
  }
  
</script>

<template>
  <div class="grid gap-8 relative">
    <Navbar />

    <ToastError ref="toastErrorRef" />

    <main class="grid gap-4">
      <Title :text="'Confirmar pedido'" />

      <CustomerIdentificationSection :customer="customer" />

      <OrderConfirmation :products="products" />

        <div class="grid gap-2">
          <Subtitle :text="'Forma de pagamento'" />

          <span class="text-sm opacity-80">
            Selecione uma das formas de pagamento abaixo para finalizar o pedido.
          </span>

          <ul class="w-full grid gap-4">
            <li class="flex w-full no-wrap gap-8 border-b border-primary/5 pb-4">
              <div class="grid w-full gap-0 flex-1">
                <label for="pix" class="text-lg font-bold font-highlight flex items-center gap-2">                  
                  <input type="radio" name="payment" id="pix" value="pix" class="accent-red-600" v-model="paymentMethod">

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
                  <input type="radio" name="payment" id="credit" value="credit" class="accent-red-600" v-model="paymentMethod">
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
                  <input type="radio" name="payment" id="debit" value="debit" class="accent-red-600" v-model="paymentMethod">

                  Cartão de debito
                </label >
              </div>

              <span class="text-sm font-bold text-lg pt-2">
                R$ {{ cart.total.toFixed(2) }}
              </span>
            </li>
          </ul>
        </div>

        <div class="grid gap-4 justify-end">
          <DefaultButton :text="'Finalizar pedido'" :disabled="btnDisabled" :event="finishOrder" />

          <p class="text-sm opacity-80">
            Ao finalizar o pedido você concorda com os termos de uso e política de privacidade.
          </p>
        </div>
    </main>
  </div>
</template>