<script setup lang="ts">
  defineProps<{
    breadcrumbLinks: {
      name: string,
      path: string
    }[]
  }>();


</script>

<template>
  <ul class="flex items-end gap-4 text-primary mx-8">
    <li v-for="(link, index) in breadcrumbLinks" :key="link.name" class="flex items-center gap-4 last:opacity-50 last:pointer-events-none">
      <router-link 
        :to="link.path" 
        class="flex items-center gap-2 text-sm font-semibold hover:text-primary/80 focus:text-primary/80 outline-none"
      >
        <i v-if="link.path === '/admin'" class="bi bi-house-door-fill"></i>

        <span v-if="link.path !== '/admin'">
          {{ link.name }}
        </span>
      </router-link>

      <span v-if="index < breadcrumbLinks.length - 1" class="text-xs pointer-events-none opacity-30">
        <i class="bi bi-chevron-right"></i>
      </span>
    </li>
  </ul>
</template>

<script lang="ts">
  export default {
    name: 'Breadcrumb'
  }
</script>