<script setup lang="ts">
  import LoginInput from './LoginInput.vue';
  import { defineProps, defineEmits } from 'vue';

  const { input } = defineProps<{
    input: {
      name: string,
      type: string,
      label: string,
      placeholder: string,
      icon: string,
    }
  }>();

  const emit = defineEmits(['update:modelValue']);

  const onInputChange = (event: Event) => {
    const target = event.target as HTMLInputElement;
    emit('update:modelValue', target.value);
  };

</script>

<template>
   <div class="grid gap-2 w-fit">
    <label for="email" class="font-semibold">
      {{ input.label }}
    </label>

    <LoginInput 
      :name="input.name" 
      :type="input.type" 
      :placeholder="input.placeholder" 
      :icon="input.icon" 
      @input="onInputChange"
    />
  </div>
</template>

<script lang="ts">
  export default {
    name: 'LoginInputField'
  }
</script>