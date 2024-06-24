<template>
<div class="col-12" :id="id">
    <h4 v-if="key == 0" class="pt-2">Formas de pagamento</h4>
    <hr>
    <div class="card-footer">
        <div v-if="key != 0" class="row">
            <button type="button" class="btn btn-sm mr-n2 ribbon-wrapper" @click="removeRow(key)">
                <i class="fas fa-trash"></i>      
            </button>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <vue-select label="Meio de pagamento*" :show_key="true" text_key="nome" name="forma_pagamento" :options="opcoesMeioPagamento" :onchange="selectMeioPagamento" :errors="errors['pagamento'] ? errors['pagamento'][key] : {}" :fields="fields"></vue-select>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group" v-if="meioPagamentoCampos.includes('pagamento')">
                    <vue-select label="Forma de pagamento*" name="pagamento" :options="opcoesPagamento" :errors="errors['pagamento'] ? errors['pagamento'][key] : {}" :fields="fields"></vue-select>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group" v-if="meioPagamentoCampos.includes('valor_pagamento')">
                    <vue-input label="Valor do pagamento (opcional)" name="valor_pagamento" type="text" :errors="errors['pagamento'] ? errors['pagamento'][key] : {}" :fields="fields"></vue-input>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="form-group" v-if="meioPagamentoCampos.includes('bandeira')">
                    <vue-select label="Bandeira (opcional)" name="bandeira" :options="opcoesBandeira" :errors="errors['pagamento'] ? errors['pagamento'][key] : {}" :fields="fields"></vue-select>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group" v-if="meioPagamentoCampos.includes('cnpj_credenciadora')">
                    <vue-select label="Credenciadora (opcional)" name="cnpj_credenciadora" :options="opcoesCredenciadora" :errors="errors['pagamento'] ? errors['pagamento'][key] : {}" :fields="fields"></vue-select>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group" v-if="meioPagamentoCampos.includes('autorizacao')">
                    <vue-input label="Número da autorização - NSU (opcional)" name="autorizacao" type="text" :errors="errors['pagamento'] ? errors['pagamento'][key] : {}" :fields="fields"></vue-input>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    import { mapState } from 'vuex';
    export default {
        props: ['fields', 'removeRow', 'id'],
        data() {
            return {
                key: this.$vnode.key,
                opcoesMeioPagamento: {
                    '01': {
                        'nome': 'Dinheiro',
                        'campos': ['pagamento', 'valor_pagamento']
                        },
                    '02': {
                        'nome': 'Cheque',
                        'campos': ['pagamento', 'valor_pagamento']
                        },
                    '03': {
                        'nome': 'Cartão de Crédito',
                        'campos': ['pagamento', 'valor_pagamento', 'bandeira', 'cnpj_credenciadora', 'autorizacao']
                        },
                    '04': {
                        'nome': 'Cartão de Débito',
                        'campos': ['pagamento', 'valor_pagamento', 'bandeira', 'cnpj_credenciadora', 'autorizacao']
                        },
                    // '05': {
                    //     'nome': 'Crédito Loja',
                    //     'campos': ['pagamento', 'valor_pagamento']
                    //     },
                    // '10': {
                    //     'nome': 'Vale Alimentação',
                    //     'campos': ['pagamento', 'valor_pagamento']
                    //     },
                    // '11': {
                    //     'nome': 'Vale Refeição',
                    //     'campos': ['pagamento', 'valor_pagamento']
                    //     },
                    // '12': {
                    //     'nome': 'Vale Presente',
                    //     'campos': ['pagamento', 'valor_pagamento']
                    //     },
                    // '13': {
                    //     'nome': 'Vale Combustível',
                    //     'campos': ['pagamento', 'valor_pagamento']
                    //     },
                    '14': {
                        'nome': 'Duplicata Mercantil',
                        'campos': ['pagamento', 'valor_pagamento']
                        },
                    '15': {
                        'nome': 'Boleto Bancário',
                        'campos': ['pagamento', 'valor_pagamento']
                        },
                    '90': {
                        'nome': 'Sem pagamento',
                        'campos': []
                        },
                    '99': {
                        'nome': 'Outros',
                        'campos': ['pagamento', 'valor_pagamento']
                        },
                },
                opcoesPagamento: {
                    '0' : 'Pagamento à vista',
                    '1' : 'Pagamento a prazo'
                },
                opcoesTipoIntegracao: {
                    '1' : {'nome': 'Pagamento integrado com o sistema de automação da empresa (Ex: equipamento TEF, Comércio eletrônico)'},
                    '2' : {'nome': 'Pagamento não integrado com o sistema de automação da empresa (Ex: equipamento POS)', 'padrao': true}
                },
                opcoesBandeira: {
                    '01' : 'Visa / Visa Electron',
                    '02' : 'Mastercard / Maestro',
                    '03' : 'American Express',
                    '04' : 'Sorocred',
                    '05' : 'Diners Club',
                    '06' : 'Elo',
                    '07' : 'Hipercard',
                    '08' : 'Aura',
                    '09' : 'Cabal',
                    '99' : 'Outros'
                },
                opcoesCredenciadora: {
                    '01.027.058/0001-91': 'Cielo',
                    '08.561.701/0001-01': 'PagSeguro',
                    '01.425.787/0001-04': 'Rede',
                    '16.501.555/0001-57': 'Stone',
                    '': 'Outra'
                },
                meioPagamentoCampos: ''
            }
        },
        computed: {
            ...mapState({
                errors: state => state.nota.errors['pedido']
            })
        },
        methods: {
            selectMeioPagamento(event) {
                if('campos' in this.opcoesMeioPagamento[event.target.value]) {
                    this.meioPagamentoCampos = this.opcoesMeioPagamento[event.target.value]['campos']
                }
            },
        }
    }
</script>