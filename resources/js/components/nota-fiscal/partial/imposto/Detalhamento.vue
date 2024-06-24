<template>
    <div class="mt-3">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <vue-select label="Tipo do produto" name="tipo_detalhamento" :options="opcoesTiposProduto" select_label="Selecionar" text_key="nome" :errors="errors" :fields="fields"></vue-select>
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
                opcoesTiposProduto: {}
            }
        },
        created() {
            this.rotaOpcoesForm = this.$routes.route('opcoes.form-detalhamento')
        },
        mounted() {
            this.getOpcoesForm()
        },
        methods: {
            getOpcoesForm() {
                axios.get(this.rotaOpcoesForm)
                    .then(response => {
                        this.opcoesTiposProduto = response.data['tipos_produto']
                    });
            },
        }
    }
</script>