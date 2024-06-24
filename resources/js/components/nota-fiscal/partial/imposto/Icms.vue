<template>
    <div class="mt-3">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <vue-select label="Tributação ICMS" name="tipo_tributacao" :options="tributacaoIcms" text_key="nome" :errors="errors" :fields="fields" :onchange="selectTributacaoIcms"></vue-select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <vue-input label="CFOP" name="codigo_cfop" type="text" :errors="errors" :fields="fields"></vue-input>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <vue-select label="Situação tributária" name="situacao_tributaria" :options="opcoesSituacaoTributariaSelecionada" text_key="nome" :show_key="true" :errors="errors" :fields="fields" :onchange="selectSituacaoTributaria"></vue-select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <vue-select label="Indústria" name="industria" :options="opcoesIndustria" tooltip="Informe caso a venda do produto seja destinada a uma indústria para o uso e consumo final." :errors="errors" :fields="fields"></vue-select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <vue-input label="Alíquota da redução da base de cálculo ICMS" name="alq_icms_reducao" placeholder="0,00" value="0" :required="true" :errors="errors" :fields="fields"></vue-input>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <vue-input label="Alíquota da redução da base de cálculo ICMS ST" name="alq_reducao_st" placeholder="0,00" value="0" :required="true" :errors="errors" :fields="fields"></vue-input>
                </div>
            </div>
            <div class="col-6" v-if="showTabImportacao">
                <div class="form-group">
                    <vue-input label="Alíquota de ICMS + FCP de importação" name="aliquota_importacao" value="0" tooltip="Para o cálculo correto é necessário informar a alíquota integral do ICMS, sendo o FCP para o estado de destino calculado automaticamente." placeholder="0,00" :required="true" :errors="errors" :fields="fields"></vue-input>
                </div>
            </div>
            <div class="col-6" v-if="situacaoTributariaCampos.includes('alq_credito')">
                <div class="form-group">
                    <vue-input label="Alíquota aplicável de cálculo de crédito" name="alq_credito" placeholder="0,00" :required="true" :errors="errors" :fields="fields"></vue-input>
                </div>
            </div>
            <div class="col-6" v-if="situacaoTributariaCampos.includes('alq_mva')">
                <div class="form-group">
                    <vue-input label="Percentual do MVA/IVA Original" tooltip="A definição da MVA Ajustada é realizada automaticamente." name="alq_mva" placeholder="0,00" :required="true" :errors="errors" :fields="fields"></vue-input>
                </div>
            </div>
            <div class="col-6" v-if="situacaoTributariaCampos.includes('motivo_desoneracao')">
                <div class="form-group">
                    <vue-select label="Motivo da desoneração" tooltip="Escolha um motivo somente se enquadrar em algum dos listados." name="motivo_desoneracao" select_label="--" :options="opcoesMotivoDesoneracao" :errors="errors" :fields="fields"></vue-select>
                </div>
            </div>
            <div class="col-6" v-if="situacaoTributariaCampos.includes('alq_diferimento')">
                <div class="form-group">
                    <vue-input label="Percentual do diferimento" name="alq_diferimento" placeholder="0,00" :errors="errors" :fields="fields"></vue-input>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex';
    export default {
        props: ['fields', 'errors'],
        data() {
            return {
                tributacaoIcms: {
                    'simples' : {'nome' : 'Simples nacional', 'padrao' : true},
                    'normal' : {'nome' : 'Normal'}
                },
                opcoesSituacaoTributaria: {},
                opcoesSituacaoTributariaSelecionada: {},
                situacaoTributariaCampos: [],
                opcoesIndustria : {
                    0 : '0 - Não',
                    1 : '1 - Sim'
                },
                opcoesMotivoDesoneracao: {},
                porcentage: {
                    decimal: '.',
                    thousands: ',',
                    suffix: ' %',
                    precision: 2,
                }
            }
        },
        computed: mapState({
            opcoes: state => state.options.opcoesFormIcms,
            showTabImportacao: state => state.nota.showTabImportacao
        }),
        mounted() {
            this.getOpcoesForm()
        },
        methods: {
            getOpcoesForm() {
                this.opcoesSituacaoTributaria = this.opcoes['situacao_tributaria']
                this.opcoesMotivoDesoneracao = this.opcoes['motivos_desoneracao']
                this.selectTributacaoSimples()
            },
            selectTributacaoSimples() {
                this.opcoesSituacaoTributariaSelecionada = this.opcoesSituacaoTributaria[this.fields['tipo_tributacao'] ? this.fields['tipo_tributacao'] : 'simples']
                this.setSituacaoTributariaValue()
            },
            selectTributacaoIcms(event) {
                this.opcoesSituacaoTributariaSelecionada = this.opcoesSituacaoTributaria[event.target.value]
                this.setSituacaoTributariaValue()
            },
            selectSituacaoTributaria(event) {
                if('campos' in this.opcoesSituacaoTributariaSelecionada[event.target.value]) {
                    this.situacaoTributariaCampos = this.opcoesSituacaoTributariaSelecionada[event.target.value]['campos']
                } else {
                    this.situacaoTributariaCampos = []
                }
            },
            setSituacaoTributariaValue() {
                if(this.fields['situacao_tributaria'] == null && this.fields['situacao_tributaria'] == undefined) {
                    var val = null
                    var value = Object.entries(this.opcoesSituacaoTributariaSelecionada).forEach(function(value, key) {
                        value.forEach(v => {
                            if(v.hasOwnProperty('padrao')) {
                                val = value[0]
                            }
                        });
                    })
                    this.fields['situacao_tributaria'] = val
                    
                } 
            }
        }
    }
</script>