# 🍔 meServe - Sistema de Autoatendimento

**meServe** é um sistema de autoatendimento para lanchonetes, inspirado nos totens de redes como **Burger King** e **McDonald's**. Este repositório contém o **frontend (Vue 3)** e o **backend (Laravel API)** integrados, oferecendo uma experiência fluida do **cardápio ao pagamento**.

🔗 Acesse: [https://meserve.laravel.cloud/](https://meserve.laravel.cloud/)

---

## ✨ Funcionalidades

### Backend Laravel (API de produtos)

- **CRUD** de produtos com categorias
- Autenticação via **Sanctum** + **Fortify**
- Proteção de rotas administrativas
- Seeders com categorias e produtos de exemplo
- Upload e exibição de imagens dos produtos
- Seeders com categorias, produtos de exemplo e status de pedidos para demonstrar o ciclo de vida dos pedidos.

### Frontend Vue 3

- Cardápio de produtos dinâmico com imagens
- Carrinho de compras persistente via **Pinia**
- Animações e feedbacks visuais na finalização da compra
- Layout responsivo com **Tailwind CSS**
- Fluxo completo: Menu → Carrinho → Pagamento → Finalização

---

## 🚀 Como executar

### 🧠 Backend (Laravel)

```bash
cd me-serve
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

### 🖥️ Frontend (Vue)

```bash
npm install
npm run dev
```

---

## 🛠️ Tecnologias Utilizadas

- [Laravel 12](https://laravel.com/)
- [Sanctum](https://github.com/laravel/sanctum)
- [Fortify](https://github.com/laravel/fortify)
- [Vue 3](https://vuejs.org/)
- [Vite](https://vite.dev/)
- [Pinia](https://pinia.vuejs.org/)
- [Axios](https://axios-http.com/ptbr/docs/intro)
- [TailwindCSS 4](https://tailwindcss.com/)
- [Bootstrap Icons](https://icons.getbootstrap.com/)
- **MySQL**
- [TypeScript](https://www.typescriptlang.org/)

---

## 📢 API Endpoints

| Método | Rota               | Protegida? | Descrição                   |
|--------|--------------------|------------|-----------------------------|
| GET    | /api/products      |     ❌    | Lista todos os produtos     |
| POST   | /api/products      |     ✅    | Cadastra um novo produto    |
| PUT    | /api/products/{id} |     ✅    | Atualiza um produto         |
| DELETE | /api/products/{id} |     ✅    | Remove um produto           |

---

## 📂 Estrutura do Projeto

```bash
├── me-serve
│   ├── app, routes, database... # Back-end Laravel
│   └── resources
│       ├── views
│       ├── css
│       ├── images
│       └── js # Front-end Vue.js
│           ├── components
│           ├── router
│           ├── stores # Pinia
│           └── views
```

---

## 📦 Categorias

- 🍔 Hambúrgueres
- 🥤 Bebidas
- 🍦 Sobremesas
- 🍟 Acompanhamentos

---

## 🍽️ Produtos (Exemplos)

- Hambúrguer Clássico
- Cheeseburger Duplo
- Crispy Chicken Burger
- Crispy King Burger
- Casquinha de Chocolate
- Casquinha de Baunilha
- Refrigerante Cola
- Refrigerante de Laranja
- Refrigerante de Limão e Lima
- Batata Frita
- Brownie de Chocolate
- VanillaDream Mix
- ChocolateDream Mix
- Onion Rings
- Nuggets de Frango

---

## 🚦 Status de Pedidos

- Pedido aguardando preparo
- Sendo preparado
- Pronto para retirada
- Entregue ao cliente

## 🧪 Funcionalidades futuras (em desenvolvimento)

- Painel administrativo completo
- Relatórios de pedidos
- Multiplataforma (modo quiosque/tablet)

---

## 👨‍💻 Sobre o Projeto

Este é um projeto opensource criado por [Pedro Dias](https://github.com/pedrovpdias) ☕ com foco no aprendizado e exploração de tecnologias de desenvolvimento. O **meServe** simula uma solução para uma empresa fictícia, servindo como um laboratório para aprimorar minhas habilidades.
Sinta-se à vontade para explorar o código e compartilhar ideias! 💡

---

## 🖼️ Preview

![Demo](https://github.com/pedrovpdias/me-serve/blob/main/public/demo.gif?raw=true)
