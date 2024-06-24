<template>
    <div class="mt-3">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <vue-select label="Tipo de exportação" name="tipo_exportacao" :options="opcoesTiposExportacao" text_key="nome" :errors="errors" :fields="fields"></vue-select>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['fields', 'errors'],
        data() {
            return {
                opcoesTiposExportacao: {}
            }
        },
        created() {
            this.rotaOpcoesForm = this.$routes.route('opcoes.form-exportacao')
        },
        mounted() {
            this.getOpcoesForm()
        },
        methods: {
            getOpcoesForm() {
                axios.get(this.rotaOpcoesForm)
                    .then(response => {
                        this.opcoesTiposExportacao = response.data['tipos_exportacao']
                    });
            },
        }
    }
</script>