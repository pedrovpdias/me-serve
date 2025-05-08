<script setup lang="ts">
  import Title from '../components/Title.vue';
  import DefaultButton from '../components/DefaultButton.vue';
  import ToastError from '../components/ToastError.vue';
  import LoginInputField from '../components/Login/LoginInputField.vue';

  import background from '../../images/restaurant_facade.png';

  import logo from '../../images/logo.svg';

  import { ref } from 'vue';


  import axios from 'axios';

  import { useRouter } from 'vue-router'; // Importa o Vue Router
  const router = useRouter(); // Instancia o Vue Router

  const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
  const csrfToken = csrfTokenMeta?.getAttribute('content') ?? '';

  const toastErrorRef = ref<InstanceType<typeof ToastError> | null>(null);

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

  const userVerified = ref(false);
  const loadingEmailVerification = ref(false);
  const email = ref(''); // Adicione um ref para o e-mail
  const errorMessage = ref(''); // Para exibir mensagens de erro

  const password = ref('');
  const error = ref(null);
  const loading = ref(false);

  // Função para verificar se o e-mail está cadastrado
  const verifyEmail = async () => {
    loadingEmailVerification.value = true;
    errorMessage.value = ''; // Limpa qualquer mensagem de erro anterior

    try {
      const response = await fetch('/api/login/verify-email', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({ email: email.value }),
      });
      
      if (response.ok) {
        const data = await response.json();
        if (data.status === 'success') {
          userVerified.value = true;
        } else {
          errorMessage.value = data.message;
          toastErrorRef.value?.showToast(errorMessage.value);
        }
      } else {
        errorMessage.value = 'Erro ao verificar o e-mail.';
        toastErrorRef.value?.showToast(errorMessage.value);
      }
    } catch (error: any) {
      errorMessage.value = 'Erro de conexão ao verificar o e-mail.';
      toastErrorRef.value?.showToast(errorMessage.value);
    } finally {
      loadingEmailVerification.value = false;
    }
  };

  // Função para fazer login
  const login = async () => {
  loading.value = true;
  error.value = null;
  try {
    const response = await axios.post('/api/login', {
      email: email.value,
      password: password.value,
    });

    const token = response.data.token;
    localStorage.setItem('authToken', token);
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
    router.push('/admin');
  } catch (err) {
    error.value = err.response?.data?.message || 'Erro ao fazer login.';
  } finally {
    loading.value = false;
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