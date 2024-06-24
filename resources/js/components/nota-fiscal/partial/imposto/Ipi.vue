<template>
    <div class="mt-3">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <vue-select label="Situação tributária" name="situacao_tributaria" :options="opcoes['situacao_tributaria']" id="ipi" :show_key="true" text_key="nome" :errors="errors" :fields="fields"></vue-select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <vue-input label="Enquadramento" name="codigo_enquadramento" type="text" :errors="errors" :fields="fields" :set="!fields['codigo_enquadramento'] ? fields['codigo_enquadramento'] = 999 : null"></vue-input>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <vue-input label="Alíquota do IPI" name="aliquota" placeholder="0,00" value="0" :errors="errors" :fields="fields"></vue-input>
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
            opcoes: state => state.options.opcoesFormIpi
        })
    }
</script>