<template>
    <div class="mt-3">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <vue-select label="Situação tributária" name="situacao_tributaria" :options="opcoes['situacao_tributaria']" id="pis" text_key="nome"  :show_key="true" :errors="errors" :fields="fields"></vue-select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <vue-input label="Alíquota do PIS" name="aliquota" placeholder="0,00" value="0" :errors="errors" :fields="fields"></vue-input>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex';
    export default {
        props: ['fields', 'errors'],
        data() {
            return {
                porcentage: {
                    decimal: '.',
                    thousands: ',',
                    suffix: ' %',
                    precision: 2,
                }
            }
        },
        computed: mapState({
            opcoes: state => state.options.opcoesFormPis
        })
    }
</script>