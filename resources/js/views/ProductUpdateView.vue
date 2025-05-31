<script setup lang="ts">
  import AdminHeader from '../components/AdminHeader.vue'; // Importa o AdminHeader
  import Title from '../components/Title.vue'; // Importa o título
  import ToastError from '../components/ToastError.vue'; // Importa o toast de erro
  import ToastSuccess from '../components/ToastSuccess.vue'; // Importa o toast de sucesso
  import DefaultButton from '../components/DefaultButton.vue'; // Importa o botão padrão

  import { computed, onMounted, ref } from 'vue'; // Importa as bibliotecas do Vue

  import { useRoute } from 'vue-router'; // Importa o router

  import axios from 'axios'; // Importa o axios

  const $route = useRoute(); // Instancia o router
  const id = $route.params.orderId; // Recebe o id do pedido como parâmetro da rota

  const toastErrorRef = ref<InstanceType<typeof ToastError> | null>(null); // Instancia o toast de erro
  const errorMessage = ref(''); // Para exibir mensagens de erro
  const toastSuccessRef = ref<InstanceType<typeof ToastSuccess> | null>(null); // Instancia o toast de sucesso
  const successMessage = ref(''); // Para exibir mensagens de sucesso

  const categories = ref<any[]>([]);

  const file = ref<any>([]);

  const URL = computed(() => window.URL);

  const breadcrumbLinks = [
    {
      name: 'Dashboard' as string,
      path: '/admin' as string,
    },
    {
      name: 'Produtos' as string,
      path: '/admin/products' as string,
    },
    {
      name: 'Detalhes' as string,
      path: `/admin/products/${id}` as string,
    },
  ];

  async function handleSubmit() {
    console.log('ProductUpdateView handleSubmit');
  }

  async function handleDelete() {
    console.log('ProductUpdateView handleDelete');
  }

  async function handleFileChange() {
    const fileInput = document.getElementById('file') as HTMLInputElement;
    file.value = fileInput.files ? fileInput.files[0] : '';
    console.log(file.value);
  }

  async function getCategories() {
    const { data } = await axios.get('/api/categories');
    categories.value = data;
  }

  async function updateUploadButtonText() {
    console.log(file.value);
  }

  onMounted(() => {
    getCategories();
  })
</script>

<template>
  <main class="flex flex-col gap-8 relative md:w-auto md:flex-1 md:max-w-4xl mx-auto bg-white shadow-xl py-4 min-h-screen">
    <AdminHeader :breadcrumbLinks="breadcrumbLinks" />

    <ToastError ref="toastErrorRef" />
    <ToastSuccess ref="toastSuccessRef" />

    <div class="flex flex-col gap-8 px-8">
      <Title :text="'Nome do produto'" />

      <form @submit.prevent="handleSubmit" class="flex flex-col gap-4">
        <div class="flex flex-col gap-2">
          <label for="name" class="text-sm font-semibold">
            Nome
          </label>

          <input 
            type="text" 
            placeholder="Digite o nome do produto" 
            id="name" name="name"
            class="border border-primary/20 rounded-lg px-4 py-2 focus:border-red-600/50 focus:outline-1 focus:outline-red-600/30"
            autocomplete="off"
          />
        </div>        

        <div class="flex flex-col gap-2">
          <label for="description" class="text-sm font-semibold">
            Descrição
          </label>

          <textarea 
            placeholder="Digite a descrição do produto" 
            id="description" name="description"
            class="border border-primary/20 rounded-lg px-4 py-2 focus:border-red-600/50 focus:outline-1 focus:outline-red-600/30"
            autocomplete="off"
          ></textarea>
        </div>

        <div class="flex flex-col gap-2">
          <label for="price" class="text-sm font-semibold">
            Preço
          </label>

          <input 
            type="text" 
            placeholder="Digite o preco do produto" 
            id="price" name="price"
            class="border border-primary/20 rounded-lg px-4 py-2 focus:border-red-600/50 focus:outline-1 focus:outline-red-600/30"
            autocomplete="off"
          />
        </div>

        <div class="flex flex-col gap-2">
          <label for="category" class="text-sm font-semibold">
            Categoria
          </label>

          <select 
            id="category" name="category"
            class="border border-primary/20 rounded-lg px-4 py-2 focus:border-red-600/50 focus:outline-1 focus:outline-red-600/30"
            autocomplete="off"
          >
            <option v-for="category in categories" :value="category.id" :key="category.id">
              {{ category.name }}
            </option>
          </select>
        </div>

        <div>
          <label 
            for="file" 
            class="grig w-full h-auto border border-dashed border-primary/20 rounded-lg flex items-center justify-center"
          >
            <span v-if="file.length === 0" class="text-sm font-semibold grid place-items-center gap-2 cursor-pointer p-4">
              <i class="bi bi-upload text-2xl"></i>

              Selecione a imagem do produto
            </span>

            <span v-else class="text-sm font-semibold grid place-items-center gap-2 cursor-pointer p-4">
              <img :src="URL.createObjectURL(file)" class="w-full h-auto" />
            </span>

            <input 
              type="file" 
              id="file" 
              @change="handleFileChange" 
              class="hidden"
              accept="image/*"
              autocomplete="off"
            />
          </label>

          
        </div>

        <DefaultButton :text="'Atualizar'" :event="handleSubmit"/>
      </form>
    </div>
  </main>
</template>