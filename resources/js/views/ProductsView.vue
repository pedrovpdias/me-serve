<script setup lang="ts">
  import AdminHeader from '../components/AdminHeader.vue'; // Importa o AdminHeader
  import Title from '../components/Title.vue'; // Importa o título
  import ProductsTable from '../components/ProductsTable.vue'; // Importa a tabela de produtos

  const breadcrumbLinks = [
    {
      name: 'Dashboard' as string,
      path: '/admin' as string,
    },
    {
      name: 'Produtos' as string,
      path: '/admin/products' as string,
    },
  ];

</script>

<template>
  <main class="flex flex-col gap-8 relative md:w-auto md:flex-1 md:max-w-4xl mx-auto bg-white shadow-xl py-4 min-h-screen">
    <AdminHeader :breadcrumbLinks="breadcrumbLinks" />

    <div class="flex flex-col gap-8 px-8">
      <Title :text="'Produtos'" />

      <router-link to="/admin/products/new" class="flex gap-2 items-center font-bold self-end text-red-600 hover:text-red-800 focus:text-red-800 group outline-none">
        <span class="text-sm">
          <i class="bi bi-plus-circle"></i>
        </span>

        <span class="group-hover:underline group-focus:underline">
          Novo produto
        </span>
      </router-link>

      <ProductsTable />
    </div>
  </main>
</template>