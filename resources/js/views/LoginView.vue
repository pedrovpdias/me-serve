<script setup lang="ts">
  import Title from '../components/Title.vue';
  import DefaultButton from '../components/DefaultButton.vue';
  import ToastError from '../components/ToastError.vue';

  import background from '../../images/restaurant_facade.png';

  import logo from '../../images/logo.svg';

  const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
  const csrfToken = csrfTokenMeta?.getAttribute('content') ?? '';
  
</script>

<template>
  <main class="grid place-content-center h-screen w-full relative after:absolute after:top-0 after:left-0 after:content-[''] after:w-full after:h-screen after:bg-black/80 after:backdrop-blur-xs after:z-10 after:object-cover after:block">
    <img 
      :src="background" 
      alt="Background" 
      class="w-full h-full absolute top-0 left-0 object-cover z-0" 
      loading="lazy" 
    />

    <ToastError />

    <form class="w-fit shadow border border-primary/20 rounded-xl grid gap-8 grid-cols-2 p-8 grid-flow-dense z-20 bg-white">
      <div class="size-32 row-span-3">
        <img :src="logo" alt="Logo" class="w-full" loading="lazy" tabindex="-1" />
      </div>

      <Title :text="'Login'" />

      <input type="hidden" name="_token" :value="csrfToken">

      <div class="grid gap-2 w-fit">
        <label for="email" class="font-semibold">
          E-mail
        </label>

        <label for="email" class="flex items-center border border-primary/20 rounded-lg px-4 py-2 w-80 gap-4 group [&:has(input:focus)]:border-red-600 [&:has(input:focus)]:outline-1 [&:has(input:focus)]:outline-red-600/30">
          <input 
            type="email" 
            placeholder="Digite o seu e-mail" 
            id="email" name="email"
            class="outline-none w-full"
            autocomplete="off"
          />

          <span class="grid place-content-center opacity-30 flex-none group-[&:has(input:focus)]:opacity-100">
            <i class="bi bi-envelope-fill pointer-events-none"></i>
          </span>
        </label>
      </div>

      <div class="w-full flex justify-end">
        <DefaultButton :text="'Continuar'" :event="() => {}" />
      </div>

      <p class="text-sm opacity-80" tabindex="-1">
        Área de acesso exclusivo para funcionários.
      </p>

    </form>
  </main>
</template>