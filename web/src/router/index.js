import { createRouter, createWebHistory } from 'vue-router'
import CriarFornecedor from '../views/CriarFornecedorView.vue'
import EditarFornecedorView from '../views/EditarFornecedorView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'criarFornecedor',
      component: CriarFornecedor
    },
    {
      path: '/editar-fornecedor',
      name: 'editarFornecedor',
      component: EditarFornecedorView
    }
  ]
})

export default router
