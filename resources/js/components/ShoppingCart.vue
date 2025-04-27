<script setup lang="ts">
  import { useCartStore } from '../stores/userCartStore'; // Importa o carrinho
  import Subtitle from './Subtitle.vue'; // Importa o sub-título
  import EmptyCartMessage from './EmptyCartMessage.vue'; // Importa a mensagem de carrinho vazio
  import BackToMenuAnchor from './BackToMenuAnchor.vue'; // Importa o link para voltar para a home
  import CartItemCounter from './CartItemCounter.vue'; // Importa os botões de adicionar e remover itens & o contador de itens
  import ProductThumbnail from './ProductThumbnail.vue'; // Importa o card de produto

  import { computed } from 'vue'; // Importa as bibliotecas do Vue

  const cart = useCartStore(); // Instancia o carrinho
  const products = computed(() => cart.items); // Itens do carrinho

  const hasItems = computed(() => cart.items.length > 0); // Verifica se há itens no carrinho

</script>

<template>
  <section class="grid gap-4 relative">
    <Subtitle :text="'Itens adicionados'" />

    <ul v-if="hasItems" class="w-full grid gap-4">
      <li
        v-for="product in products" 
        :key="product.id" 
        class="flex w-full no-wrap gap-8 border-b border-primary/5 pb-4"
      >
        <ProductThumbnail :product="product" />

        <div class="grid w-full gap-0 flex-1">
          <h3 class="text-lg font-bold font-highlight">
            {{ product.name }}
          </h3>

          <p class="text-sm opacity-80">
            {{ product.description }}
          </p>

          <span class="text-sm font-bold text-lg pt-2">
            R$ {{ ( product.price * product.quantity ).toFixed(2) }}
          </span>
        </div>

        <CartItemCounter :product="product" />
      </li>
    </ul>

    <EmptyCartMessage v-else />

    <div
      v-if="hasItems"
      class="flex justify-end"
    >
      <BackToMenuAnchor :text="'Continuar comprando'" />
    </div>
  </section>
</template>

<script lang="ts">
  export default {
    name: 'ShoppingCart'
  }
</script>