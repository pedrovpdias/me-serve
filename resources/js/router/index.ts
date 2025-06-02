// router/index.ts
import { createRouter, createWebHistory } from 'vue-router'; // Importa o Vue Router

// Importa as views públicas
import HomeView from '@/views/HomeView.vue'; // Importa a view Home
import MenuView from '@/views/MenuView.vue'; // Importa a view Menu
import CartView from '@/views/CartView.vue'; // Importa a view Cart
import CheckoutView from '@/views/CheckoutView.vue'; // Importa a view Checkout
import PaymentView from '@/views/PaymentView.vue'; // Importa a view Payment
import OrdersView from '@/views/OrdersView.vue'; // Importa a view Orders
import OrderDetailsView from '@/views/OrderDetailsView.vue'; // Importa a view OrderDetails
import ProductsView from '@/views/ProductsView.vue'; // Importa a view Products
import ProductUpdateView from '@/views/ProductUpdateView.vue'; // Importa a view ProductUpdate

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
    },
    {
      path: '/admin/orders',
      name: 'orders',
      component: OrdersView,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/admin/orders/:orderId',
      name: 'order-details',
      component: OrderDetailsView,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/admin/products',
      name: 'products',
      component: ProductsView,
      meta: {
        requiresAuth: true
      }
    },    
    {
      path: '/admin/products/new',
      name: 'product-create',
      component: ProductUpdateView,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/admin/products/:productId',
      name: 'product-update',
      component: ProductUpdateView,
      meta: {
        requiresAuth: true
      }
    },
  ],
});

// Middleware para verificar autenticação
router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !localStorage.getItem('authToken')) {
    next('/login');
  } else {

    if (to.meta.guest && localStorage.getItem('authToken')) {
      next('/admin');
    } else {
      next();
    }
  }
});

export default router; // Exporta o roteador