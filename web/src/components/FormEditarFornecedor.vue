<template>
  <h2 class="text-center mt-lg-5 mb-5">Editar Fornecedor</h2>

  <div class="d-flex justify-content-center">
    <select
      class="form-select w-50"
      aria-label="Default select example"
      v-model="fornecedorSelecionado"
    >
      <option disabled value="">Selecione o Fornecedor</option>
      <option v-for="(fornecedor, index) in fornecedores" :key="index" :value="fornecedor.id">
        {{ fornecedor.nome }} - {{ fornecedor.cpf_cnpj }}
      </option>
    </select>
    <button
      type="button"
      class="btn btn-warning m-1"
      data-bs-toggle="modal"
      data-bs-target="#modalEditar"
      data-bs-whatever="@mdo"
      @click="
        abrirModalEditar(fornecedores.find((fornecedor) => fornecedor.id === fornecedorSelecionado))
      "
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        width="16"
        height="16"
        fill="currentColor"
        class="bi bi-pencil-square"
        viewBox="0 0 16 16"
      >
        <path
          d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"
        />
        <path
          fill-rule="evenodd"
          d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"
        />
      </svg>
      Editar
    </button>
  </div>

  <ModalEditarFornecedor :fornecedorEdicao="fornecedorEdicao" />
</template>
<script>
import ModalEditarFornecedor from './ModalEditarFornecedor.vue'

export default {
  name: 'FormEditarFornecedor',
  components: {
    ModalEditarFornecedor
  },
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
      }
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
    abrirModalEditar(fornecedor) {
      this.fornecedorEdicao = { ...fornecedor }
    }
  },
  components: { ModalEditarFornecedor }
}
</script>
