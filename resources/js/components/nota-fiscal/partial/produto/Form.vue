<template>
    <div class="col-12">
        
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <vue-input label="Nome" :required="true" name="nome" :errors="errors" :fields="fields"></vue-input>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <vue-input label="Valor" :required="true" name="subtotal" placeholder="0,00" :errors="errors" :fields="fields" ></vue-input>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <vue-input label="Código do produto" name="codigo" :errors="errors" :fields="fields"></vue-input>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <!-- <vue-input label="Unidade" name="unidade" placeholder="Ex: UN, KG..." :errors="errors" :fields="fields"></vue-input> -->
                    <vue-select label="Unidade" name="unidade" :required="true" :options="opcoesUnidades" :show_key="true" :errors="errors" :fields="fields"></vue-select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <vue-select label="Origem do Produto" name="origem" :required="true" :options="opcoesOrigemProduto" :show_key="true" :errors="errors" :fields="fields"></vue-select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <vue-input label="NCM" name="ncm" :required="true" :errors="errors" :fields="fields"></vue-input>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <vue-input label="CEST" name="cest" v-mask="'#######'" tooltip="O parâmetro CEST deve possuir 7 dígitos" :errors="errors" :fields="fields"></vue-input>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <vue-input label="GTIN" name="gtin" :errors="errors" :fields="fields"></vue-input>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <vue-input label="GTIN tributável" name="gtin_tributavel" :errors="errors" :fields="fields"></vue-input>
                </div>
            </div>
        </div>

        <impostos title="Impostos" :errors="errors" :fields="fields.impostos"></impostos>

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
                }
            }
        },
        computed: mapState({
            opcoesOrigemProduto: state => state.options.opcoesOrigemProduto,
            opcoesUnidades: state => state.configuracoes.opcoesUnidades
        }),
        created() {
            this.$store.dispatch('getOpcoesUnidades')
        },
    }
</script>