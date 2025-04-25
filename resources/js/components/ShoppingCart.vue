<script setup lang="ts">
  import { useCartStore } from '../stores/userCartStore'; // Importa o carrinho

  import { computed } from 'vue';

  const cart = useCartStore(); // Instancia o carrinho
  const products = computed(() => cart.items); // Itens do carrinho

  // Verifica se há itens no carrinho
  const hasItems = computed(() => cart.items.length > 0);

</script>

<template>
  <section class="grid gap-4 relative">
    <h2 class="text-xl font-black font-highlight">
      Itens adicionados
    </h2>

    <ul v-if="hasItems" class="w-full grid gap-4">
      <li
        v-for="product in products" 
        :key="product.id" 
        class="flex w-full no-wrap gap-8 border-b border-primary/5 pb-4"
      >
        <div class="grid place-content-center rounded-lg overflow-hidden w-18 h-fit bg-secondary shadow flex-none p-2">
          <img :src="product.thumbnail" :alt="product.name" class="w-auto h-full">
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

        <span class="grid justify-end w-fit flex-none">
          - +
        </span>
      </li>
    </ul>

    <div v-else class="text-sm grid gap-2">
      Nenhum item foi adicionado ao carrinho.
    </div>

    <div
      v-if="hasItems"
      class="flex justify-end py-4"
    >
      <button
        @click="$router.push('/')"
        class="flex items-center gap-2 font-bold outline-none text-red-600 hover:text-red-800 focus:text-red-800"
      >
        <i class="bi bi-arrow-left-short"></i>

        Continuar comprando
      </button>
    </div>

    <div class="grid gap-4">
      <h2 class="text-xl font-black font-highlight">
        Resumo do pedido
      </h2>

      <ul v-if="hasItems" class="w-full grid gap-2">
        <li
          v-for="product in products" 
          :key="product.id" 
          class="text-sm flex justify-end"
        >
          {{ product.quantity }} x {{ product.name }} = R$ {{ ( product.price * product.quantity ).toFixed(2) }}
        </li>

        <h3 class="text-lg font-bold font-highlight flex justify-end">
          Total: R$ {{ cart.total.toFixed(2) }}
        </h3>
      </ul>

      <div v-else class="text-sm grid gap-2">
        Nenhum item foi adicionado ao carrinho.
      </div>

    </div>

    <div
      v-if="hasItems"
      class="flex justify-between"
    >
      <button
        @click="cart.clearCart()"
        class="text-red-600 underline hover:text-red-800 focus:text-red-800 outline-none cursor-pointer"
      >
        Limpar carrinho
      </button>

      <button
        @click="$router.push('/checkout')"
        class="flex items-center gap-2 py-2 px-4 mb-4 w-fit rounded-full font-bold justify-self-end bg-linear-to-tr from-red-500 to-red-600 text-white hover:from-red-700 hover:to-red-800 focus:from-red-700 focus:to-red-800 outline-none"
      >
        Finalizar compra

        <i class="bi bi-check-circle text-sm"></i>
      </button>
    </div>

    <button
      v-else
      @click="$router.push('/')"
      class="text-red-600 underline hover:text-red-800 focus:text-red-800 outline-none cursor-pointer"
    >
      Retornar ao cardápio
    </button>
  </section>
</template>

<script lang="ts">
  export default {
    name: 'ShoppingCart'
  }
</script>