import {  defineStore } from 'pinia'; // Importa o Pinia

export const useAuthStore = defineStore('auth', {
  // Define o estado do usuario
  state: () => ({
    id: null as number | null,
    email: null as string | null,
    name: null as string | null,
    token: null as string | null,
  }),

  // Define os getters do usuario (retorna os dados do usuario)
  getters: {
    getUser: (state) => ({
      id: state.id,
      email: state.email,
      name: state.name,
    }),
    getToken: (state) => state.token,
  },

  // Define as actions do usuario
  actions: {
    // Define a função para setar os dados do usuario
    setUser(userData: {
      id: number; 
      email: string; 
      name: string;
      token: string;
    }) 
    {
      this.id = userData.id;
      this.email = userData.email;
      this.name = userData.name;

      // Salva os dados do usuario no localStorage
      localStorage.setItem('user', JSON.stringify({
        id: this.id,
        email: this.email,
        name: this.name,
      }));
    },

    // Define a função para setar o token
    setToken(token: string) {
      this.token = token; // Define o token

      localStorage.setItem('authToken', token); // Salva o token no localStorage
    },

    // Limpa o usuario
    clearUser() {
      this.id = null;
      this.email = null;
      this.name = null;

      localStorage.removeItem('user');
    },

    // Limpa o token
    clearToken() {
      this.token = null;
      localStorage.removeItem('authToken');
    },

    // Inicializa o usuario
    initialize() {
      const userData = localStorage.getItem('user'); // Pega os dados do usuario
      const token = localStorage.getItem('authToken'); // Pega o token

      // Se os dados do usuario e o token existirem
      if (userData) {
        const user = JSON.parse(userData);
        this.id = user.id;
        this.email = user.email;
        this.name = user.name;
      }

      if (token) {
        this.token = token;
      }
    }
  },
});