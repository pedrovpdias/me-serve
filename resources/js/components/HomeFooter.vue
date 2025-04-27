<script setup lang="ts">
  import { useCartStore } from '../stores/userCartStore'; // Importa o carrinho
  import PrimaryButton from './PrimaryButton.vue'; // Importa o botão primario

  import logo from '../../images/logo_hr.svg'; // Importa a logo

  import { computed } from 'vue'; // Importa as bibliotecas do Vue

  const cart = useCartStore(); // Instancia o carrinho

  const hasItems = computed(() => cart.items.length > 0); // Verifica se há itens no carrinho

  // Soma todos os itens do carrinho
  const cartItens = computed(() => {
    return cart.items.reduce((total, item) => total + item.quantity, 0);
  });

</script>

<template>
  <footer v-if="hasItems" class="grid grid-cols-2 p-8 sticky bottom-4 w-auto -mx-px rounded-xl shadow-xl bg-secondary border border-black/5">
    <h2 class="text-2xl font-red-600 font-black font-highlight col-span-2">
      Carrinho
    </h2>

    <span>
      {{ cartItens }} {{ cartItens === 1 ? 'item' : 'itens' }}
    </span>

    <span class="text-right font-bold text-xl">
      Total: R$ {{ cart.total.toFixed(2) }}
    </span>

    <div class="col-span-2 flex justify-between pt-8">
      <img :src="logo" alt="Logo" class="w-1/6 h-auto justify-self-start" tabindex="-1">

      <div class="flex justify-end">
        <PrimaryButton :text="'Finalizar compra'" :event="'/cart'" />
      </div>
    </div>

  </footer>
</template>

<script lang="ts">
  export default {
    name: 'HomeFooter'
  }
</script>