<template>
    <div class="col-12">

        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <vue-input label="CFOP" name="codigo_cfop" v-mask="'#.###'" type="text" :required="'vuelidate'" :errors="errors" :fields="impostos"></vue-input>
                </div>
            </div>
        </div>

        <vue-checkbox label="Complementar ICMS" name="show_form_icms" value="form_icms" :onchange="toggleForm" :fields="impostos"></vue-checkbox>

        <div v-if="form_icms">
            <div class="col-12">
                <div class="form-group row">
                    <div class="col-6">
                        <vue-select label="Situação tributária" name="situacao_tributaria_icms" :required="'vuelidate'" :options="opcoesSituacaoTributaria" text_key="nome" :show_key="true" :errors="errors" :fields="impostos"></vue-select>
                    </div>
                    <div class="col-3">
                        <vue-input label="Base de cálculo" name="bc_icms" type="text" :required="'vuelidate'" :errors="errors" :fields="impostos"></vue-input>
                    </div>
                    <div class="col-3">
                        <vue-input label="Valor do complemento" name="valor_icms" type="text" :required="'vuelidate'" :errors="errors" :fields="impostos"></vue-input>
                    </div>
                </div>
            </div>
        </div>

        <vue-checkbox label="Complementar ICMS ST" name="show_form_icms_st" value="form_icms_st" :onchange="toggleForm" :fields="impostos"></vue-checkbox>

        <div v-if="form_icms_st">
            <div class="col-12">
                <div class="form-group row">
                    <div class="col-4">
                        <vue-select label="Situação tributária" name="situacao_tributaria_icms_st" :required="'vuelidate'" :options="opcoesSituacaoTributaria" text_key="nome" :show_key="true" :errors="errors" :fields="impostos"></vue-select>
                    </div>
                    <div class="col-3">
                        <vue-input label="Base de cálculo" name="bc_icms_st" type="text" :required="'vuelidate'" :errors="errors" :fields="impostos"></vue-input>
                    </div>
                    <div class="col-3">
                        <vue-input label="Valor do complemento" name="valor_icms_st" type="text" :required="'vuelidate'" :errors="errors" :fields="impostos"></vue-input>
                    </div>
                    <div class="col-2">
                        <vue-input label="Alíquota MVA" name="aliquota_mva" type="text" :required="'vuelidate'" :errors="errors" :fields="impostos"></vue-input>
                    </div>
                </div>
            </div>
        </div>

        <vue-checkbox label="Complementar IPI" name="show_form_ipi" value="form_ipi" :onchange="toggleForm" :fields="impostos"></vue-checkbox>

        <div v-if="form_ipi">
            <div class="col-12">
                <div class="form-group row">
                    <div class="col-6">
                        <vue-input label="Base de cálculo" name="bc_ipi" type="text" :required="'vuelidate'" :errors="errors" :fields="impostos"></vue-input>
                    </div>
                    <div class="col-6">
                        <vue-input label="Valor do complemento do IPI" name="valor_ipi" type="text" :required="'vuelidate'" :errors="errors" :fields="impostos"></vue-input>
                    </div>
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
                money: {
                    decimal: '.',
                    thousands: ',',
                    precision: 2,
                },
                opcoesSituacaoTributaria: {},
                form_icms: false,
                form_icms_st: false,
                form_ipi: false
            }
        },
        computed: mapState({
            opcoesOrigemProduto: state => state.options.opcoesOrigemProduto,
            opcoesFormIcms: state => state.options.opcoesFormIcms,
            impostos: state => state.nota.impostos,
            errors: state => state.nota.errors['impostos']
        }),
        mounted() {
            this.opcoesSituacaoTributaria = {
                ...this.opcoesFormIcms['situacao_tributaria']['normal'], 
                ...this.opcoesFormIcms['situacao_tributaria']['simples']
            },
            this.impostos['show_form_icms'] = false,
            this.impostos['show_form_icms_st'] = false,
            this.impostos['show_form_ipi'] = false
        },
        methods: {
            toggleForm(name) {
                this[name] = !this[name]
            }
        }
    }
</script>