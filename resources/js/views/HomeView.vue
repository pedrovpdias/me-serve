<script setup lang="ts">
  import Navbar from '../components/Navbar.vue';
  import Title from '../components/Title.vue';
  import Subtitle from '../components/Subtitle.vue';
  import DefaultButton from '../components/DefaultButton.vue';
</script>

<template>
  <main class="grid gap-4 relative">
    <Navbar />

    <section class="grid gap-8">
      <Title :text="'Bem-vindo(a)'" />

      <div class="grid gap-2">
        <span class="">
          Olá, seja bem-vindo(a) ao nosso cardápio virtual!
        </span>

        <span class="">
          Aqui você pode escolher os itens desejados e adicionar ao seu pedido.
        </span>
      </div>

      <div class="grid gap-2">
        <Subtitle :text="'Identificação do cliente'" />

        <div class="grid gap-2">
          <label for="name" class=" font-semibold">
            Nome do cliente
          </label>

          <input 
            type="text" 
            placeholder="Digite o seu nome" 
            id="name" name="name"
            class="border border-primary/20 rounded-lg px-4 py-2 focus:border-red-600/50 focus:outline-1 focus:outline-red-600/30"
            autocomplete="off"
          />

          <span class="text-sm opacity-80">
            O painel exibirá este nome quando seu pedido estiver pronto para retirada.
          </span>
        </div>

        <div class="flex justify-end">
          <DefaultButton :text="'Iniciar pedido'" :event="'/menu'" />
        </div>

      </div>

      <div class="grid justify-center">
        <span class="text-sm">
          Obrigado pela preferência e volte sempre!
        </span>

        <span class="text-center text-2xl text-amber-500">
          <i class="bi bi-emoji-smile"></i>
        </span>
      </div>
    </section>

    
  </main>
</template>