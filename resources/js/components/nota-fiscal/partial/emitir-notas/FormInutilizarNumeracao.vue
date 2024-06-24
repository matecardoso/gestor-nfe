<template>
    <div class="col-12">

        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <vue-input label="Série da numeração" name="serie" type="text" :required="'vuelidate'" :errors="errors" :fields="fields"></vue-input>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <vue-input label="Numeração inicial" name="numeracao_inicial" type="text" :required="'vuelidate'" :errors="errors" :fields="fields"></vue-input>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <vue-input label="Numeração final" name="numeracao_final" type="text" :required="'vuelidate'" :errors="errors" :fields="fields"></vue-input>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <vue-textarea label="Justificativa da inutilização" name="motivo_inutilizacao" rows="3" type="text" :required="'vuelidate'" :errors="errors" :fields="fields"></vue-textarea>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import { mapState } from 'vuex';
    export default {
        data() {
            return {
                fields: {}
            }
        },
        computed: mapState({
            errors: state => state.nota.errors['impostos']
        })
    }
</script>