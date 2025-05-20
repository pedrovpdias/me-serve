<script setup lang="ts">
  import AdminHeader from '../components/AdminHeader.vue'; // Importa o AdminHeader
  import Title from '../components/Title.vue'; // Importa o título
  import ProductThumbnail from '../components/ProductThumbnail.vue'; // Importa o card de produto

  import axios from 'axios'; // Importa o axios

  import { onMounted, ref } from 'vue'; // Importa as bibliotecas do Vue

  import { useRoute } from 'vue-router'; // Importa o router

  const $route = useRoute();
  const id = $route.params.orderId;

  type Product = {
    product_id: number;
    name: string;
    product_description: string;
    unit_price: number;
    quantity: number;
    thumbnail: string;
  };
  
  const order = ref<Product[]>([]);

  const clientName = ref<string>('');
  const createdAt = ref<string>('');
  const total = ref<number>(0);
  const orderStatus = ref<string>('');

  const breadcrumbLinks = [
    {
      name: 'Dashboard' as string,
      path: '/admin' as string,
    },
    {
      name: 'Pedidos' as string,
      path: '/admin/orders' as string,
    },
    {
      name: 'Detalhes' as string,
      path: `/admin/orders/${id}` as string,
    },
  ];

  async function getOrderDetails(id: string) {
    try {
      const { data } = await axios(`/api/orders/${id}`);
      
      if (Array.isArray(data) && data.length > 0) {
        const first = data[0];

        clientName.value = first.client_name;
        createdAt.value = first.created_at;
        total.value = first.total;
        orderStatus.value = first.order_status_description;

        return data;
      } else {
        console.warn('Pedido não encontrado.');
        return [];
      }

    } catch (error) {
      console.error('Erro ao buscar detalhes do pedido:', error);
      throw error; // Lanca o erro para ser tratado no componente
    }
  }

  onMounted(async () => {
    try {
      order.value = await getOrderDetails(id as string);

    } catch (error) {
      console.error('Erro ao buscar detalhes do pedido:', error);
    }
  })
</script>

<template>
  <main class="flex flex-col gap-8 relative md:w-auto md:flex-1 md:max-w-4xl mx-auto bg-white shadow-xl py-4 min-h-screen">
    <AdminHeader :breadcrumbLinks="breadcrumbLinks" />

    <div class="flex flex-col gap-8 px-8">
      <Title :text="`Pedido #${id.toString().padStart(6, '0')}`" />

      <section class="grid gap-8">
        <fieldset class="grid gap-4 border border-primary/10 p-4 rounded-xl">
          <legend class="text-sm opacity-80 px-4">
            Informações do pedido
          </legend>

          <div class="grid">
            <span class="text-sm">
              Nome do cliente
            </span>

            <span class="font-semibold text-lg">
              {{ clientName || '' }}
            </span>
          </div>

          <div class="grid gap-2">
            <span class="text-sm">
              Data do pedido
            </span>

            <span class="font-semibold text-lg">
              {{  createdAt ? createdAt.split('T')[0].split('-').reverse().join('/') : '' }}
            </span>
          </div>
          
          <div class="grid gap-2">
            <span class="text-sm">
              Status do pedido
            </span>

            <span class="font-semibold text-lg">
              {{  orderStatus || '' }}  
            </span>
          </div>
        </fieldset>

        <fieldset class="grid gap-4 border border-primary/10 p-4 rounded-xl">
          <legend class="text-sm opacity-80 px-4">
            Itens do pedido
          </legend>

          <ul v-if="order.length > 0" class="w-full grid gap-4">
            <div class="w-full grid gap-4">
              <li v-for="product in order" :key="product.product_id" class="flex items-start w-full no-wrap gap-8 border-b border-primary/5 pb-4">
                <ProductThumbnail :product="product" />

                <div class="grid w-full gap-0 flex-1">
                  <h3 class="text-lg font-bold font-highlight flex items-end">                  
                    {{ product.quantity > 1 ? `${product.quantity} x` : '' }}
                    {{ product.name }}
                  </h3>

                  <p class="text-sm opacity-80">
                    {{ product.product_description }}
                  </p>
                  
                </div>

                <span class="text-sm font-bold text-lg pt-2">
                  R$ {{ ( product.unit_price * product.quantity ).toFixed(2) }}
                </span>
              </li>

              <h3 class="text-lg font-bold font-highlight flex justify-end">
                Total: R$ {{ total }}
              </h3>
            </div>
          </ul>

          <p v-else class="italic">
            Nenhum item encontrado para este pedido.
          </p>
        </fieldset>
      </section>

    </div>
  </main>
</template>