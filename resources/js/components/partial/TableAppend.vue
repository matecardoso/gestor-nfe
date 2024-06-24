<template>
    <div class="card-body table-responsive p-0">

        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th v-for="titulo in titulos" :key="titulo">{{titulo}}</th>
                </tr>
            </thead>
            <tbody>
                <vue-line-table-append v-for="(content, index) in line_keys" :key="index" :chave="index" :errors="errors[index]" :fields="fields[index]" 
                    :remover="removeRow" :podeRemover="ObjectLength(fields) > 1" :editar="setProduto" :lista_produtos="lista_produtos"/>       
            </tbody>
        </table>

        <div class="mt-2 float-right">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal" @click="setProduto(null)">
                Cadastrar novo
            </button>

            <button type="button" class="btn btn-sm btn-primary" @click="addRow" :disabled="loading">
                <span v-if="loading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Adicionar
            </button>
        </div>

        <!-- <modal-tributacao :errors="errors" :fields="fields" /> -->
        <modal-produto :key="produto_id" :produto_id="produto_id" :onClose="onClose"></modal-produto>
        
    </div>    
</template>

<script>
    import { mapState } from 'vuex';
    export default {
        props: ['titulos', 'editar', 'fields'],
        data() {
            return {
                line_keys: [0],
                key_line_keys: 0,
                produto_id: null,
                novoCadastro: false
            }
        },
        computed: mapState({
            loading: state => state.nota.loading,
            lista_produtos: state => state.nota.lista_produtos,
            total: state => state.nota.total,
            errors: state => state.nota.errors['produtos'],
            produtos: state => state.nota.produtos
        }),
        created() {
            this.fields[this.key_line_keys] = {}
        },
        mounted() {
            this.$store.dispatch('getOpcoesSelectProduto')
        },
        methods: {
            addRow() {
                this.key_line_keys++
                this.fields[this.key_line_keys] = {}
                this.line_keys.push(this.key_line_keys)
            },
            removeRow(chave) {
                this.$store.commit('SUBTRAI_TOTAL', this.floatval($('#tr_'+chave+'_total > input').val()))
                $('#tr_'+chave).remove()
                delete this.fields[chave]
                this.$store.commit('REMOVE_PRODUTO', chave)
            },
            setProduto(num) {
                this.produto_id = num
            },
            onClose() {
                this.$store.dispatch('getOpcoesSelectProduto')

                if(this.produto_id) {
                    // console.log(this.produtos)
                }

                this.produto_id = null
            }
        }
    }
</script>

<style scoped>
    th:first-of-type {
      padding-left: 0 !important;
    }

    th:last-of-type {
      padding-right: 0 !important;  
    }
</style>