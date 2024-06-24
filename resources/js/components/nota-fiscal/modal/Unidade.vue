<template>
    <vue-modal title="Cadastrar unidade" modal_class="modal-md" :id="modalId" ref="formContainer">

        <template v-slot:body>

            <form @submit.prevent="submit" :id="formId">

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <vue-input label="Nome" :required="true" name="nome" type="text" :errors="errors" :fields="fields"></vue-input>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <vue-input label="Sigla" :required="true" name="sigla" type="text" :errors="errors" :fields="fields"></vue-input>
                        </div>
                    </div>
                </div>

            </form>

        </template>

        <template v-slot:footer>
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            <button type="submit" :form="formId" class="btn btn-primary">Salvar</button>
        </template>

    </vue-modal>
</template>

<script>
    export default {
        props: ['onClose'],
        data() {
            return {
                modalId: 'myModal',
                formId: 'form',

                fields: {},
                errors: {},
            }
        },
        methods: {
            submit() {
                let loader = this.$loading.show();
                this.errors = {};
                axios.post('configuracao/unidades/cadastrar', this.fields).then(response => {
                    this.fields = {}; //Clear input fields.
                    this.loaded = true;
                    this.success = true;
                    this.onClose()
                    $('#'+this.modalId).modal('hide')
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