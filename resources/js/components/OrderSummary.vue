<script setup lang="ts">
  import { useCartStore } from '../stores/userCartStore'; // Importa o carrinho
  import Subtitle from './Subtitle.vue'; // Importa o sub-título
  import EmptyCartMessage from './EmptyCartMessage.vue'; // Importa o card de produto
  import DefaultButton from './DefaultButton.vue'; // Importa o botão padrão
  import Anchor from './Anchor.vue'; // Importa o link

  import { computed } from 'vue'; // Importa as bibliotecas do Vue

  const cart = useCartStore(); // Instancia o carrinho
  const products = computed(() => cart.items); // Itens do carrinho

  const hasItems = computed(() => cart.items.length > 0); // Verifica se há itens no carrinho

</script>

<template>
  <section class="grid gap-4 relative">
    <div class="grid gap-4">
      <Subtitle :text="'Resumo do pedido'" />

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

      <EmptyCartMessage v-else />

    </div>

    <div
      v-if="hasItems"
      class="flex justify-between"
    >
      <Anchor
        :text="'Limpar carrinho'"
        :event="() => cart.clearCart()"
      />

      <DefaultButton
        :text="'Fechar pedido'"
        :event="'/payment'"
      />
    </div>

    <Anchor
      v-else
      :text="'Retornar ao cardápio'"
      :event="'/'"
    />
  </section>
</template>

<script lang="ts">
  export default {
    name: 'OrderSummary'
  }
</script>