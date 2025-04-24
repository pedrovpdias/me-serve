// router/index.ts
import { createRouter, createWebHistory } from 'vue-router';

// Importar as views
import MenuView from '@/views/MenuView.vue';
import CartView from '@/views/CartView.vue';
import PaymentView from '@/views/PaymentView.vue';
import CheckoutView from '@/views/CheckoutView.vue';


const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      name: 'menu',
      component: MenuView,
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