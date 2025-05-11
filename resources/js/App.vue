<!-- resources/js/App.vue -->
<template>
  <div class="min-h-screen">
    <RouterView />
  </div>
</template>

<script setup lang="ts">
  import { onMounted } from 'vue';
  import { useAuthStore } from './stores/authStore';
  const auth = useAuthStore();

  // Remove o carrinho ao fechar a página
  window.addEventListener('beforeunload', () => {
    localStorage.removeItem('cart');
  });

  // Remove o foco dos botões
  window.addEventListener('click', e => { 
    const target = e.target as HTMLElement;
    if (target.tagName === 'BUTTON') {
      target.blur();
    }
  });

  // Restaura o usuário do localStorage
  onMounted(() => {
    auth.initialize(); // Restaura o usuário do localStorage
  });
</script>