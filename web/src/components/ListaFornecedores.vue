<template>
  <div>
    <h2 class="text-center mt-lg-5 mb-5">Fornecedores</h2>
    <div class="d-flex justify-content-center">
      <div class="col-lg-8">
        <table class="table">
          <thead>
            <tr class="bg-dark">
              <th scope="col">Nome</th>
              <th scope="col">CPF/CNPJ</th>
              <th scope="col">Contato</th>
              <th scope="col">Endereço</th>
              <th scope="col">Tipo de serviço</th>
              <th scope="col">Representante</th>
            </tr>
          </thead>
          <tbody v-for="fornecedor in fornecedores" :key="fornecedor.id">
            <tr>
              <td>{{ fornecedor.nome }}</td>

              <td>{{ fornecedor.cpf_cnpj }}</td>

              <td>{{ fornecedor.contato }}</td>

              <td>{{ fornecedor.endereco }}</td>

              <td>{{ fornecedor.tipo_servico }}</td>

              <td>{{ fornecedor.representante }}</td>
            </tr>
          </tbody>
        </table>

        <div class="d-flex justify-content-end">
          <nav>
            <ul class="pagination">
              <li class="page-item" v-if="pagination.prev_page_url">
                <a
                  class="page-link"
                  href="#"
                  @click.prevent="carregarPagina(pagination.prev_page_url)"
                  aria-label="Previous"
                >
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              <li
                class="page-item"
                v-for="page in pagination.last_page"
                :key="page"
                :class="{ active: pagination.current_page === page }"
              >
                <a
                  class="page-link"
                  href="#"
                  @click.prevent="carregarPagina(pagination.path + '?page=' + page)"
                  >{{ page }}</a
                >
              </li>
              <li class="page-item" v-if="pagination.next_page_url">
                <a
                  class="page-link"
                  href="#"
                  @click.prevent="carregarPagina(pagination.next_page_url)"
                  aria-label="Next"
                >
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
            </ul>
          </nav>
          <div></div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'TabelaFornecedor',
  data() {
    return {
      fornecedores: [],
      fornecedorEdicao: {
        nome: '',
        cpf_cnpj: '',
        contato: '',
        endereco: '',
        tipo_servico: '',
        representante: ''
      },
      pagination: {}
    }
  },
  created() {
    this.carregarFornecedores()
  },
  methods: {
    async carregarFornecedores() {
      try {
        const req = await fetch('http://localhost:8989/api/fornecedor')
        const res = await req.json()
        if (res.status === 200) {
          this.fornecedores = res.fornecedores.data
          this.pagination = res.fornecedores
        } else {
          this.$swal({
            icon: 'error',
            title: 'Oops...',
            text: res.mensagem || 'Algo deu errado ao carregar os fornecedores!'
          })
        }
      } catch (error) {
        this.$swal({
          icon: 'error',
          title: 'Oops...',
          text: 'Algo deu errado ao carregar os fornecedores!'
        })
        console.error(error)
      }
    },
    async carregarPagina(url) {
      try {
        const req = await fetch(url)
        const res = await req.json()
        if (res.status === 200) {
          this.fornecedores = res.fornecedores.data
          this.pagination = res.fornecedores
        } else {
          this.$swal({
            icon: 'error',
            title: 'Oops...',
            text: res.mensagem || 'Algo deu errado ao carregar os fornecedores!'
          })
        }
      } catch (error) {
        this.$swal({
          icon: 'error',
          title: 'Oops...',
          text: 'Algo deu errado ao carregar os fornecedores!'
        })
        console.error(error)
      }
    }
  }
}
</script>
