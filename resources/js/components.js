/**
 * nota-fiscal/modal
 */
Vue.component('modal-cliente', require('./components/nota-fiscal/modal/Cliente.vue').default);
Vue.component('modal-produto', require('./components/nota-fiscal/modal/Produto.vue').default);
Vue.component('modal-tributacao', require('./components/nota-fiscal/modal/Tributos').default);
Vue.component('modal-cancelamento', require('./components/nota-fiscal/modal/Cancelamento').default);
Vue.component('modal-devolucao', require('./components/nota-fiscal/modal/Devolucao').default);
Vue.component('modal-unidade', require('./components/nota-fiscal/modal/Unidade').default);

/**
 * nota-fiscal/partial
 */
Vue.component('vue-retorno-api', require('./components/nota-fiscal/partial/RetornoAPI').default);

/**
 * nota-fiscal/partial/cliente
 */
Vue.component('form-pessoa-fisica', require('./components/nota-fiscal/partial/cliente/PessoaFisica').default);
Vue.component('form-pessoa-juridica', require('./components/nota-fiscal/partial/cliente/PessoaJuridica').default);
Vue.component('form-estrangeiro', require('./components/nota-fiscal/partial/cliente/Estrangeiro').default);

/**
 * nota-fiscal/partial/configuracao
 */
Vue.component('form-configuracao-unidades', require('./components/nota-fiscal/partial/configuracao/Unidades').default);

/**
 * nota-fiscal/partial/emitir-notas
 */
Vue.component('form-cliente-emitir', require('./components/nota-fiscal/partial/emitir-notas/FormCliente').default);
Vue.component('form-produto-emitir', require('./components/nota-fiscal/partial/emitir-notas/FormProduto').default);
Vue.component('form-transporte-emitir', require('./components/nota-fiscal/partial/emitir-notas/FormTransporte').default);
Vue.component('form-pedido-emitir', require('./components/nota-fiscal/partial/emitir-notas/FormPedido').default);
Vue.component('form-impostos-emitir', require('./components/nota-fiscal/partial/emitir-notas/FormImpostos').default);
Vue.component('form-ajuste-emitir', require('./components/nota-fiscal/partial/emitir-notas/FormAjuste').default);
Vue.component('form-carta-correcao-emitir', require('./components/nota-fiscal/partial/emitir-notas/FormCartaCorrecao').default);
Vue.component('form-inutilizar-numeracao-emitir', require('./components/nota-fiscal/partial/emitir-notas/FormInutilizarNumeracao').default);

/**
 * nota-fiscal/partial/imposto
 */
Vue.component('impostos', require('./components/nota-fiscal/partial/imposto/Impostos').default);
Vue.component('form-cofins', require('./components/nota-fiscal/partial/imposto/Cofins').default);
Vue.component('form-detalhamento', require('./components/nota-fiscal/partial/imposto/Detalhamento').default);
Vue.component('form-estimativa', require('./components/nota-fiscal/partial/imposto/EstimativaDeTributos').default);
Vue.component('form-exportacao', require('./components/nota-fiscal/partial/imposto/Exportacao').default);
Vue.component('form-icms', require('./components/nota-fiscal/partial/imposto/Icms').default);
Vue.component('form-importacao', require('./components/nota-fiscal/partial/imposto/Importacao').default);
Vue.component('form-ipi', require('./components/nota-fiscal/partial/imposto/Ipi').default);
Vue.component('form-pis', require('./components/nota-fiscal/partial/imposto/Pis').default);

/**
 * nota-fiscal/partial/imposto/tributacao
 */
Vue.component('tributacao-complementar', require('./components/nota-fiscal/partial/imposto/tributacao/Complementar').default);

/**
 * nota-fiscal/partial/produto
 */
Vue.component('form-produto', require('./components/nota-fiscal/partial/produto/Form').default);

/**
 * nota-fiscal/partial/pedido
 */
Vue.component('form-pedido', require('./components/nota-fiscal/partial/pedido/Form').default);
Vue.component('form-pagamento', require('./components/nota-fiscal/partial/pedido/FormPagamento').default);
Vue.component('form-fatura', require('./components/nota-fiscal/partial/pedido/FormFatura').default);
Vue.component('form-parcela', require('./components/nota-fiscal/partial/pedido/FormParcela').default);

/**
 * nota-fiscal/partial/transporte
 */
Vue.component('form-transportadora', require('./components/nota-fiscal/partial/transporte/Transportadora').default);

/**
 * nota-fiscal
 */
Vue.component('header-nota-fiscal', require('./components/nota-fiscal/Header.vue').default);

/**
 * partial
 */
Vue.component('vue-input', require('./components/partial/Input.vue').default);
Vue.component('vue-textarea', require('./components/partial/Textarea.vue').default);
Vue.component('vue-radio', require('./components/partial/Radio.vue').default);
Vue.component('vue-checkbox', require('./components/partial/Checkbox.vue').default);
Vue.component('vue-select', require('./components/partial/Select.vue').default);
Vue.component('vue-alert', require('./components/partial/Alert.vue').default);
Vue.component('vue-loading', require('./components/partial/Loading.vue').default);
Vue.component('vue-table', require('./components/partial/Table.vue').default);
Vue.component('vue-table-append', require('./components/partial/TableAppend.vue').default);
Vue.component('vue-line-table-append', require('./components/partial/LineTableAppend.vue').default);
Vue.component('vue-tab-panel', require('./components/partial/TabPanel.vue').default);
Vue.component('vue-modal', require('./components/partial/Modal.vue').default);
Vue.component('vue-select2', require('./components/partial/Select2.vue').default);
Vue.component('vue-append', require('./components/partial/Append.vue').default);
Vue.component('vue-search-input', require('./components/partial/SearchInput.vue').default);

/**
 * package
 */
Vue.component('vue-pagination', require('laravel-vue-pagination'));

/**
 * passport
 */
Vue.component('passport-clients',('./components/passport/Clients.vue').default);
Vue.component('passport-authorized-clients',require('./components/passport/AuthorizedClients.vue').default);
Vue.component('passport-personal-access-tokens',require('./components/passport/PersonalAccessTokens.vue').default);