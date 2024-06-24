<template>
    <div class="col-12">
        <h5 v-if="title" class="mt-2 text-bold">{{title}}</h5>
        <div class="mb-3">
            <vue-checkbox v-if="!showCheckboxImportacao" label="Informar impostos de Importação" name="show_tab_importacao" value="importacao" :onchange="toggleTab" :fields="fields"></vue-checkbox>
            <!-- <vue-checkbox label="Informar impostos de Exportação" name="show_tab_exportacao" value="exportacao" :onchange="toggleTab" :fields="fields"></vue-checkbox>
            <vue-checkbox label="Informar Detalhamento específico" name="show_tab_detalhamento" value="detalhamento" :onchange="toggleTab" :fields="fields"></vue-checkbox> -->
        </div>
        <vue-tab-panel :errors="errors" :fields="fields" :show="true" :tabs="tabs()"></vue-tab-panel>
    </div>
</template>

<script>
    import { mapState } from 'vuex';
    export default {
        props: ['title', 'fields', 'errors'],
        data() {
            return {
                showImportacao: false,
                showCheckboxImportacao: false
            }
        },
        watch: {
            emissao() {
                this.showImportacao = this.emissao == 'importacao' ? true : false
                this.showCheckboxImportacao = this.emissao == 'importacao' ? true : false
            }
        },
        computed: mapState({
            emissao: state => state.nota.emissao
        }),
        created() {
            this.$store.commit('SET_TAB_IMPORTACAO', false)
            this.fields['icms'] = this.fields['icms'] ? this.fields['icms'] : {},
            this.fields['ipi'] = this.fields['ipi'] ? this.fields['ipi'] : {},
            this.fields['pis'] = this.fields['pis'] ? this.fields['pis'] : {},
            this.fields['cofins'] = this.fields['cofins'] ? this.fields['cofins'] : {},
            this.fields['estimativa'] = this.fields['estimativa'] ? this.fields['estimativa'] : {}
            this.fields['importacao'] = this.fields['importacao'] ? this.fields['importacao'] : {}
            this.fields['exportacao'] = this.fields['exportacao'] ? this.fields['exportacao'] : {}
            this.fields['detalhamento'] = this.fields['detalhamento'] ? this.fields['detalhamento'] : {}
        },
        mounted() {
            this.showCheckboxImportacao = !this.isEmptyObject(this.fields['importacao']) ? true : false
            this.showImportacao = !this.isEmptyObject(this.fields['importacao']) ? true : false
            this.$store.commit('SET_TAB_IMPORTACAO', this.showImportacao)
        },
        methods: {
            toggleTab(name) {
                if(name == 'importacao') {
                    this.showImportacao = !this.showImportacao
                    this.$store.commit('SET_TAB_IMPORTACAO', this.showImportacao)
                } else {
                    this.tabs[name]['show'] = !this.tabs[name]['show']
                }
            },
            tabs() {
                return {
                    'icms' : {
                        'label' : 'ICMS',
                        'show' : true,
                        'active' : true
                    },
                    'ipi' : {
                        'label' : 'IPI',
                        'show' : true
                    },
                    'pis' : {
                        'label' : 'PIS',
                        'show' : true
                    },
                    'cofins' : {
                        'label' : 'COFINS',
                        'show' : true
                    },
                    'estimativa' : {
                        'label' : 'Estimativa de Tributos',
                        'show' : true
                    },
                    'importacao' : {
                        'label' : 'Importação',
                        'show' : this.showImportacao
                    },
                    // 'exportacao' : {
                    //     'label' : 'Exportação',
                    //     'show' : false
                    //},
                    // 'detalhamento' : {
                    //     'label' : 'Detalhamento',
                    //     'show' : false
                    //},
                }
            }
        }
    }
</script>