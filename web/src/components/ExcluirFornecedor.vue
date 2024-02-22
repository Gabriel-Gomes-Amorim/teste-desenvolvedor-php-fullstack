<template>
  <h2 class="text-center mt-lg-5 mb-5">Excluir Fornecedor</h2>

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

    <button type="button" class="btn btn-danger m-1" @click="showAlert(fornecedorSelecionado)">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        width="16"
        height="16"
        fill="currentColor"
        class="bi bi-trash3-fill"
        viewBox="0 0 16 16"
      >
        <path
          d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"
        />
      </svg>
      Excluir
    </button>
  </div>
</template>
<script>
export default {
  name: 'ExcluirFornecedor',
  data() {
    return {
      fornecedores: [],
      fornecedorSelecionado: null
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
    showAlert(fornecedorId) {
      if (!this.fornecedorSelecionado) {
        this.$swal({
          icon: 'error',
          title: 'Oops...',
          text: 'Por favor, selecione um fornecedor antes de excluir!'
        })
        return
      }

      this.$swal({
        title: 'Tem certeza?',
        text: 'Você não poderá reverter isso!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sim, Excluir!'
      }).then(async (result) => {
        if (result.isConfirmed) {
          try {
            const req = await fetch(
              `http://localhost:8989/api/fornecedor/deletar/${fornecedorId}`,
              {
                method: 'DELETE'
              }
            )
            const res = await req.json()
            if (res.status === 200) {
              this.$swal({
                position: 'top-end',
                icon: 'success',
                title: res.mensagem,
                showConfirmButton: false,
                timer: 1500
              })
              this.carregarFornecedores()
            } else {
              this.$swal({
                icon: 'error',
                title: 'Oops...',
                text: res.mensagem || 'Algo deu errado ao excluir o fornecedor!'
              })
            }
          } catch (error) {
            this.$swal({
              icon: 'error',
              title: 'Oops...',
              text: 'Algo deu errado ao excluir o fornecedor!'
            })
            console.error(error)
          }
        }
      })
    }
  }
}
</script>
