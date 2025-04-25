// router/index.ts
import { createRouter, createWebHistory } from 'vue-router';

// Importar as views
import HomeView from '@/views/HomeView.vue';
import CartView from '@/views/CartView.vue';
import PaymentView from '@/views/PaymentView.vue';
import CheckoutView from '@/views/CheckoutView.vue';


const router = createRouter({
  history: createWebHistory(),
  routes: [
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

export default router;