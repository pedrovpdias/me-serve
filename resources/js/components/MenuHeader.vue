<script setup lang="ts">
  import CartButton from './CartButton.vue';
  import BackButton from './BackButton.vue';

  import { ref, onMounted, onUnmounted } from 'vue';

  import background from '../../images/restaurant_facade.png';

  const isCollapsed = ref(false);
  const scrollThreshold = 10;

  const handleScroll = () => {
    isCollapsed.value = window.scrollY > scrollThreshold;
  };

  onMounted(() => {
    window.addEventListener('scroll', handleScroll);
  });

  onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
  });


</script>

<template>
  <header class="h-96 sticky top-0 realtive overflow-hidden">
    <img :src="background" alt="meServe" class="w-full h-auto object-cover absolute top-0 left-0 -z-10">

    <div
      class="absolute top-0 left-0 w-full flex justify-center items-center py-2 bg-black/40 z-0 transition-opacity transition-transform duration-300 ease-in-out h-200"
      :class="{ 'opacity-100 translate-y-0': isCollapsed, 'opacity-0 translate-y-[-100%]': !isCollapsed }"
    ></div>

    <div class="flex items-center h-fit w-full justify-between p-8 z-10">
      <BackButton :path="'/'" />

      <CartButton />
    </div>
  </header>
</template>

<script lang="ts">
  export default {
    name: 'MenuHeader'
  }
</script>