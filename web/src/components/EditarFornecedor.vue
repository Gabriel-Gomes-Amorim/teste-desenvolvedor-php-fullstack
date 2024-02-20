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
              <th scope="col">Editar</th>
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

              <td>
                <button type="button" class="btn btn-warning m-1">
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

                <button type="button" class="btn btn-danger" @click="showAlert(fornecedor.id)">
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
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'EditarFornecedor',
  data() {
    return {
      fornecedores: []
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
          this.fornecedores = res.fornecedores
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
    showAlert(id) {
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
            const req = await fetch(`http://localhost:8989/api/fornecedor/deletar/${id}`, {
              method: 'DELETE'
            })
            const res = await req.json()
            if (res.status === 200) {
              this.$swal({
                position: 'top-end',
                icon: 'success',
                title: res.mensagem,
                showConfirmButton: false,
                timer: 1500
              })

              window.location.reload()
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
