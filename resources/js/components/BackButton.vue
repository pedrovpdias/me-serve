<script setup lang="ts">
  defineProps<{
    path: string;
  }>();

</script>

<template>
  <button
    id="cart-button"
    @click="$router.push(path)"
    class="grid place-content-center relative shadow text-red-600 rounded-full w-12 h-12 outline-none bg-white hover:brightness-90 focus:brightness-90 active:shadow-inner"
  >

    <i class="bi bi-chevron-left"></i>
  </button>
</template>

<script lang="ts">
export default {
  name: 'BackButton'
}
</script>