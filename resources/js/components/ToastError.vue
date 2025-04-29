<script setup lang="ts">
  import { ref } from 'vue'; // Importa as bibliotecas do Vue

  const visible = ref(false); // Define a visibilidade do toast como false
  const message = ref(''); // Define a mensagem como vazia

  // Função para exibir o toast
  function showToast(msg: string, duration = 3000) {
    message.value = msg; // Define a mensagem
    visible.value = true; // Define a visibilidade como true

    setTimeout(() => {
      visible.value = false; // Define a visibilidade como false
    }, duration);
  }

  // Expõe função para ser usada de fora do componente
  defineExpose({ showToast });
</script>

<template>
  <div 
    v-if="visible" 
    class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 px-4 py-2 rounded-lg shadow-lg border border-black/5 flex items-start gap-4 bg-white text-sm"
  >
    <div class="text-red-600">
      <i class="bi bi-x-circle-fill"></i>
    </div>  

    {{ message }}
  </div>
</template>

<script lang="ts">
  export default {
    name: 'ToastError'
  }
</script>