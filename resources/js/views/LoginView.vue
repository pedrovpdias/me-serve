<script setup lang="ts">
  import Title from '../components/Title.vue'; // Importa o título
  import DefaultButton from '../components/DefaultButton.vue'; // Importa o botão padrão
  import ToastError from '../components/ToastError.vue'; // Importa o toast de erro
  import LoginInputField from '../components/Login/LoginInputField.vue'; // Importa o campo de login

  import background from '../../images/restaurant_facade.png'; // Importa o background da tela de login

  import logo from '../../images/logo.svg'; // Importa a logo

  import { ref } from 'vue'; // Importa as bibliotecas do Vue

  import axios from 'axios'; // Importa o axios

  import { useAuthStore } from '../stores/authStore';
  const auth = useAuthStore();

  import { useRouter } from 'vue-router'; // Importa o Vue Router
  const router = useRouter(); // Instancia o Vue Router

  const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]'); // Pega o token CSRF
  const csrfToken = csrfTokenMeta?.getAttribute('content') ?? ''; // Define o CSRF token

  const toastErrorRef = ref<InstanceType<typeof ToastError> | null>(null); // Instancia o toast de erro

  // Define os inputs
  const inputs = [
    {
      name: 'email',
      label: 'E-mail',
      type: 'email',
      placeholder: 'Digite o seu e-mail',
      icon: 'bi bi-envelope-fill',
    },
    {
      name: 'password',
      label: 'Senha',
      type: 'password',
      placeholder: 'Digite a sua senha',
      icon: 'bi bi-lock-fill',
    },
  ];

  const userVerified = ref(false); // Define o userVerified como false
  const loadingEmailVerification = ref(false); // Define o loadingEmailVerification como false
  const email = ref(''); // Adicione um ref para o e-mail
  const errorMessage = ref(''); // Para exibir mensagens de erro

  const password = ref(''); // Adicione um ref para a senha
  const error = ref(null); // Para exibir mensagens de erro
  const loading = ref(false); // Define o loading como false

  // Função para verificar se o e-mail está cadastrado
  const verifyEmail = async () => {
    loadingEmailVerification.value = true;
    errorMessage.value = ''; // Limpa qualquer mensagem de erro anterior

    try {
      // Realiza a requisição para verificar o e-mail
      const response = await fetch('/api/login/verify-email', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({ email: email.value }),
      });
      
      // Se a resposta for bem-sucedida
      if (response.ok) {
        const data = await response.json(); // Pega os dados da resposta
        if (data.status === 'success') {
          userVerified.value = true; // Define o userVerified como true
        } else {
          errorMessage.value = data.message; // Define a mensagem de erro
          toastErrorRef.value?.showToast(errorMessage.value); // Exibe o toast
        }
      } else {
        errorMessage.value = 'Erro ao verificar o e-mail.'; // Define a mensagem de erro
        toastErrorRef.value?.showToast(errorMessage.value); // Exibe o toast
      }
    } catch (error: any) {
      errorMessage.value = 'Erro de conexão ao verificar o e-mail.'; // Define a mensagem de erro
      toastErrorRef.value?.showToast(errorMessage.value); // Exibe o toast
    } finally {
      loadingEmailVerification.value = false; // Define o loadingEmailVerification como false
    }
  };

  // Função para fazer login
  const login = async () => {
  loading.value = true; // Define o loading como true
  error.value = null; // Limpa qualquer erro anterior

  // Realiza a requisição para fazer login
  try {
    const response = await axios.post('/api/login', {
      email: email.value,
      password: password.value,
    });

    // Se o login for bem-sucedido
    if (response.data.status === 'success') {
      const token = response.data.token; // Pega o token

      auth.setToken(token); // Define o token de autenticação
      auth.setUser(response.data.user); // Define os dados do usuário

      axios.defaults.headers.common['Authorization'] = `Bearer ${token}`; // Define o cabeçalho de autorização

      router.push('/admin'); // Redireciona para a rota de admin
    } else {
      errorMessage.value = response.data.message; // Recebe a mensagem de erro
      toastErrorRef.value?.showToast(errorMessage.value); // Exibe o toast
    }

  } catch (err: any) {
    errorMessage.value = err.response?.data?.message || 'Erro ao fazer login.'; // Define a mensagem de erro
    toastErrorRef.value?.showToast(errorMessage.value); // Exibe o toast
  } finally {
    loading.value = false; // Define o loading como false
  }
};
  
</script>

<template>
  <main class="grid place-content-center h-screen w-full relative after:absolute after:top-0 after:left-0 after:content-[''] after:w-full after:h-screen after:bg-black/80 after:backdrop-blur-xs after:z-10 after:object-cover after:block">
    <img 
      :src="background" 
      alt="Background" 
      class="w-full h-full absolute top-0 left-0 object-cover z-0" 
      loading="lazy" 
    />

    <ToastError ref="toastErrorRef" />

    <section class="w-fit shadow border border-primary/20 rounded-xl grid gap-8 grid-cols-2 p-8 grid-flow-dense z-20 bg-white">
      <div class="size-32 row-span-3">
        <img :src="logo" alt="Logo" class="w-full" loading="lazy" tabindex="-1" />
      </div>

      <Title :text="'Login'" />

      <input type="hidden" name="_token" :value="csrfToken">

      <LoginInputField v-if="!userVerified" :input="inputs[0]" v-model="email" />

      <LoginInputField v-else :input="inputs[1]" v-model="password" />

      <div class="w-full flex justify-end">
        <DefaultButton 
          v-if="userVerified" 
          :text="'Entrar'" 
          :event="login"
          :disabled="loading || !password" 
        />

        <DefaultButton 
          v-else
          :text="loadingEmailVerification ? 'Verificando...' : 'Continuar'"
          :event="verifyEmail"
          :disabled="loadingEmailVerification || !email"
        />
      </div>

      <p class="text-sm opacity-80" tabindex="-1">
        Área de acesso exclusivo para funcionários.
      </p>

    </section>
  </main>
</template>