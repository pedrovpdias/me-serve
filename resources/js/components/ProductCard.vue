<script setup lang="ts">
  import { useCartStore } from '../stores/userCartStore'; // Importa o carrinho
  import DefaultButton from './DefaultButton.vue';

  const cart = useCartStore(); // Instancia o carrinho

  // Adiciona o produto ao carrinho
  function addToCart(product: any) {
    cart.addItem(product);
  }

  defineProps<{
    product: { 
      id: number, 
      name: string,
      description: string,
      price: number, 
      thumbnail: string 
      }
    }>();
</script>


<template>
  <div class="rounded-xl shadow bg-white flex flex-col overflow-hidden items-start">
    <div class="w-full h-fit aspect-square mx-auto bg-secondary grid place-items-center rounder-tl-xl rounder-tr-xl py-4">
      <img :src="product.thumbnail" :alt="product.name" class="w-auto h-full max-h-80" loading="lazy" />
    </div>
    
    <div class="py-4 px-8 flex gap-2 flex-col justify-between size-full grow">
      <div class="grid gap-2 h-fit">
        <h3 class="text-2xl font-bold font-highlight">
          {{ product.name }}
        </h3>

        <p class="text-sm">
          {{ product.description }}
        </p>

        <span class="text-lg">
          R$ {{ product.price }}
        </span>
      </div>
      
      <div class="flex justify-end w-full">
        <DefaultButton
          :text="'Adicionar'"
          :event="() => addToCart(product)"
        >
          <template #icon>
            <i class="bi bi-plus-circle text-sm"></i>
          </template>
        </DefaultButton>
      </div>
    </div>
  </div>
</template>


<script lang="ts">
  export default {
    name: 'ProductCard'
  }
</script>