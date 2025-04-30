<script setup lang="ts">  
  import ProductThumbnail from './ProductThumbnail.vue'; // Importa o card de produto
  import EmptyCartMessage from './EmptyCartMessage.vue'; // Importa a mensagem de carrinho vazio
  import Subtitle from './Subtitle.vue'; // Importa o sub-título

  import { computed } from 'vue'; // Importa as bibliotecas do Vue

  import { useCartStore } from '../stores/userCartStore'; // Importa o carrinho

  const cart = useCartStore(); // Instancia o carrinho
  const products = computed(() => cart.items); // Itens do carrinho

  const hasItems = computed(() => cart.items.length > 0); // Verifica se há itens no carrinho
</script>

<template>
  <section class="grid gap-8 md:gap-4">
    <div class="w-full flex items-end justify-between">
      <Subtitle :text="'Itens do pedido'" /> 

      <button @click="$router.push('/cart')" class="group flex items-center gap-2 text-sm text-red-600 hover:text-red-800">
        <i class="bi bi-bag pointer-events-none"></i>

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
  </section>
</template>

<script lang="ts">
  export default {
    name: 'OrderConfirmation'
  }
</script>