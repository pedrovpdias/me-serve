// src/stores/useCartStore.ts
import { defineStore } from 'pinia';

export const useCartStore = defineStore('cart', {
  state: () => ({
    items: [] as Array<{ id: number; name: string; price: number; quantity: number }>,
  }),
  getters: {
    total: (state) => state.items.reduce((acc, item) => acc + item.price * item.quantity, 0),
  },
  actions: {
    addItem(product: { id: number; name: string; price: number }) {
      const existente = this.items.find((item) => item.id === product.id);
      if (existente) {
        existente.quantity++;
      } else {
        this.items.push({ ...product, quantity: 1 });
      }
    },
    removeItem(id: number) {
      this.items = this.items.filter((item) => item.id !== id);
    },
    clearCart() {
      this.items = [];
    },
  },
});