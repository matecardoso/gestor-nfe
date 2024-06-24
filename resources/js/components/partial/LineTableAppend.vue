<template>
    <tr :id="'tr_'+chave" :class="temDadosImportacao() ? 'bg-error' : ''">
        <td>
            <span v-if="isEmptyObject(lista_produtos) && loading">{{loadingText}}</span>
            <vue-select v-else :name="'nome'" :id="chave" :key="chave" :options="lista_produtos" select_label="Selecione" :text_key="'nome'" classes="form-control-sm" 
                :onchange="selectProduto" :errors="errors" :fields="fields"></vue-select>
        </td>
        <td>
            <span v-if="((isEmptyObject(produtos[chave]) && linha === chave)  || linhaNovaSelecao === chave) && loading">{{loadingText}}</span>
            <input v-else type="text"  :name="'codigo_cfop_'+chave" data-name="codigo_cfop" 
                :class="[{ 'border-danger' : errors && errors['codigo_cfop']}, 'form-control form-control-sm']" 
                :value="produtos[chave] !== undefined && !isEmptyObject(produtos[chave]) ? produtos[chave]['impostos']['icms']['codigo_cfop'] : ''" @input="inputProduto" />
            <div v-if="errors && errors['codigo_cfop']" class="text-danger text-xs">{{ errors['codigo_cfop'][0] }}</div>
        </td>
        <td>
            <span v-if="((isEmptyObject(produtos[chave]) && linha === chave) || linhaNovaSelecao === chave) && loading">{{loadingText}}</span>
            <input v-else type="text" :name="'unidade_'+chave" placeholder="Ex: UN, KG..." 
                :class="[{ 'border-danger' : errors && errors['unidade']}, 'form-control form-control-sm']" 
                disabled data-name="unidade" :value="produtos[chave] !== undefined ? produtos[chave]['unidade'] : ''" />
            <div v-if="errors && errors['unidade']" class="text-danger text-xs">{{ errors['unidade'][0] }}</div>
        </td>
        <td>
            <span v-if="((isEmptyObject(produtos[chave]) && linha === chave)  || linhaNovaSelecao === chave) && loading">{{loadingText}}</span>
            <input v-else type="text" class="form-control form-control-sm" :name="'quantidade_'+chave" data-name="quantidade" 
                :class="[{ 'border-danger' : errors && errors['quantidade']}, 'form-control form-control-sm']" 
                :value="produtos[chave] !== undefined ? produtos[chave]['quantidade'] : 0" @input="inputProduto" />
            <div v-if="errors && errors['quantidade']" class="text-danger text-xs">{{ errors['quantidade'][0] }}</div>
        </td>
        <td>
            <span v-if="((isEmptyObject(produtos[chave]) && linha === chave)  || linhaNovaSelecao === chave) && loading">{{loadingText}}</span>
            <input v-else type="text" :name="'subtotal_'+chave" data-name="subtotal" 
                :class="[{ 'border-danger' : errors && errors['subtotal']}, 'form-control form-control-sm']" 
                :value="produtos[chave] !== undefined ? produtos[chave]['subtotal'] : 0" @input="inputProduto" />
            <div v-if="errors && errors['subtotal']" class="text-danger text-xs">{{ errors['subtotal'][0] }}</div>
        </td>
        <td :id="'tr_'+chave+'_total'">
            <input type="text" class="form-control form-control-sm" :name="'total_'+chave" disabled data-name="total" v-model="total" />
        </td>
        <!-- <td>
            <span v-if="((isEmptyObject(produtos[chave]) && linha === chave)  || linhaNovaSelecao === chave) && loading">{{loadingText}}</span>
            <a v-else v-show="produtos[chave] !== undefined" href="" data-toggle="modal" data-target="#myModal" @click="setChaveProduto">Informar tributos</a>
        </td> -->
        <td class="text-right">
            <span v-if="((isEmptyObject(produtos[chave]) && linha === chave)  || linhaNovaSelecao === chave) && loading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            <div v-else class="dropdown">
                <button class="btn" type="button" :id="'dropdownMenuButton'+chave" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-h"></i>
                </button>
                <div class="dropdown-menu" :aria-labelledby="'dropdownMenuButton'+chave">
                    <button type="button" class="dropdown-item" data-toggle="modal" data-target="#myModal" @click="editar(produtos[chave]['id'])">Editar</button>
                    <button v-if="podeRemover" type="button" class="dropdown-item" @click="remover(chave)">Remover</button>
                </div>
            </div>
        </td>
    </tr> 
</template>

<script>
    import { mapState } from 'vuex';
    export default {
        props: ['titulos', 'editar', 'fields', 'errors', 'chave', 'remover', 'editar', 'lista_produtos', 'podeRemover'],
        data() {
            return {
                total: 0,
                loadingText: 'Carregando...'
            }
        },
        computed: mapState({
            produtos: state => state.nota.produtos,
            loading: state => state.nota.loading,
            linhaNovaSelecao: state => state.nota.linhaNovaSelecao,
            linha: state => state.nota.linha,
            emissao: state => state.nota.emissao
        }),
        mounted() {
            this.setIndiceProduto(this.chave)
            this.$store.commit('SET_LINHA', this.chave)
        },
        methods: {
            inputProduto(event) {
                var dataName = event.target.dataset.name

                var params = {
                    'valor': event.target.value,
                    'chave': this.chave,
                    'campo': dataName
                }

                this.$store.commit('SET_PRODUTO_CAMPO', params)

                if((dataName == 'quantidade' || dataName == 'subtotal') && this.produtos[this.chave]['quantidade'] && this.produtos[this.chave]['subtotal']) {

                    this.$store.commit('SUBTRAI_TOTAL', this.total)
                    this.total = this.floatval(this.produtos[this.chave]['quantidade']) * this.floatval(this.produtos[this.chave]['subtotal'])
                    this.$store.commit('SOMA_TOTAL', this.total)

                    var params = {
                        'valor': this.total,
                        'chave': this.chave,
                        'campo': 'total'
                    }

                    this.$store.commit('SET_PRODUTO_CAMPO', params)
                }
            },
            selectProduto(event) {
                this.$store.commit('SET_LINHA_NOVA_SELECAO', this.chave)
                this.$store.commit('SET_LINHA', null)
                var params = {
                    'id': event.target.value, // id do produto
                    'chave': this.chave // linha da tabela
                }
                this.$store.dispatch('getProduto', params)
            },
            setIndiceProduto(indice) {
                this.$store.commit('SET_INDICE_PRODUTO', indice)
            },
            // setChaveProduto() {
            //     this.$store.commit('SET_CHAVE_PRODUTO', this.chave)
            // }
            temDadosImportacao() {
                if(this.emissao == 'importacao') {
                    return this.produtos && this.produtos[this.chave] && !this.isEmpty(this.produtos[this.chave]) && this.produtos[this.chave].hasOwnProperty('impostos') && this.produtos[this.chave]['impostos'].hasOwnProperty('importacao') && this.isEmpty(this.produtos[this.chave]['impostos']['importacao'])
                }
                return false
            }
        }
    }
</script>

<style scoped>
    td:first-of-type {
      padding-left: 0 !important;
    }
    td:last-of-type {
      padding-right: 0 !important;  
    }
    td {
        border-top: 0;
        vertical-align: middle;
        max-width: 50vw;
    }
</style>