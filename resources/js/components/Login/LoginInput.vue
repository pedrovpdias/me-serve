<script setup lang="ts">
  import { defineProps, defineEmits } from 'vue';

  const { name, type, placeholder, icon } = defineProps<{
    name: string,
    type: string,
    placeholder: string,
    icon: string,
  }>();

  const emit = defineEmits(['input']);

  const handleInput = (event: Event) => {
    emit('input', event);
  };
</script>

<template>
  <label :for="name" class="flex items-center border border-primary/20 rounded-lg px-4 py-2 w-80 gap-4 group [&:has(input:focus)]:border-red-600/50 [&:has(input:focus)]:outline-1 [&:has(input:focus)]:outline-red-600/30">
    <input 
      :type="type" 
      :placeholder="placeholder" 
      :id="name" :name="name"
      class="outline-none w-full focus:text-red-600"
      autocomplete="off"
      @input="handleInput"
    />

    <span class="grid place-content-center opacity-30 flex-none group-[&:has(input:focus)]:opacity-100 group-[&:has(input:focus)]:text-red-600" tabindex="-1">
      <i :class="[icon, 'pointer-events-none']"></i>
    </span>
  </label>
</template>

<script lang="ts">
  export default {
    name: 'LoginInput'
  }
</script>