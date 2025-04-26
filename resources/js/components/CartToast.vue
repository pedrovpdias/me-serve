<script setup lang="ts">
  defineProps<{
    visible: boolean;
    productName: string;
  }>();

  const emit = defineEmits(['close']);
</script>

<template>
  <div
    v-if="visible"
    class="fixed bottom-4 right-4 bg-white shadow rounded-lg px-6 py-4 flex items-center gap-4 z-50 overflow-hidden border border-black/10"
  >
    <div class="text-red-600 text-xl relative before:content-[''] before:absolute before:-top-6 before:-bottom-6 before:-left-6 before:w-1 before:h-auto before:bg-red-600">
      <i class="bi bi-bag-check-fill"></i>
    </div>

    <div class="grid gap-0 relative">
      <span class="font-bold">
        Adicionado ao pedido!
      </span>

      <span class="text-sm">
        {{ productName }}
      </span>
    </div>

    <button
      @click="emit('close')"
      class="ml-auto -mr-2 grid place-content-center rounded-full size-6 border border-transparent hover:border-primary/20 hover:shadow-inner"
    >
      &times;
    </button>

  </div>
</template>

<script lang="ts">
  export default {
    name: 'CartToast'
  }
</script>