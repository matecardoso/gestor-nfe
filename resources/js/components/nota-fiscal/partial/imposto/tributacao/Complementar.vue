<template>
    <div class="col-12">
        
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <vue-input label="NCM" name="ncm" :required="true" :errors="errors" :fields="fields"></vue-input>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <vue-input label="Código do produto" name="codigo" :errors="errors" :fields="fields"></vue-input>
                </div>
            </div>
            <div class="col-5">
                <div class="form-group">
                    <vue-select label="Origem do Produto" name="origem" :required="true" :options="opcoesOrigemProduto" :show_key="true" :errors="errors" :fields="fields"></vue-select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <vue-select label="Situação tributária" name="situacao_tributaria" :required="true" :options="opcoesSituacaoTributaria" text_key="nome" :show_key="true" :errors="errors" :fields="fields"></vue-select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <vue-input label="CFOP" name="codigo_cfop" type="text" :required="true" :errors="errors" :fields="fields"></vue-input>
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
                    'simples' : 'Simples nacional',
                    'normal' : 'Normal'
                },
                money: {
                    decimal: '.',
                    thousands: ',',
                    precision: 2,
                },
                opcoesSituacaoTributaria: {}
            }
        },
        computed: mapState({
            opcoesOrigemProduto: state => state.options.opcoesOrigemProduto,
            opcoesFormIcms: state => state.options.opcoesFormIcms
        }),
        mounted() {
            this.opcoesSituacaoTributaria = {
                ...this.opcoesFormIcms['situacao_tributaria']['normal'], 
                ...this.opcoesFormIcms['situacao_tributaria']['simples']
            }
        }
    }
</script>