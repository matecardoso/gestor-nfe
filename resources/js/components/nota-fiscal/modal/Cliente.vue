<template>
    <vue-modal :title="!cliente_id ? 'Novo cliente' : 'Editar cliente'" modal_class="modal-lg">

        <template v-slot:body>

            <form @submit.prevent="submit" id="form">

                <div v-show="!cliente_id && loaded" class="row">
                    <div class="col-12">
                        <div class="form-group ml-2">
                            <vue-radio name="tipo_pessoa" :options="tipos_pessoa" :onchange="changeRoute" :inline="true" :errors="errors" :fields="fields"></vue-radio>
                        </div>
                    </div>
                </div>

                <router-view v-if="((!cliente_id && loading) || (cliente_id && !loading)) && loaded" :errors="errors" :fields="fields"></router-view>

                <vue-loading v-if="(cliente_id && loading) && loaded" texto="Carregando dados..."></vue-loading>

                <vue-loading v-if="!loaded" texto="Enviando..."></vue-loading>

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
        props: ['tipos_pessoa', 'cliente_id', 'onClose'],
        data() {
            return {
                rotaSalvar: '',
                rotaEditar: '',
                rotaCliente: '',
                fields: {},
                errors: {},
                success: false,
                loaded: true,
                loading: true,
            }
        },
        created() {
            this.rotaSalvar = this.$routes.route('cliente.salvar')
            this.rotaEditar = this.$routes.route('cliente', {'cliente': this.cliente_id})
            this.rotaCliente = this.$routes.route('cliente')
        },
        mounted() {
            this.getCliente()
        },
        methods: {
            submit() {
                if (this.loaded) {
                    this.loaded = false;
                    this.success = false;
                    this.errors = {};
                    axios.post(this.rotaSalvar, this.fields).then(response => {
                        if (this.cliente_id == null || this.cliente_id == undefined) {
                            this.fields = {}; //Clear input fields.
                        }
                        this.loaded = true;
                        this.success = true;
                        $('#myModal').modal('hide')
                        this.onClose()
                    }).catch(error => {
                        this.loaded = true;
                        if (error && error.response && error.response.status === 422) {
                            this.errors = error.response.data.errors || {};
                        }
                    });
                }
            },
            getCliente() {
                if (this.cliente_id != null && this.cliente_id != undefined) {
                    this.loading = true
                    axios.get(this.rotaEditar, this.fields).then(response => {
                        this.fields = response.data
                        $('input[value='+this.fields['tipo_pessoa']+']').click();
                        this.loading = false
                    }).catch(error => {
                        console.log(error)
                    });
                } else {
                    $('input[value=pessoa-fisica]').click();
                }
            },
            changeRoute(event) {
                this.$router.push({ name: event.target.value })
            },
        },
    }
</script>

<style>
    label:not(.form-check-label):not(.custom-file-label) {
        font-weight: 500;
    }
</style>