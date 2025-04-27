import {  defineStore } from 'pinia';

export const useCustomerStore = defineStore('customer', {
  state: () => ({
    customer: [] as Array<{
      name: string;
    }>
  }),

  actions: {
    // Define o nome do cliente
    setName(customer: {
      name: string;
    })
    {
      this.customer.push(customer);
    },

    // Limpa o nome do cliente
    clearName() {
      this.customer = [];
    }
  }
});