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
    class="flex flex-none gap-2 items-center w-fit h-fit rounded-full py-2 px-4 font-bold justify-self-end bg-linear-to-tr from-red-500 to-red-600 text-white hover:from-red-600 hover:to-red-700 focus:from-red-600 focus:to-red-700 active:shadow-inner outline-none"
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