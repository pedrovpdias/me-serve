// router/index.ts
import { createRouter, createWebHistory } from 'vue-router'; // Importa o Vue Router

// Importa as views públicas
import HomeView from '@/views/HomeView.vue'; // Importa a view Home
import MenuView from '@/views/MenuView.vue'; // Importa a view Menu
import CartView from '@/views/CartView.vue'; // Importa a view Cart
import CheckoutView from '@/views/CheckoutView.vue'; // Importa a view Checkout
import PaymentView from '@/views/PaymentView.vue'; // Importa a view Payment

// Importa as views privadas
import DashboardView from '@/views/DashboardView.vue';
import LoginView from '@/views/LoginView.vue';

// Cria o roteador
const router = createRouter({
  history: createWebHistory(),
  routes: [
    // Rotas públicas
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

    // Rotas de autenticação
    {
      path: '/login',
      name: 'login',
      component: LoginView,
      meta: {
        guest: true
      }
    },
    
    // Rotas privadas
    {
      path: '/admin',
      name: 'admin',
      component: DashboardView,
      meta: {
        requiresAuth: true
      }
    }
  ],
});

// Middleware para verificar autenticação
router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !localStorage.getItem('authToken')) {
    next('/login');
  } else {
    next();
  }
});

export default router; // Exporta o roteador