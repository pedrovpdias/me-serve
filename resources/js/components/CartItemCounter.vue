<script setup lang="ts">
import AddItemButton from './AddItemButton.vue'; // Importa o botão de adicionar itens
import RemoveItemButton from './RemoveItemButton.vue'; // Importa o botão de remover itens

// Recebe o produto
defineProps<{
  product: {
    id: number;
    quantity: number;
  };
}>();
</script>

<template>
  <span class="flex items-center no-wrap justify-end w-full md:w-fit flex-none">
    <RemoveItemButton :product="product" />

    <span class="w-8 h-6 grid place-content-center flex-none">
      {{ product.quantity }}
    </span>

    <AddItemButton :product="product" />
  </span>
</template>

<script lang="ts">
  export default {
    name: 'CartItemCounter'
  }
</script>