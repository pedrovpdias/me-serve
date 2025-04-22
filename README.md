# 🍔 meServe - Sistema de Autoatendimento

Este repositório contém o frontend (Vue 3) e backend (Laravel API) de um sistema de autoatendimento para lanchonetes, inspirado em totens como os do Burger King e McDonald's.

---

## ✨ Funcionalidades

### Backend Laravel (API de produtos)
- CRUD de produtos com categorias
- Proteção de rotas por autenticação (Sanctum + Fortify)
- Seeders com categorias e produtos de exemplo

### Frontend Vue 3
- Catálogo de produtos com imagens
- Carrinho de compras com Pinia
- Navegação entre etapas: Menu > Carrinho > Pagamento > Finalização

---

## 🚀 Como executar

### Backend (Laravel)
```bash
cd laravel-api-produtos
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

### Frontend (Vue)
```bash
cd autoatendimento-mvp
npm install
npm run dev
```

---

## 🌐 Stack utilizada
- Laravel 10+, Sanctum, Fortify
- Vue 3, Vite, Pinia
- Tailwind CSS

---

## 📢 API Endpoints

| Método | Rota               | Protegida? | Descrição                   |
|--------|--------------------|------------|-----------------------------|
| GET    | /api/produtos      |     ❌    | Lista todos os produtos     |
| POST   | /api/produtos      |     ✅    | Cadastra um novo produto    |
| PUT    | /api/produtos/{id} |     ✅    | Atualiza um produto         |
| DELETE | /api/produtos/{id} |     ✅    | Remove um produto           |

---

## 📉 Exemplos de categorias
- Lanches
- Bebidas
- Sobremesas

## 🍽️ Produtos exemplo
- Cheeseburger
- Refrigerante Lata
- Casquinha de Baunilha

---

## 📜 Licença

Este projeto é livre para uso educacional.

Desenvolvido por Pedro Dias ☕