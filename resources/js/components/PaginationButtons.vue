<script setup lang="ts">
  import { defineEmits } from 'vue';

  interface paginationLink {
    url: any | null;
    label: string;
    active: boolean;
  }

  defineProps({
    pagination: {
      type: Object as () => {
        current_page: number;
        last_page: number;
        per_page: number;
        total: number;
        links: paginationLink[];
      },
      required: true,
    },
  });

  const emit = defineEmits(['page-changed']);

  function handleButtonClick(url: string | null) {
    if (url) {
      emit('page-changed', url);
    }
  }
</script>

<template>
  <div class="flex flex-row gap-2 items-center justify-center">
    <button
      v-for="(link, index) in pagination.links"
      :key="index"
      :disabled="link.url === null"
      @click="handleButtonClick(link.url)"
      class="flex items-center gap-2 text-sm font-semibold hover:text-primary/80 focus:text-primary/80 outline-none"
    >
      <span v-html="link.label"></span>
    </button>
  </div>
</template>

<script lang="ts">
  export default {
    name: 'PaginationButtons'
  }
</script>