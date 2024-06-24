<template>
    <div class="px-2">

        <div v-if="form_emissao != 'estrangeiro'" class="row">
            <div class="col-12">
                <div class="form-group ml-2">
                    <vue-radio name="tipo_pessoa" :options="JSON.stringify(tipos_pessoa)" :inline="true" :onchange="changeForm" :errors="errors" :fields="cliente" ></vue-radio>
                </div>
            </div>
        </div>

        <form-pessoa-fisica v-if="form_emissao == 'pessoa-fisica'" :show_consumidor_final="true" :errors="errors" :fields="cliente"></form-pessoa-fisica>
        <form-pessoa-juridica v-if="form_emissao == 'pessoa-juridica'" :show_consumidor_final="true" :errors="errors" :fields="cliente"></form-pessoa-juridica>
        <form-estrangeiro v-if="form_emissao == 'estrangeiro'" :show_consumidor_final="true" :errors="errors" :fields="cliente"></form-estrangeiro>

    </div>
</template>

<script>
import { mapState } from 'vuex';
export default {
    data() {
        return {
            fields: {},
            errors: {},
            success: false,
            loaded: true,
            opcoesFinalidade: {
                'normal' : 'NF-e normal',
                'complementar' : 'NF-e complementar',
                'ajuste' : 'NF-e de ajuste',
                'devolucao' : 'Devolução/Retorno',
                'carta_correcao' : 'Carta de Correção',
                'inutilizar' : 'Inutilizar Numeração',
            },
            opcoesOperacao: {
                'saida' : 'Saída',
                'entrada' : 'Entrada',
                'importacao' : 'Importação',
                'exportacao' : 'Exportação',
            },
            tabs: {
                'form-cliente' : {
                    'label' : 'Cliente',
                    'show' : true
                },
            },
            tipos_pessoa: {
                'pessoa-fisica' : 'Pessoa física',
                'pessoa-juridica' : 'Pessoa jurídica'
            }
        }
    },
    computed: mapState({
        form_emissao: state => state.form_emissao,
        cliente: state => state.nota.cliente
    }),
    methods: {
        changeForm(event) {
            this.$store.commit('SET_FORM_EMISSAO', event.target.value)
        }
    },
}
</script>