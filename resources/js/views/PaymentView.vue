<script setup lang="ts">
  import Navbar from '../components/Navbar.vue'; // Importa o navbar
  import Title from '../components/Title.vue'; // Importa o título
  import Subtitle from '../components/Subtitle.vue'; // Importa o sub-título
  import DefaultButton from '../components/DefaultButton.vue'; // Importa o botão padrão
  import ProductThumbnail from '../components/ProductThumbnail.vue'; // Importa o card de produto
  import EmptyCartMessage from '../components/EmptyCartMessage.vue'; // Importa a mensagem de carrinho vazio

  import { useCustomerStore } from '../stores/customerStore'; // Importa o usuario

  import { useCartStore } from '../stores/userCartStore'; // Importa o carrinho
  import { computed } from 'vue'; // Importa as bibliotecas do Vue

  const customers = useCustomerStore(); // Instancia o usuario
  const customer = computed(() => customers.customer[0]);

  const cart = useCartStore(); // Instancia o carrinho
  const products = computed(() => cart.items); // Itens do carrinho

  const hasItems = computed(() => cart.items.length > 0); // Verifica se há itens no carrinho
  let btnDisabled = computed(() => !hasItems.value);
  
</script>

<template>
  <div class="grid gap-8 relative">
    <Navbar />

    <main class="grid gap-8">
      <Title :text="'Confirmar pedido'" />

      <div class="grid gap-2">
        <Subtitle :text="'Identificação do cliente'" />

        <div class="grid gap-2">
          <span class="text-lg flex items-end gap-2 font-highlight">
            Nome do cliente: <strong>{{ customer.name }}</strong>
          </span>

          <span class="text-sm opacity-80">
            O painel exibirá este nome quando seu pedido estiver pronto para retirada.
          </span>
        </div>

      </div>

      <div class="grid gap-4">
        <div class="grid gap-2">
          <div class="w-full flex items-end justify-between">
            <Subtitle :text="'Itens do pedido'" /> 

            <button @click="$router.push('/cart')" class="group flex items-center gap-2 text-sm text-red-600 hover:text-red-800">
              <i class="bi bi-bag"></i>

              <span class="group-hover:underline">
                Alterar o pedido
              </span>
            </button>
          </div>

          <ul v-if="hasItems" class="w-full grid gap-4">
            <li v-for="product in products" :key="product.id" class="flex w-full no-wrap gap-8 border-b border-primary/5 pb-4">
              <ProductThumbnail :product="product" />

              <div class="grid w-full gap-0 flex-1">
                <h3 class="text-lg font-bold font-highlight flex items-end">                  
                  {{ product.quantity > 1 ? `${product.quantity} x` : '' }}
                  {{ product.name }}
                </h3>

                <span class="text-sm font-bold text-lg pt-2">
                  R$ {{ ( product.price * product.quantity ).toFixed(2) }}
                </span>
              </div>
            </li>
          </ul>

          <EmptyCartMessage v-else />

          <span class="text-right font-bold text-xl">
            Total: R$ {{ cart.total.toFixed(2) }}
          </span>
        </div>

        <div class="grid gap-2">
          <Subtitle :text="'Forma de pagamento'" /> 

          <ul class="w-full grid gap-4">
            <li class="flex w-full no-wrap gap-8 border-b border-primary/5 pb-4">
            </li>
          </ul>
        </div>

        <div class="grid gap-4 justify-end">
          <DefaultButton :text="'Finalizar pedido'" :disabled="btnDisabled" :event="'/checkout'" />

          <p class="text-sm opacity-80">
            Ao finalizar o pedido você concorda com os termos de uso e política de privacidade.
          </p>
        </div>
      </div>
    </main>
  </div>
</template>

<script lang="ts">
export default {
  name: 'PaymentView'
}
</script>