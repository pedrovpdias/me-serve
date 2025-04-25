<script setup lang="ts">
  import { useCartStore } from '../stores/userCartStore'; // Importa o carrinho

  import logo from '../../images/logo_hr.svg';

  import { computed } from 'vue';

  const cart = useCartStore(); // Instancia o carrinho

  const hasItems = computed(() => cart.items.length > 0);

</script>

<template>
  <footer v-if="hasItems" class="grid grid-cols-2 p-8 sticky bottom-4 w-auto rounded-xl shadow-xl bg-secondary mx-3 border border-black/5">
    <h2 class="text-2xl font-red-600 font-black font-highlight col-span-2">
      Carrinho
    </h2>

    <span>
      {{ cart.items.length }} {{ cart.items.length === 1 ? 'item' : 'itens' }}
    </span>

    <span class="text-right font-bold text-xl">
      Total: R$ {{ cart.total.toFixed(2) }}
    </span>

    <div class="col-span-2 flex justify-between pt-8">
      <img :src="logo" alt="Logo" class="w-1/6 h-auto justify-self-start" tabindex="-1">

      <div class="flex justify-end">
        <button
          @click="$router.push('/cart')"
          class="flex gap-2 items-center w-fit rounded-full py-2 px-4 font-bold bg-linear-to-tr from-amber-400 to-amber-500 text-white hover:from-amber-500 hover:to-amber-600 focus:from-amber-500 focus:to-amber-600 outline-none"
        >
          Finalizar pedido

          <i class="bi bi-check-circle"></i>
        </button>
      </div>
    </div>

  </footer>
</template>

<script lang="ts">
  export default {
    name: 'HomeFooter'
  }
</script>