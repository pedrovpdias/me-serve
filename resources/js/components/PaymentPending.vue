<script setup lang="ts">
  import Subtitle from '../components/Subtitle.vue'; // Importa o sub-título
  import QRCodeVue from 'qrcode.vue'; // Importa o QRCodeVue

  import { ref, onMounted } from 'vue'; // Importa as bibliotecas do Vue

  import loader from '../../images/loader.svg'; // Importa o loader

  const pixCode = ref(''); // Define o pixCode como vazio
  const qrCodeUrl = ref(''); // Define o qrCodeUrl como vazio

  // Recebe a forma de pagamento como parâmetro
  const { paymentMethod } = defineProps<{
    paymentMethod: string 
  }>();

  onMounted(() => {
    // Se a forma de pagamento for 'pix', chama a função para gerar o pix
    if (paymentMethod === 'pix') {
      generatePix();
    }
  });

  // Função para gerar o pix
  function generatePix() {
    // Aqui você simula um código Pix qualquer
    pixCode.value = '00020126360014BR.GOV.BCB.PIX0114+5511999999995204000053039865802BR5925.SIMULA_PAGAMENTO_MESERVE6009BR.MG.PASSOS62070503***6304ABCD';
    
    // Para gerar o QR Code, pode usar um serviço tipo Google Charts
    qrCodeUrl.value = `https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl=${encodeURIComponent(pixCode.value)}`;
  }
</script>


<template>
  <section class="grid gap-4 items-center">
    <div>
      <div class="flex items-center gap-4">
        <Subtitle :text="'Aguardando pagamento'" />

        <span class="animate-spin size-4 grid place-content-center aspect-square flex-none">
          <img :src="loader" alt="Loading" />
        </span>
      </div>

      <p v-if="paymentMethod === 'pix'" class="text-sm opacity-80">
        Escaneie o QR Code para pagar com Pix:
      </p>

      <p v-else class="text-sm opacity-80">
        Finalize o pagamento no terminal.
      </p>
    </div>

    <div v-if="paymentMethod === 'pix'" class="grid gap-4">
      <div class="justify-self-center size-fit aspect-square flex-none ">
        <QRCodeVue :value="pixCode" :size="300" />
      </div>

      <div class="grid gap-2">
        <label for="qr-code" class="font-semibold">
          Código Pix:
        </label>

        <textarea id="qr-code" rows="2" readonly class="bg-secondary/50 rounded-lg text-sm resize-none shadow-inner w-full z-0 outline-none p-4" v-model="pixCode"></textarea>
      </div>
    </div>
  </section>
</template>

<script lang="ts">
  export default {
    name: 'PaymentPending'
  }
</script>