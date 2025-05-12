<script setup lang="ts">
  import AdminHeader from '../components/AdminHeader.vue'; // Importa o AdminHeader
  import Title from '../components/Title.vue'; // Importa o título
  import { useAuthStore } from '../stores/authStore'; // Importa o usuario

  import { computed, ref } from 'vue'; // Importa as bibliotecas do Vue

  const auth = useAuthStore(); // Instancia o usuario
  const user = computed(() => auth.getUser);  // Pega os dados do usuario

</script>
<template>
  <main class="flex flex-col gap-8 relative md:w-auto md:flex-1 md:max-w-4xl mx-auto bg-white shadow-xl py-4 min-h-screen">
    <AdminHeader />

    <div class="flex flex-col gap-4 px-8">
      <Title :text="'Dashboard'" />

      <section class="grid gap-4 grid-cols-4">
        <button class="flex flex-col gap-4 py-8 px-2 items-center border border-primary/10 rounded-lg hover:bg-gray-50 focus:bg-gray-50 transition-all active:shadow-inner">
          <span class="text-3xl w-fit mx-auto">
            <i class="bi bi-clipboard2-check-fill"></i>
          </span>
          
          <span class="text-lg">
            Pedidos do dia
          </span>

          <div class="grid text-lg font-highlight">
            <span class="text-3xl font-bold">
              00
            </span>

            pedidos
          </div>
        </button>
        
        <button class="flex flex-col gap-4 py-8 px-2 items-center border border-primary/10 rounded-lg hover:bg-gray-50 focus:bg-gray-50 transition-all active:shadow-inner">
          <span class="text-3xl w-fit mx-auto">
            <i class="bi bi-cash-coin"></i>
          </span>
          
          <span class="text-lg">
            Faturamento
          </span>

          <div class="grid text-lg font-highlight">
            <span class="text-3xl font-bold">
              R$ 00000,00
            </span>

            dd/mm/aaaa
          </div>
        </button>
        
        <button class="flex flex-col gap-4 py-8 px-2 items-center border border-primary/10 rounded-lg hover:bg-gray-50 focus:bg-gray-50 transition-all active:shadow-inner">
          <span class="text-3xl w-fit mx-auto">
            <i class="bi bi-people-fill"></i>
          </span>
          
          <span class="text-lg">
            Clientes atendidos
          </span>

          <div class="grid text-lg font-highlight">
            <span class="text-3xl font-bold">
              00
            </span>

            clientes
          </div>
        </button>
        
        <button class="flex flex-col gap-4 py-8 px-2 items-center border border-primary/10 rounded-lg hover:bg-gray-50 focus:bg-gray-50 transition-all active:shadow-inner">
          <span class="text-3xl w-fit mx-auto">
            <i class="bi bi-box-seam-fill"></i>
          </span>
          
          <span class="text-lg">
            Produtos vendidos
          </span>

          <div class="grid text-lg font-highlight">
            <span class="text-3xl font-bold">
              00
            </span>

            produtos
          </div>
        </button>
      </section>
      
    </div>
  </main>
</template>