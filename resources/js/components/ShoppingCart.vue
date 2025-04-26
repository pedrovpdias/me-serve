<script setup lang="ts">
  import { useCartStore } from '../stores/userCartStore'; // Importa o carrinho
  import Subtitle from './Subtitle.vue';
  import EmptyCartMessage from './EmptyCartMessage.vue';
  import BackHomeAnchor from './BackHomeAnchor.vue';
  import CartItemCounter from './CartItemCounter.vue';

  import { computed } from 'vue';

  const cart = useCartStore(); // Instancia o carrinho
  const products = computed(() => cart.items); // Itens do carrinho

  // Verifica se há itens no carrinho
  const hasItems = computed(() => cart.items.length > 0);

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
        <div class="grid place-content-center rounded-lg overflow-hidden size-18 aspect-square flex-none bg-secondary shadow flex-none p-2">
          <img :src="product.thumbnail" :alt="product.name" class="w-auto h-full max-h-16" loading="lazy">
        </div>

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
      <BackHomeAnchor :text="'Continuar comprando'" />
    </div>
  </section>
</template>

<script lang="ts">
  export default {
    name: 'ShoppingCart'
  }
</script>