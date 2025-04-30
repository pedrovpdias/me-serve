<script setup lang="ts">
  import DefaultHeader from '../components/DefaultHeader.vue'; // Importa o DefaultHeader
  import Title from '../components/Title.vue'; // Importa o título
  import ToastError from '../components/ToastError.vue'; // Importa o toast de erro
  import PaymentPending from '../components/PaymentPending.vue'; // Importa a seção de pagamento pendente
  import PaymentSuccess from '../components/PaymentSuccess.vue'; // Importa a seção de pagamento aprovado
  import PaymentFailure from '../components/PaymentFailure.vue'; // Importa a seção de pagamento recusado

  import { defineProps, ref, onMounted, onUnmounted  } from 'vue'; // Importa as bibliotecas do Vue

  const status = ref('aguardando'); // 'aguardando' | 'aprovado' | 'recusado'

  // Recebe a forma de pagamento como parâmetro
  const { paymentMethod } = defineProps<{
    paymentMethod: string 
  }>();


  let verificationInterval: any = null; // Define o intervalo como nulo

  // Quando o componente for montado
  onMounted(() => {
    // Inicia a verificação do pagamento
    startWaitingPayment();
  });

  // Quando o componente for desmontado
  onUnmounted(() => {
    // Para o intervalo de verificação do pagamento
    if (verificationInterval) {
      clearInterval(verificationInterval);
    }
  });

  const toastErrorRef = ref<InstanceType<typeof ToastError> | null>(null); // Instancia o toast de erro

  // Função para iniciar a verificação do pagamento
  function startWaitingPayment() {
    // A cada 3 segundos consulta a API para verificar o pagamento
    verificationInterval = setInterval(async () => {
      try {
        const response = await fetch('/api/payment-status', {
          method: 'GET',
        });
        
        const data = await response.json(); // Pega os dados da resposta

        // Se data.status for 'aprovado' ou 'recusado', para o intervalo
        if (data.status === 'aprovado') {
          status.value = 'aprovado';

          clearInterval(verificationInterval); // Para o intervalo
        } else if (data.status === 'recusado') {
          status.value = 'recusado';

          clearInterval(verificationInterval); // Para o intervalo
        }
        // Se data.status for 'pendente', continua aguardando
      } catch (error) {
        toastErrorRef.value?.showToast(`Erro ao verificar pagamento: ${error}`); // Em caso de erro, talvez mostrar uma mensagem de "Falha na conexão"
      }
    }, 3000);
  }

  // Função para realizar uma nova tentativa de pagamento
  function tryNewPayment() {
    status.value = 'aguardando'; // Define o status como 'aguardando'

    startWaitingPayment(); // Inicia a verificação do pagamento
  }

</script>

<template>
  <main class="grid gap-4 relative px-4 md:px-8">
    <DefaultHeader :previousRoute="'/checkout'" />

    <ToastError ref="toastErrorRef" />

    <Title :text="'Pagamento'" />

    <PaymentPending v-if="status === 'aguardando'" :paymentMethod="paymentMethod" />
      
    <PaymentSuccess v-else-if="status === 'aprovado'" />    

    <PaymentFailure v-else-if="status === 'recusado'" @try-new-payment="tryNewPayment" />

  </main>
</template>