<template>
  <div>
    <h2 class="text-center mt-lg-5 mb-5">Fornecedores</h2>
    <div class="d-flex justify-content-center">
      <div class="col-lg-8">
        <TabelaFornecedores />
      </div>
    </div>
  </div>
</template>

<script>
import TabelaFornecedores from './TabelaFornecedores.vue'

export default {
  name: 'EditarFornecedor',
  components: { TabelaFornecedores }
}
</script>
