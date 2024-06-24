<template>
    <vue-modal title="Cancelar nota fiscal" modal_class="modal-md">

        <template v-slot:body>

            <form @submit.prevent="submit" id="form">

                <div class="row">
                    <div class="col-12">
                        <vue-textarea label="Motivo do cancelamento" :required="true" name="motivo" rows="3" type="text" :errors="errors" :fields="fields"></vue-textarea>
                    </div>
                </div>

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
        props: ['onClose', 'idNota', 'chaveNota'],
        data() {
            return {
                fields: {},
                errors: {},
                success: false,
                loaded: true,
                loading: true,
            }
        },
        created() {
            this.rotaCancelamento = this.$routes.route('nota-fiscal.cancelar')
        },
        mounted() {
            this.fields['chave'] = this.chaveNota,
            this.fields['id'] = this.idNota
        },
        methods: {
            submit() {
                let loader = this.$loading.show();
                this.scrollTop();
                if (this.loaded) {
                    this.loaded = false;
                    this.success = false;
                    this.errors = {};
                    axios.post(this.rotaCancelamento, this.fields).then(response => {
                        this.fields = {}; //Clear input fields.
                        this.loaded = true;
                        this.success = true;
                        this.onClose(response.data)
                        $('#myModal').modal('hide')
                        loader.hide();
                    }).catch(error => {
                        this.loaded = true;
                        if (error.response.status === 422) {
                            this.errors = error.response.data.errors || {};
                        }
                        loader.hide();
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