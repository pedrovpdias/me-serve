<script setup lang="ts">
  import { useCartStore } from '../stores/userCartStore'; // Importa o carrinho

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
  <div class="rounded-xl shadow bg-white grid overflow-hidden">
    <div class="w-full h-fit mx-auto bg-secondary grid place-items-center rounder-tl-xl rounder-tr-xl p-4">
      <img :src="product.thumbnail" :alt="product.name" class="w-auto h-80" />
    </div>
    
    <div class="py-4 px-8 grid gap-1">
      <div class="grid">
        <h3 class="text-2xl font-black font-highlight">
          {{ product.name }}
        </h3>

        <p class="text-sm">
          {{ product.description }}
        </p>

        <span class="text-lg">
          R$ {{ product.price }}
        </span>
      </div>
      
      <button 
        @click="addToCart(product)" 
        type="button"
        class="flex items-center gap-2 py-2 px-4 mb-4 w-fit rounded-full font-bold justify-self-end bg-linear-to-tr from-red-500 to-red-600 text-white hover:from-red-700 hover:to-red-800 focus:from-red-700 focus:to-red-800 outline-none"
      >
        <i class="bi bi-plus-circle"></i>

        Adicionar
      </button>
    </div>
  </div>
</template>


<script lang="ts">
  export default {
    name: 'ProductCard'
  }
</script>