<script setup lang="ts">
  import Subtitle  from './Subtitle.vue'; // Importa o sub-título
</script>

<template>
  <section class="flex flex-col w-full gap-4">
    <div>
      <Subtitle :text="'Pagamento aprovado!'" />

      <p class="text-sm opacity-80">
        Seu pagamento foi aprovado com sucesso!
      </p>
    </div>

    <p>
      Aguarde alguns instantes enquanto finalizamos seu pedido.
    </p>

    <span class="text-6xl text-green-500 self-center py-8">
      <i class="bi bi-check-circle"></i>
    </span>

    <div class="grid justify-center">
      <span class="text-sm">
        Obrigado pela preferência e volte sempre!
      </span>

      <span class="text-center text-2xl text-amber-500">
        <i class="bi bi-emoji-smile"></i>
      </span>
    </div>

  </section>
</template>

<script lang="ts">
  export default {
    name: 'PaymentSuccess'
  }
</script>