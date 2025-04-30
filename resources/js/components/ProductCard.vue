<script setup lang="ts">
  import { useCartStore } from '../stores/userCartStore'; // Importa o carrinho
  import DefaultButton from './DefaultButton.vue'; // Importa o botão padrão
  import CartToast from '../components/CartToast.vue'; // Importa o toast executado ao adicionar um produto ao carrinho

  import { ref } from 'vue'; // Importa as bibliotecas do Vue

  const cart = useCartStore(); // Instancia o carrinho

  const showToast = ref(false);
  const productName = ref('');

  // Adiciona o produto ao carrinho
  function addToCart(product: any) {
    cart.addItem(product); // Adiciona o produto ao carrinho

    productName.value = product.name; // Armazena o nome do produto
    showToast.value = true; // Exibe o toast

    // Toast desaparece depois de 2 segundos
    setTimeout(() => {
      showToast.value = false;
    }, 2000);
  }

  // Recebe o produto
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
      <img :src="product.thumbnail" :alt="product.name" class="w-auto h-full max-h-72 md:max-h-80" loading="lazy" />
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
            <i class="bi bi-plus-circle text-sm pointer-events-none"></i>
          </template>
        </DefaultButton>
      </div>
    </div>
  </div>

  <CartToast :visible="showToast" :productName="productName" @close="showToast = false" />
</template>


<script lang="ts">
  export default {
    name: 'ProductCard'
  }
</script>