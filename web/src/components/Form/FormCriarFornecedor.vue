<template>
  <h2 class="text-center mt-lg-5 mb-5">Cadastro de Fornecedor</h2>
  <div class="d-flex justify-content-center">
    <div class="col-lg-6 col-md-8 col-sm-10">
      <form class="row g-3 needs-validation" method="POST" @submit="criarFornecedor">
        <div class="col-md-6 mb-3">
          <label for="nome" class="form-label">Nome</label>
          <input type="text" class="form-control" v-model="nome" id="nome" required />
        </div>

        <div class="col-md-6 mb-3">
          <label for="cpf_cnpj" class="form-label">CPF ou CNPJ</label>
          <input
            type="text"
            class="form-control"
            id="cpf_cnpj"
            v-model="cpf_cnpj"
            v-mask="['###.###.###-##', '##.###.###/####-##']"
            required
          />
        </div>

        <div class="col-md-6 mb-3">
          <label for="contato" class="form-label">Contato</label>
          <input
            type="tel"
            class="form-control"
            id="contato"
            v-model="contato"
            v-mask="['(##) ####-####', '(##) #####-####']"
            required
          />
        </div>

        <div class="col-md-6 mb-3">
          <label for="endereco" class="form-label">Endereço</label>
          <input type="text" class="form-control" v-model="endereco" id="endereco" required />
        </div>

        <div class="col-md-6 mb-3">
          <label for="tipo_servico" class="form-label">Tipo de serviço</label>
          <input
            type="text"
            class="form-control"
            v-model="tipo_servico"
            id="tipo_servico"
            required
          />
        </div>

        <div class="col-md-6 mb-3">
          <label for="representante" class="form-label">Representante</label>
          <input
            type="text"
            class="form-control"
            v-model="representante"
            id="representante"
            required
          />
        </div>

        <div class="col-12 mb-3">
          <button type="submit" class="btn btn-dark w-100">Cadastrar</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: 'FormCriarFornecedorForm',
  data() {
    return {
      nome: '',
      cpf_cnpj: '',
      contato: '',
      endereco: '',
      tipo_servico: '',
      representante: ''
    }
  },
  methods: {
    async criarFornecedor(e) {
      e.preventDefault()

      const data = {
        nome: this.nome,
        cpf_cnpj: this.cpf_cnpj,
        contato: this.contato,
        endereco: this.endereco,
        tipo_servico: this.tipo_servico,
        representante: this.representante
      }

      const dataJson = JSON.stringify(data)

      try {
        const req = await fetch('http://localhost:8989/api/fornecedor/criar', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: dataJson
        })

        const res = await req.json()
        console.log(res)
        if (res.status === 201) {
          this.$swal({
            position: 'top-end',
            icon: 'success',
            title: res.mensagem,
            showConfirmButton: false,
            timer: 1500
          })

          this.nome = ''
          this.cpf_cnpj = ''
          this.contato = ''
          this.endereco = ''
          this.tipo_servico = ''
          this.representante = ''
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
