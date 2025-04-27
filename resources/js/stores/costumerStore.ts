import {  defineStore } from 'pinia';

export const useCostumerStore = defineStore('costumer', {
  state: () => ({
    costumer: [] as Array<{
      name: string;
    }>
  }),

  actions: {
    // Define o nome do cliente
    setName(costumer: {
      name: string;
    })
    {
      this.costumer.push(costumer);
    },

    // Limpa o nome do cliente
    clearName() {
      this.costumer = [];
    }
  }
});