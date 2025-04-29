// router/index.ts
import { createRouter, createWebHistory } from 'vue-router'; // Importa o Vue Router

// Importar as views
import HomeView from '@/views/HomeView.vue'; // Importa a view Home
import MenuView from '@/views/MenuView.vue'; // Importa a view Menu
import CartView from '@/views/CartView.vue'; // Importa a view Cart
import CheckoutView from '@/views/CheckoutView.vue'; // Importa a view Checkout
import PaymentView from '@/views/PaymentView.vue'; // Importa a view Payment

// Cria o roteador
const router = createRouter({
  history: createWebHistory(),
  routes: [
    // Rotas
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },{
      path: '/menu',
      name: 'menu',
      component: MenuView,
    },
    {
      path: '/cart',
      name: 'cart',
      component: CartView,
    },
    {
      path: '/checkout',
      name: 'checkout',
      component: CheckoutView,
    },
    {
      path: '/payment/:paymentMethod',
      name: 'payment',
      component: PaymentView,
      props: true,
    },
  ],
});

export default router; // Exporta o roteador