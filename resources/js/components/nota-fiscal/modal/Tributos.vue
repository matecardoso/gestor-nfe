<template>
    <vue-modal title="Tributação" modal_class="modal-lg">

        <template v-slot:body>

            <form @submit.prevent="submit" id="form">

                <form-produto :errors="errors" :fields="produtos" :loading="true"></form-produto>

                <!-- <tributacao-complementar :errors="errors" :fields="produtos" :loading="true"></tributacao-complementar> -->

            </form>

        </template>

        <template v-slot:footer>
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            <button type="submit" form="form" class="btn btn-primary">Salvar</button>
        </template>

    </vue-modal>
</template>

<script>
    import { mapState } from 'vuex';    
    export default {
        data() {
            return {
                fields: { 
                    'impostos': {}
                },
                errors: {},
                success: false,
                loaded: true,
                loading: true,
            }
        },
        created() {
            this.rotaEnviar = this.$routes.route('produto.salvar')
        }, 
        computed: mapState({
            chave: state => state.nota.chave,
            produtos: state => state.nota.produtos[state.nota.chave]
        }),
        methods: {
            submit() {
                if (this.loaded) {
                    this.loaded = false;
                    this.success = false;
                    this.errors = {};
                    axios.post(this.rotaEnviar, this.produtos).then(response => {
                        this.$store.commit('SET_PRODUTO_BY_ID', response.data.data)
                        this.fields = {}; //Clear input fields.
                        this.loaded = true;
                        this.success = true;
                        $('#myModal').modal('hide')
                    }).catch(error => {
                        this.loaded = true;
                        if (error.response.status === 422) {
                            this.errors = error.response.data.errors || {};
                        }
                    });
                }
            },
        },
    }
</script>

<style>
    label:not(.form-check-label):not(.custom-file-label) {
        font-weight: 500;
    }
</style>