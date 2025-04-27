// src/stores/useCartStore.ts
import { defineStore } from 'pinia'; // Importa o Pinia

// Define o carrinho
export const useCartStore = defineStore('cart', {
  // Define o estado
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
  // Define os getters do carrinho
  getters: {
    total: (state) => state.items.reduce(
      (acc, item) => acc + item.price * item.quantity, 0
    ),
  },
  // Define as ações do carrinho
  actions: {
    // Adiciona um item ao carrinho
    addItem(product: { 
      id: number; 
      name: string;
      description: string;
      price: number;
      thumbnail: string
    }) 
    {
      // Verifica se o item já existe
      const existing = this.items.find((item) => item.id === product.id);
      if (existing) {
        existing.quantity++; // Incrementa a quantidade do item existente
      } 
      else {
        this.items.push({ ...product, quantity: 1 }); // Adiciona o item ao carrinho com quantidade 1
      }
    },
    // Remove um item do carrinho
    removeItem(id: number) {
      // Verifica se o item existe
      const existing = this.items.find((item) => item.id === id);
      if (existing) {
        existing.quantity--; // Decrementa a quantidade do item
        // Remove o item do carrinho se a quantidade for 0
        if (existing.quantity === 0) {
          this.items = this.items.filter((item) => item.id !== id);
        }
      }
    },
    // Limpa o carrinho
    clearCart() {
      this.items = [];
    },
  },
});