<!-- resources/js/App.vue -->
<template>
  <div class="w-auto max-w-4xl mx-auto px-4">
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