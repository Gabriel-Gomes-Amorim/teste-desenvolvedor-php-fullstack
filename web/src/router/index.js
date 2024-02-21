import { createRouter, createWebHistory } from 'vue-router'
import CriarFornecedor from '../views/CriarFornecedorView.vue'
import ListaFornecedores from '../views/ListaFornecedoresView.vue'
import EditarFornecedor from '../views/EditarFornecedorView.vue'
import ExcluirFornecedor from '../views/ExcluirFornecedorView.vue'

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
      name: 'EditarFornecedor',
      component: EditarFornecedor
    },
    {
      path: '/lista-fornecedores',
      name: 'ListaFornecedores',
      component: ListaFornecedores
    },
    {
      path: '/excluir-fornecedor',
      name: 'ExcluirFornecedor',
      component: ExcluirFornecedor
    }
  ]
})

export default router
