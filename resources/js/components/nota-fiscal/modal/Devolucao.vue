<template>
    <vue-modal title="Emitir devolução" modal_class="modal-lg" id="myModalDevolucao" ref="formContainer">

        <template v-slot:body>

            <form @submit.prevent="submit" id="formDevolucao">
   
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <vue-input label="Natureza da Operação" :required="true" name="natureza_operacao" type="text" value="Devolução de mercadoria" :errors="errors" :fields="fields"></vue-input>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <vue-input label="CFOP" :required="true" name="cfop" type="text" :errors="errors" :fields="fields"></vue-input>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <vue-input label="Volume" name="volume" type="text" :tooltip="'Quantidade de volumes transportados (Opcional)'" :errors="errors" :fields="fields"></vue-input>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="produto">Produtos inclusos na devolução</label>
                            <div v-if="!isEmptyObject(produtos)">
                                <div v-for="produto in produtos" :key="'produto_'+produto['id']" class="row">
                                    <div class="col-md-8">
                                        <vue-checkbox :label="produto['nome']" :name="produto['id']" :value="produto['id']" :checked="true" :fields="fields.produtos.ativo"></vue-checkbox>
                                    </div>
                                    <div class="col-md-4">
                                        <vue-input :placeholder="'Quant. devolução ('+produto.unidade+') ( Máx: '+produto['quantidade']+' )'" :name="produto['id']" type="text" :errors="errors" :fields="fields.produtos.quantidade"></vue-input>
                                    </div>
                                </div>
                            </div>
                            <div v-else class="text-center">
                                <vue-loading texto="Buscando produtos..."></vue-loading>
                            </div>
                        </div>
                    </div>
                </div>

            </form>

        </template>

        <template v-slot:footer>
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            <button type="submit" form="formDevolucao" class="btn btn-primary">Salvar</button>
        </template>

    </vue-modal>
</template>

<script>
    export default {
        props: ['onClose', 'idNota', 'chaveNota'],
        data() {
            return {
                fields: { produtos: {
                    ativo:  {},
                    quantidade: {}
                } },
                errors: {},
                produtos: {}
            }
        },
        mounted() {
            this.getNota()
        },
        methods: {
            getNota() {
                // let loader = this.$loading.show();
                axios.get('nota-fiscal/nota?chave='+this.chaveNota).then(response => {
                    this.produtos = response.data.produtos
                    // loader.hide();
                }).catch(error => {
                    loader.hide();
                });
            },
            submit() {
                let loader = this.$loading.show();
                this.scrollTop();
                this.errors = {};
                axios.post('nota-fiscal/devolucao?chave='+this.chaveNota, this.fields).then(response => {
                    this.fields = { produtos: {
                            ativo:  '',
                            quantidade: ''
                        } }; //Clear input fields.
                    this.loaded = true;
                    this.success = true;
                    this.onClose(response.data)
                    $('#myModalDevolucao').modal('hide')
                    loader.hide();
                }).catch(error => {
                    this.loaded = true;
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                    }
                    loader.hide();
                });

            },
        }
    }
</script>