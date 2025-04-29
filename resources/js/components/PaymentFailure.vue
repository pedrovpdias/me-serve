<script setup lang="ts">
  import DefaultButton from './DefaultButton.vue'; // Importa o botão padrão

  const emit = defineEmits(['tryNewPayment']); // Define o emit para tentar novamente

  // Função para tentar novamente
  function tryNewPayment() {
    emit('tryNewPayment');
  }

</script>

<template>
  <section class="flex flex-col w-full gap-4">
    <div>
      <Subtitle :text="'Pagamento recusado!'" />

      <p class="text-sm opacity-80">
        Seu pagamento não foi aprovado.
      </p>
    </div>

    <p>
      Tente novamente ou procure um dos nosso atendentes.
    </p>

    <span class="text-6xl text-red-500 self-center py-12">
      <i class="bi bi-x-circle"></i>
    </span>

    <div class="w-fit self-center mt-10">
      <DefaultButton :text="'Tentar novamente'" :event="tryNewPayment">
        <template #icon>
          <i class="bi bi-arrow-counterclockwise"></i>
        </template>
      </DefaultButton>
    </div>
  </section>
</template>

<script lang="ts">
  export default {
    name: 'PaymentFailure'
  }
</script>