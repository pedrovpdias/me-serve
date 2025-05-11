<script setup lang="ts">
  // Busca usuario no localstorage
  const authToken = localStorage.getItem('authToken');

  console.log(authToken);
</script>
<template>
  <h1>admin</h1>

  <span>
    Logged as 
  </span>
</template>