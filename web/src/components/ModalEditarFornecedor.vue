<template>
  <div
    class="modal fade"
    id="modalEditar"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Fornecedor</h1>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <form method="PUT" @submit="atualizarFornecedor">
            <div class="mb-3">
              <label for="nome" class="form-label">Nome</label>
              <input
                type="text"
                class="form-control"
                v-model="fornecedorEdicao.nome"
                id="nome"
                required
              />
            </div>
            <div class="mb-3">
              <label for="cpf_cnpj" class="form-label">CPF ou CNPJ</label>
              <input
                type="text"
                class="form-control"
                id="cpf_cnpj"
                v-model="fornecedorEdicao.cpf_cnpj"
                v-mask="['###.###.###-##', '##.###.###/####-##']"
                required
              />
            </div>

            <div class="mb-3">
              <label for="contato" class="form-label">Contato</label>
              <input
                type="tel"
                class="form-control"
                id="contato"
                v-model="fornecedorEdicao.contato"
                v-mask="['(##) ####-####', '(##) #####-####']"
                required
              />
            </div>
            <div class="mb-3">
              <label for="endereco" class="form-label">Endereço</label>
              <input
                type="text"
                class="form-control"
                v-model="fornecedorEdicao.endereco"
                id="endereco"
                required
              />
            </div>

            <div class="mb-3">
              <label for="tipo_servico" class="form-label">Tipo de serviço</label>
              <input
                type="text"
                class="form-control"
                v-model="fornecedorEdicao.tipo_servico"
                id="tipo_servico"
                required
              />
            </div>

            <div class="mb-3">
              <label for="representante" class="form-label">Representante</label>
              <input
                type="text"
                class="form-control"
                v-model="fornecedorEdicao.representante"
                id="representante"
                required
              />
            </div>
            <div class="col-12 mb-3">
              <button type="submit" class="btn btn-dark w-100">Salvar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ModalEditarFornecedor',
  props: {
    fornecedorEdicao: {
      type: Object,
      required: true
    }
  },
  methods: {
    async atualizarFornecedor(e) {
      e.preventDefault()

      try {
        const req = await fetch(
          `http://localhost:8989/api/fornecedor/atualizar/${this.fornecedorEdicao.id}`,
          {
            method: 'PUT',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify(this.fornecedorEdicao)
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

          this.fornecedorEdicao.nome = ''
          this.fornecedorEdicao.cpf_cnpj = ''
          this.fornecedorEdicao.contato = ''
          this.fornecedorEdicao.endereco = ''
          this.fornecedorEdicao.tipo_servico = ''
          this.fornecedorEdicao.representante = ''
        } else {
          this.$swal({
            icon: 'error',
            title: 'Oops...',
            text: res.mensagem || 'Algo deu errado!'
          })
        }
      } catch (error) {
        this.$swal({
          icon: 'erro',
          title: 'Oops...',
          text: 'Algo deu errado!'
        })
        console.error(error)
      }
    }
  }
}
</script>
