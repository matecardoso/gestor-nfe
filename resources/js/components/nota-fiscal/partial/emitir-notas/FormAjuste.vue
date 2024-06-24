<template>
    <div class="col-12">

        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <vue-input label="Data de Entrada ou Saída" name="data_entrada_saida" type="date" :errors="errors" :fields="fields"></vue-input>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <vue-select label="Situação tributária (ICMS)" name="situacao_tributaria" :required="'vuelidate'" :options="opcoesSituacaoTributaria" text_key="nome" :show_key="true" :errors="errors" :fields="fields"></vue-select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <vue-input label="Código CFOP de ajuste" name="codigo_cfop" v-mask="'#.###'" placeholder="_.___" type="text" :required="'vuelidate'" :errors="errors" :fields="fields"></vue-input>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <vue-input label="Valor do ICMS a ser ajustado" name="valor_icms" type="text" :required="'vuelidate'" :errors="errors" :fields="fields"></vue-input>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <vue-textarea label="Informações ao fisco" name="informacoes_fisco" rows="3" type="text" :errors="errors" :fields="fields"></vue-textarea>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <vue-textarea label="Informações complementares ao consumidor" name="informacoes_complementares" rows="3" type="text" :errors="errors" :fields="fields"></vue-textarea>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import { mapState } from 'vuex';
    export default {
        data() {
            return {
                fields: {},
                tributacaoIcms: {
                    'simples' : 'Simples nacional',
                    'normal' : 'Normal'
                },
                opcoesSituacaoTributaria: {}
            }
        },
        computed: mapState({
            opcoesFormIcms: state => state.options.opcoesFormIcms,
            errors: state => state.nota.errors['impostos']
        }),
        mounted() {
            this.opcoesSituacaoTributaria = {
                ...this.opcoesFormIcms['situacao_tributaria']['normal'], 
                ...this.opcoesFormIcms['situacao_tributaria']['simples']
            }
        },
    }
</script>