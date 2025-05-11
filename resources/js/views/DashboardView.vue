<script setup lang="ts">
  import { useAuthStore } from '../stores/authStore';

  import logo from '../../images/logo_hr.svg';

  const auth = localStorage.getItem('authToken') ? useAuthStore() : null;
  console.log(auth.user); 

</script>
<template>
  <main class="grid gap-4 relative px-4 md:px-8 md:w-auto md:flex-1 md:max-w-4xl mx-auto lg:px-4 border">
    <header class="w-full flex justify-between items-center">
      <img :src="logo" alt="Logo" class="w-1/3 md:w-1/5">

      <div class="flex gap-4">
        
      </div>
    </header>
  </main>
</template>