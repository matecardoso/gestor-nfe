<template>
    <vue-modal :title="!produto_id ? 'Novo produto' : 'Editar produto'" modal_class="modal-xl">

        <template v-slot:body>

            <vue-loading v-if="(produto_id && loading) && loaded" texto="Carregando dados..."></vue-loading>

            <vue-loading v-if="!loaded" texto="Enviando..."></vue-loading>

            <form v-if="(!produto_id || !loading) && loaded" @submit.prevent="submit" id="form">

                <form-produto :errors="errors" :fields="fields"></form-produto>

            </form>

        </template>

        <template v-slot:footer>
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            <button type="submit" form="form" class="btn btn-primary">Salvar</button>
        </template>

    </vue-modal>
</template>

<script>
    export default {
        props: ['tipos_pessoa', 'produto_id', 'onClose'],
        data() {
            return {
                rotaSalvar: '',
                rotaEditar: '',
                rotaProduto: '',
                fields: { 'impostos' : {
                    'icms' : {},
                    'ipi' : {},
                    'pis' : {},
                    'cofins' : {}
                } },
                errors: {},
                success: false,
                loaded: true,
                loading: true
            }
        },
        created() {
            this.rotaSalvar = this.$routes.route('produto.salvar')
            this.rotaEditar = this.$routes.route('produto', {'produto': this.produto_id})
            this.rotaProduto = this.$routes.route('produto')
        },
        mounted() {
            this.getProduto()
        },
        methods: {
            submit() {
                if (this.loaded) {
                    this.loaded = false;
                    this.success = false;
                    this.errors = {};
                    axios.post(this.rotaSalvar, this.fields).then(response => {
                        if (!this.produto_id) {
                            this.fields = { 'impostos' : { 'icms' : {}, 'ipi' : {}, 'pis' : {}, 'cofins' : {}} }
                        }
                        this.loaded = true;
                        this.success = true;
                        this.onClose()
                        $('#myModal').modal('hide')
                    }).catch(error => {
                        this.loaded = true;
                        if (error && error.response && error.response.status === 422) {
                            this.errors = error.response.data.errors || {};
                        }
                    });
                }
            },
            getProduto() {
                if (this.produto_id) {
                    axios.get(this.rotaEditar).then(response => {
                        this.fields = response.data.data
                        this.loading = false
                    }).catch(error => {
                        this.loading = false
                        console.log(error)
                    });
                }
            },
            limparCampos() {
                this.loaded = false;
                this.success = false;
                this.errors = {};
                this.fields = {};
                this.loading = false;
            }
        },
    }
</script>

<style>
    label:not(.form-check-label):not(.custom-file-label) {
        font-weight: 500;
    }
</style>