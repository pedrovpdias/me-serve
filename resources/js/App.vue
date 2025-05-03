<!-- resources/js/App.vue -->
<template>
  <div class="min-h-screen">
    <RouterView />
  </div>
</template>

<script setup lang="ts">
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
</script>