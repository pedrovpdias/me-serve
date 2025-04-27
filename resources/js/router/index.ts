// router/index.ts
import { createRouter, createWebHistory } from 'vue-router'; // Importa o Vue Router

// Importar as views
import HomeView from '@/views/HomeView.vue'; // Importa a view Home
import CartView from '@/views/CartView.vue'; // Importa a view Cart
import PaymentView from '@/views/PaymentView.vue'; // Importa a view Payment
import CheckoutView from '@/views/CheckoutView.vue'; // Importa a view Checkout

// Cria o roteador
const router = createRouter({
  history: createWebHistory(),
  routes: [
    // Rotas
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/cart',
      name: 'cart',
      component: CartView,
    },
    {
      path: '/payment',
      name: 'payment',
      component: PaymentView,
    },
    {
      path: '/checkout',
      name: 'checkout',
      component: CheckoutView,
    },
  ],
});

export default router; // Exporta o roteador