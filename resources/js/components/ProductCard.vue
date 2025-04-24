<script setup lang="ts">
  defineProps<{
    product: { 
      id: number, 
      name: string, 
      price: number, 
      thumbnail: string 
      }
    }>();
</script>


<template>
  <div class="rounded-xl shadow bg-white grid overflow-hidden">
    <div class="w-full mx-auto bg-secondary grid place-items-center rounder-tl-xl rounder-tr-xl p-4">
      <img :src="product.thumbnail" alt="product" class="w-auto h-80" />
    </div>
    
    <div class="py-4 px-8 grid">
      <div class="grid">
        <h2 class="text-2xl font-black font-highlight">
          {{ product.name }}
        </h2>

        <span class="text-lg">
          R$ {{ product.price }}
        </span>
      </div>
      
      <button 
        @click="$emit('adicionar', product)" 
        class="bg-linear-to-tr from-red-500 to-red-600 text-white py-2 px-4 mb-4 w-fit rounded-full font-bold justify-self-end hover:from-red-700 hover:to-red-800 focus:from-red-700 focus:to-red-800 outline-none"
      >
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