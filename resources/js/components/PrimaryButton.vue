<script setup lang="ts">
  // Recebe o texto e o evento a ser executado ao clicar no botão
  defineProps<{
    text: string;
    event: string | (() => void);
  }>()

</script>

<template>
  <button
    @click="typeof event === 'function' ? event() : $router.push(event)"
    type="button"
    class="flex flex-none gap-2 items-center w-fit h-fit rounded-full py-2 px-4 font-bold bg-linear-to-tr from-amber-400 to-amber-500 text-white hover:from-amber-500 hover:to-amber-600 focus:from-amber-500 focus:to-amber-600 active:shadow-inner outline-none"
  >
    {{ text }}
  </button>
</template>

<script lang="ts">
  export default {
    name: 'PrimaryButton'
  }
</script>