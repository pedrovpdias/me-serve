<script setup lang="ts">
  import Subtitle  from './Subtitle.vue'; // Importa o sub-título
  import { onMounted, ref } from 'vue'; // Importa as bibliotecas do Vue
  import { useRouter } from 'vue-router'; // Importa o router

  import { useCartStore } from '../stores/userCartStore'; // Importa o carrinho

  import { useCustomerStore } from '../stores/customerStore';

  const router = useRouter(); // Instancia o router
  const cart = useCartStore(); // Instancia o carrinho

  const customers = useCustomerStore(); // Instancia o usuario

  const countdown = ref(10); // Define o countdown como 10 segundos

  onMounted(() => {
  // Inicia o countdown
  const interval = setInterval(() => {
    countdown.value--; // Decrementa o countdown

    // Se o countdown for menor ou igual a zero, para o intervalo
    if (countdown.value <= 0) {
      clearInterval(interval);

      // Limpa carrinho e redireciona
      cart.clearCart(); // Limpa o carrinho

      customers.clearName(); // Limpa o usuario

      router.push('/'); // Redireciona para a tela inicial
    }
  }, 1000); // a cada segundo
});
</script>

<template>
  <section class="grid gap-4 items-center">
    <div>
      <div class="flex items-center gap-4">
        <Subtitle :text="'Pagamento aprovado!'" />

        <span class="text-xl text-green-500">
          <i class="bi bi-check-circle"></i>
        </span>
      </div>

      <p class="text-sm opacity-80">
        Seu pagamento foi aprovado com sucesso!
      </p>
    </div>

    <p>
      Aguarde alguns instantes enquanto finalizamos seu pedido.
    </p>

    <p class="text-xl font-highlight font-bold">
      Bom apetite!
    </p>

    <p class="text-sm text-center text-muted-foreground">
      Esta sessão será encerrada em {{ countdown }} segundos...
    </p>
  </section>
</template>

<script lang="ts">
  export default {
    name: 'PaymentSuccess'
  }
</script>