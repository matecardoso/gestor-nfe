<template>
    <div>

        <form @submit.prevent="submit" :key="formKey">

            <vue-retorno-api :retorno="retorno"></vue-retorno-api>

            <div v-for="(error, name) in errors" :key="name+'_'+formKey">
                <p v-if="!isEmptyObject(error)" class="alert alert-default-danger">Existem dados obrigatórios não informados na aba {{ abaErro(name) }}</p>
            </div>

            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-4">
                            <vue-select label="Finalidade" :required="true" name="finalidade" :options="opcoesFinalidade" :onchange="selectFinalidade" :errors="errorsOperacao" objeto="operacao" :fields="operacao"></vue-select>
                        </div>
                        <div v-if="finalidade != 5 && finalidade != 6" class="col-4">
                            <vue-select label="Tipo de emissão" :required="true" name="operacao" :options="opcoesOperacao" :onchange="changeForm" :errors="errorsOperacao" objeto="operacao" :fields="operacao"></vue-select>
                        </div>
                        <div v-if="finalidade != 5 && finalidade != 6" class="col-4">
                            <vue-input label="Natureza da operação" name="natureza_operacao" type="text" :errors="errorsOperacao" objeto="operacao" :fields="operacao"></vue-input>
                        </div>
                    </div>

                    <div v-if="finalidade == 2" class="row mt-3">
                        <div class="col-4">
                            <vue-select label="Complementar" :required="true" name="nfe_complementar" :options="opcoesTipoComplementar" :onchange="selectTipoComplementar" :errors="errorsOperacao" objeto="operacao" :fields="operacao"></vue-select>
                        </div>
                        <div class="col-8">
                            <vue-input label="Chave de acesso da NF-e emitida anteriormente" :required="true" name="nfe_referenciada" type="text" :errors="errorsOperacao" objeto="operacao" :fields="operacao"></vue-input>
                        </div>
                    </div>

                    <div v-if="finalidade == 4" class="row mt-3">
                        <div class="col-12">
                            <vue-input label="Chave de acesso da NF-e emitida anteriormente" :required="true" name="nfe_referenciada" type="text" :errors="errorsOperacao" objeto="operacao" :fields="operacao"></vue-input>
                        </div>
                    </div>                 
                    
                </div>
            </div>
        
            <div class="card">

                <div class="card-body">
                    <vue-tab-panel ul_class="mb-3" :errors="errors" :fields="fields" :tabs="showTabs()"></vue-tab-panel>
                </div>

                <div class="card-footer">
                    <!-- <button v-if="!enviar" type="submit" class="btn btn-primary float-right">Avançar</button> -->
                    <button type="submit" class="btn btn-primary float-right">Enviar</button>
                </div>

            </div>  

        </form>

    </div>
</template>

<script>
import { mapGetters, mapState } from 'vuex';

export default {
    data() {
        return {
            success: false,
            loaded: true,
            finalidade: null,
            opcoesFinalidade: {
                1 : 'NF-e normal',
                2 : 'NF-e complementar',
                3 : 'NF-e de ajuste',
                4 : 'Devolução/Retorno',
                5 : 'Carta de Correção',
                6 : 'Inutilizar Numeração',
            },
            opcoesTipoComplementar: {
                'preco_quantidade' : 'Preço e/ou Quantidade',
                'impostos' : 'Impostos'
            },
            tipoComplementar: '',
            retorno: null,

            isLoading: false,
            fullPage: true,

            nota: null,
            tabs: this.showTabs()
        }
    },         
    computed: {
        ...mapState({
            operacao: state => state.nota.operacao,
            opcoesOperacao: state => state.options.opcoesOperacao,
            formKey: state => state.nota.formKey,
            errorsOperacao: state => state.nota.errors['operacao'],
            errors: state => state.nota.errors
        }),
        ...mapGetters(['fields'])
    },
    created() {
        this.rotaEnviar = this.$routes.route('nota-fiscal.enviar')
    },
    methods: {
        submit() {
            if (this.loaded) {
                this.loaded = false;
                this.success = false;
                this.retorno = null;

                let loader = this.$loading.show();
                this.$store.commit('LIMPA_ERRORS_FORM');
                this.scrollTop();

                axios.post(this.rotaEnviar, this.fields(this.finalidade)).then(response => {

                    this.retorno = response.data

                    // this.fields = {}; //Clear input fields.
                    this.loaded = true;
                    this.success = true;

                    if(this.retorno.status == 'aprovado') {
                        this.$store.dispatch('resetState')
                    }
                    loader.hide();

                }).catch(error => {
                    this.loaded = true;
                    if (error.response.status === 422) {
                        this.$store.commit('SET_ERRORS_FORM', error.response.data.errors || {})
                    }
                    loader.hide();
                });
            }
        },
        changeForm(event) {
            this.$store.commit('SET_EMISSAO', event.target.value)
            if(event.target.value == 'importacao' || event.target.value == 'exportacao') {
                this.$store.commit('SET_FORM_EMISSAO', 'estrangeiro')
            } else {
                this.$store.commit('SET_FORM_EMISSAO', null)
            }
        },
        selectFinalidade(event) {
            this.finalidade = event.target.value
            this.retorno = null
            this.$store.commit('LIMPA_ERRORS_FORM');
            this.tabs = this.showTabs()
        },
        showTabs() {
            return {
                'cliente-emitir' : {
                    'label' : 'Cliente',
                    'show' : this.array_contains(['1','2','3','4'], this.finalidade),
                    'tab_icon' : 'fas fa-user',
                    'active' : true
                },
                'produto-emitir' : {
                    'label' : 'Produtos',
                    'show' : (this.array_contains(['1','4'], this.finalidade) || (this.array_contains(['2'], this.finalidade) && this.tipoComplementar == 'preco_quantidade')),
                    'tab_icon' : 'fas fa-shopping-cart'
                },
                'transporte-emitir' : {
                    'label' : 'Transporte',
                    'show' : this.array_contains(['1','4'], this.finalidade),
                    'tab_icon' : 'fas fa-truck'
                },
                'pedido-emitir' : {
                    'label' : 'Pedido',
                    'show' : this.array_contains(['1','4'], this.finalidade),
                    'tab_icon' : 'fas fa-file'
                },
                'impostos-emitir' : {
                    'label' : 'Impostos',
                    'show' : (this.array_contains(['2'], this.finalidade) && this.tipoComplementar == 'impostos'),
                    'tab_icon' : 'fas fa-file'
                },
                'ajuste-emitir' : {
                    'label' : 'Ajuste',
                    'show' : this.array_contains(['3'], this.finalidade),
                    'tab_icon' : 'fas fa-file'
                },
                'carta-correcao-emitir' : {
                    'label' : 'Carta correção',
                    'show' : this.array_contains(['5'], this.finalidade),
                    'tab_icon' : 'fas fa-file',
                    'active' : true
                },
                'inutilizar-numeracao-emitir' : {
                    'label' : 'Inutilizar numeração',
                    'show' : this.array_contains(['6'], this.finalidade),
                    'tab_icon' : 'fas fa-file',
                    'active' : true
                },
            }
        },
        selectTipoComplementar(event) {
            this.tipoComplementar = event.target.value
            this.tabs = this.showTabs()
        },
        abaErro(name) {
            if(name == 'impostos') {
                if(this.operacao.finalidade == 3) {
                    return 'ajuste'
                } else if(this.operacao.finalidade == 6) {
                    return 'inutilizar numeração'
                }
            } else if(this.operacao.finalidade == 5 && name == 'carta_correcao') {
                return 'carta correção'
            }
            return name
        }
    },
}
</script>
