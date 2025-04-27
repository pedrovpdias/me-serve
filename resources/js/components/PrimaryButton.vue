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
      'flex flex-none gap-2 items-center w-fit h-fit rounded-full py-2 px-4 font-bold bg-linear-to-tr from-amber-400 to-amber-500 text-white outline-none',
      disabled 
        ? 'opacity-50 cursor-not-allowed' 
        : 'hover:from-amber-500 hover:to-amber-600 focus:from-amber-500 focus:to-amber-600 active:shadow-inner'
    ]"
  >
    {{ text }}
  </button>
</template>

<script lang="ts">
  export default {
    name: 'PrimaryButton'
  }
</script>