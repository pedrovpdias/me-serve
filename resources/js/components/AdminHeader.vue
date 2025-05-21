<script setup lang="ts">
  import Breadcrumb from './Breadcrumb.vue'; // Importa o breadcrumb
  import { useAuthStore } from '../stores/authStore'; // Importa o usuario

  import { computed, ref } from 'vue'; // Importa as bibliotecas do Vue

  import logo from '../../images/logo.svg'; // Importa a logo

  const auth = useAuthStore(); // Instancia o usuario
  const user = computed(() => auth.getUser);  // Pega os dados do usuario

  const showLogoutDropdown = ref(false);

  const toggleLogoutDropdown = () => {
    showLogoutDropdown.value = !showLogoutDropdown.value;
  };

  defineProps<{ 
    breadcrumbLinks: { 
      name: string, 
      path: string }[] 
  }>();

</script>

<template>
  <header class="flex w-full flex-col gap-4">
    <div class="w-full flex justify-between items-center px-8 pb-4 border-b border-b-primary/10">
      <router-link to="/admin">
        <img :src="logo" alt="Logo" class="w-16 h-auto">
      </router-link>

      <button class="flex gap-4 items-center text-red-600 font-semibold relative group hover:text-red-800 focus:text-red-800 outline-none" @click="toggleLogoutDropdown()">
        {{ user.name }}

        <span class="size-8 aspect-square grid place-content-center rounded-full bg-red-600 group-hover:bg-red-800 group-focus:bg-red-800 outline-none text-white pointer-events-none">
          <i class="bi bi-person-fill"></i>
        </span>

        <div v-if="showLogoutDropdown" class="absolute top-12 right-0 bg-white shadow rounded-lg px-4 py-2 flex flex-col gap-2 text-sm">
          <button @click="auth.logout()" class="text-red-600 font-semibold flex items-center gap-2 hover:text-red-800 focus:text-red-800 outline-none">
            Sair

            <i class="bi bi-box-arrow-right pointer-events-none"></i>
          </button>
        </div>
      </button>
    </div>

    <Breadcrumb :breadcrumbLinks="breadcrumbLinks" />
  </header>
</template>

<script lang="ts">
  export default {
    name: 'AdminHeader'
  }
</script>