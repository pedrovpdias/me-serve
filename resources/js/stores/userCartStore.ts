// src/stores/useCartStore.ts
import { defineStore } from 'pinia';

export const useCartStore = defineStore('cart', {
  state: () => ({
    items: [] as Array<{ 
      id: number; 
      name: string;
      description: string;
      price: number; 
      quantity: number;
      thumbnail: string
    }>,
  }),
  getters: {
    total: (state) => state.items.reduce(
      (acc, item) => acc + item.price * item.quantity, 0
    ),
  },
  actions: {
    addItem(product: { 
      id: number; 
      name: string;
      description: string;
      price: number;
      thumbnail: string
    }) 
    {
      const existing = this.items.find((item) => item.id === product.id);
      if (existing) {
        existing.quantity++;
      } 
      else {
        this.items.push({ ...product, quantity: 1 });
      }
    },
    removeItem(id: number) {
      const existing = this.items.find((item) => item.id === id);
      if (existing) {
        existing.quantity--;
        if (existing.quantity === 0) {
          this.items = this.items.filter((item) => item.id !== id);
        }
      }
    },
    clearCart() {
      this.items = [];
    },
  },
});