import { createRouter, createWebHistory } from 'vue-router'
import CriarFornecedor from '../views/CriarFornecedorView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'criarFornecedor',
      component: CriarFornecedor
    }
  ]
})

export default router
