<script setup lang="ts">
  import { useRouter } from 'vue-router'; // Importa o Vue Router

  // Recebe o texto e o evento a ser executado ao clicar no botão
  const { text, event, disabled = false } = defineProps<{
    text: string;
    event: string | (() => void);
    disabled?: boolean;
  }>();
  
  const router = useRouter(); // Instancia o Vue Router

  // Função para tratar o clique
  function handleClick() {
    if (disabled) return; // Se estiver desabilitado, não faz nada

    if (typeof event === 'function') {
      event();
    } else {
      router.push(event);
    }
  }

</script>

<template>
  <button
    @click="handleClick"
    type="button"
    :disabled="disabled"
    :class="[
      'flex flex-none gap-2 items-center w-fit h-fit rounded-full py-2 px-4 font-bold justify-self-end bg-linear-to-tr from-red-500 to-red-600 text-white outline-none',
      disabled 
        ? 'opacity-50 cursor-not-allowed' 
        : 'hover:from-red-600 hover:to-red-700 focus:from-red-600 focus:to-red-700 active:shadow-inner'
    ]"
  >
    {{ text }}

    <slot name="icon" />
  </button>
</template>

<script lang="ts">
  export default {
    name: 'DefaultButton'
  }
</script>