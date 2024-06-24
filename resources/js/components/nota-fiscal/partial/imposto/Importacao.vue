<template>
    <div v-if="showTabImportacao" class="mt-3">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <vue-input label="Alíquota do imposto de importação" name="aliquota" placeholder="0,00" value="0" :required="required" :errors="errors" :fields="fields"></vue-input>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <vue-input label="Alíquota do IOF" name="iof" placeholder="0,00" :errors="errors" :fields="fields"></vue-input>
                </div>
            </div>
        </div>
        <h5 class="border-bottom mb-3 mt-2">Documento de importação</h5>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <vue-input label="Nº do documento" tooltip="(DI, DSI, DIRE, ...)" name="ndoc_importacao" type="number" :required="required" :errors="errors" :fields="fields"></vue-input>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <vue-input label="Data de registro do documento" name="ddoc_importacao" type="date" :required="required" :errors="errors" :fields="fields"></vue-input>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <vue-select label="Estado do desembaraço" name="uf_desembaraco" :options="estados" select_label="Selecione" :required="required" :errors="errors" :fields="fields"></vue-select>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <vue-input label="Local do desembaraço" name="local_desembaraco" type="text" :required="required" :errors="errors" :fields="fields"></vue-input>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <vue-input label="Data do desembaraço" name="data_desembaraco" type="date" :required="required" :errors="errors" :fields="fields"></vue-input>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <vue-select label="Via de transporte" name="via_transporte" :options="opcoesViasTransporte" select_label="Selecione" text_key="nome" :required="required" :errors="errors" :fields="fields"></vue-select>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <vue-select label="Forma de intermediação" name="intermediacao" :options="opcoesFormasIntermediacao" select_label="Selecione" text_key="nome" :required="required" :errors="errors" :fields="fields"></vue-select>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <vue-input label="Cód. do fabricante" tooltip="Número determinado pelo importador, verificar junto ao ERP/Sistema o número de cadastro do fabricante." name="fabricante" type="text" :required="required" :errors="errors" :fields="fields"></vue-input>
                </div>
            </div>
        </div>
        <h5 class="border-bottom mb-3 mt-2">Adição</h5>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <vue-input label="Nº da adição" name="adicao" type="number" :required="required" :errors="errors" :fields="fields"></vue-input>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <vue-input label="Nº sequencial do item dentro da adição" name="seq_adicao" type="number" :required="required" :errors="errors" :fields="fields"></vue-input>
                </div>
            </div>
        </div>
        <h5 class="border-bottom mb-3 mt-2">Outros</h5>
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <vue-input label="Valor da AFRMM" tooltip="Deve ser informada no caso da via de transporte marítima." name="afrmm" v-money="money" :errors="errors" :fields="fields"></vue-input>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <vue-input label="CNPJ do adquirente ou do encomendante" tooltip="Obrigatória a informação no caso de importação por conta e ordem ou por encomenda. Informar os zeros não significativos." name="cnpj_terceiro" type="text" :errors="errors" :fields="fields"></vue-input>
                </div>
            </div>
            <div class="col-5">
                <div class="form-group">
                    <vue-select label="UF do adquirente" name="uf_terceiro" tooltip="Obrigatória a informação no caso de importação por conta e ordem ou por encomenda." :options="estados" select_label="Selecione" :errors="errors" :fields="fields"></vue-select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <vue-input label="Cód. do exportador" name="cod_exportador" tooltip="Número determinado pelo importador, verificar junto ao ERP/Sistema o número de cadastro do exportador." type="text" :errors="errors" :fields="fields"></vue-input>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <vue-input label="Nº de controle da FCI" name="nfci" tooltip="Informação relacionada com a Resolução 13/2012 do Senado Federal." type="text" :errors="errors" :fields="fields"></vue-input>
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
                opcoesViasTransporte: {},
                opcoesFormasIntermediacao: {},
                porcentage: {
                    decimal: '.',
                    thousands: ',',
                    suffix: ' %',
                    precision: 2,
                },
                money: {
                    decimal: '.',
                    thousands: ',',
                    precision: 2,
                },
                required: true
            }
        },
        watch: {
            emissao() {
                this.required = this.emissao == 'importacao' ? true : false
            }
        },
        computed: mapState({
            estados: state => state.options.estados,
            emissao: state => state.nota.emissao,
            opcoes: state => state.options.opcoesFormImportacao,
            showTabImportacao: state => state.nota.showTabImportacao
        }),
        mounted() {
            this.getOpcoesForm()
        },
        methods: {
            getOpcoesForm() {
                this.opcoesViasTransporte = this.opcoes['vias_trasporte']
                this.opcoesFormasIntermediacao = this.opcoes['formas_intermediacao']
            },
        }
    }
</script>