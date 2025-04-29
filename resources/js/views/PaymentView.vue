<script setup lang="ts">
  import Navbar from '../components/Navbar.vue'; // Importa o navbar
  import Title from '../components/Title.vue'; // Importa o título
  import Subtitle from '../components/Subtitle.vue'; // Importa o sub-título
  import DefaultButton from '../components/DefaultButton.vue'; // Importa o botão padrão
  import ToastError from '../components/ToastError.vue'; // Importa o toast de erro

  import loader from '../../images/loader.svg'; // Importa o loader

  import { defineProps, ref, onMounted, onUnmounted  } from 'vue'; // Importa as bibliotecas do Vue

  import QRCodeVue from 'qrcode.vue'; // Importa o QRCodeVue

  const status = ref('aguardando'); // 'aguardando' | 'aprovado' | 'recusado'
  const pixCode = ref(''); // Define o pixCode como vazio
  const qrCodeUrl = ref(''); // Define o qrCodeUrl como vazio

  // Recebe a forma de pagamento como parâmetro
  const { paymentMethod } = defineProps<{
    paymentMethod: string 
  }>();


  let verificationInterval: any = null; // Define o intervalo como nulo

  // Quando o componente for montado
  onMounted(() => {
    // Se a forma de pagamento for 'pix', chama a função para gerar o pix
    if (paymentMethod === 'pix') {
      generatePix();
    }
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
        console.error('Erro ao verificar pagamento:', error); // Em caso de erro, talvez mostrar uma mensagem de "Falha na conexão"
      }
    }, 10000);
  }

  // Função para realizar uma nova tentativa de pagamento
  function tryNewPayment() {
    status.value = 'aguardando'; // Define o status como 'aguardando'

    startWaitingPayment(); // Inicia a verificação do pagamento
  }

  // Função para gerar o pix
  function generatePix() {
    // Aqui você simula um código Pix qualquer
    pixCode.value = '00020126360014BR.GOV.BCB.PIX0114+5511999999995204000053039865802BR5925.SIMULA_PAGAMENTO_MESERVE6009BR.MG.PASSOS62070503***6304ABCD';
    
    // Para gerar o QR Code, pode usar um serviço tipo Google Charts
    qrCodeUrl.value = `https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl=${encodeURIComponent(pixCode.value)}`;
  }

</script>

<template>
  <main class="grid gap-4 relative">
    <Navbar />

    <ToastError ref="toastErrorRef" />

    <Title :text="'Pagamento'" />

    <section class="grid">
      <div v-if="status === 'aguardando'" class="grid gap-4 items-center">
        <div>
          <div class="flex items-center gap-4">
            <Subtitle :text="'Aguardando pagamento'" />

            <span class="animate-spin size-4 grid place-content-center aspect-square flex-none">
              <img :src="loader" alt="Loading" />
            </span>
          </div>

          <p class="text-sm opacity-80">
            Finalize o pagamento no terminal.
          </p>
        </div>

        <div v-if="paymentMethod === 'pix'" class="grid gap-4">
          <span>
            Escaneie o QR Code para pagar com Pix:
          </span>

          <div class="justify-self-center size-fit aspect-square flex-none ">
            <QRCodeVue :value="pixCode" :size="300" />
          </div>

          <div class="grid gap-2">
            <label for="qr-code" class="font-semibold">
              Código Copia e Cola:
            </label>

            <textarea id="qr-code" rows="4" readonly class="bg-secondary/50 rounded-lg text-sm resize-none shadow-inner w-full z-0 outline-none px-4">
              {{ pixCode }}
            </textarea>
          </div>
        </div>
      </div>

      <div v-else-if="status === 'aprovado'" class="grid gap-4 items-center">
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
      </div>

      <div v-else-if="status === 'recusado'" class="flex flex-col w-full gap-4">
        <div>
          <div class="flex items-center gap-4">
            <Subtitle :text="'Pagamento recusado!'" />

            <span class="text-xl text-red-500">
              <i class="bi bi-x-circle"></i>
            </span>
          </div>

          <p class="text-sm opacity-80">
            Seu pagamento não foi aprovado.
          </p>
        </div>

        <p>
          Tente novamente ou procure um dos nosso atendentes.
        </p>

        <div class="w-fit self-center mt-10">
          <DefaultButton :text="'Tentar novamente'" :event="tryNewPayment">
            <template #icon>
              <i class="bi bi-arrow-counterclockwise"></i>
            </template>
          </DefaultButton>
        </div>
      </div>

    </section>
  </main>
</template>