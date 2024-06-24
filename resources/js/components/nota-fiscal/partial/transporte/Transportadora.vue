<template>
<div>
    <h4 class="pt-2">Informações da Transportadora</h4>
    <hr>
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <vue-input label="Razão Social" name="razao_social" type="text" :errors="errors" :fields="fields"></vue-input>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <vue-input label="CNPJ" name="cnpj" type="text" :errors="errors" :fields="fields"></vue-input>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <vue-input label="Inscrição estadual (I.E)" name="ie" type="text" :disabled="ieIsento" :errors="errors" :fields="fields"></vue-input>
            </div>
        </div>
        <div class="col-1 align-self-center">
            <vue-checkbox label="Isento" name="isento_ie_transportadora" value="0" :onchange="setIeIsento" :fields="fields" />
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <div class="form-group">
                <vue-input label="CEP" name="cep" type="text" :errors="errors" :fields="fields"></vue-input>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <vue-input label="Endereço" name="endereco" type="text" :errors="errors" :fields="fields"></vue-input>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <vue-input label="Cidade" name="cidade" type="text" :errors="errors" :fields="fields"></vue-input>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <vue-select label="Estado" select_label="Selecione" name="uf" :options="estados" :errors="errors" :fields="fields"></vue-select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <div class="form-group">
                <vue-input label="Placa do Veículo" name="placa" type="text" :errors="errors" :fields="fields"></vue-input>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <vue-select label="UF Veículo" select_label="Selecione" name="uf_veiculo" :options="estados" :errors="errors" :fields="fields"></vue-select>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <vue-input label="Registro Nacional (ANTT)" name="rntc" type="text" :errors="errors" :fields="fields"></vue-input>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <vue-input label="Valor do seguro" name="seguro" type="text" :errors="errors" :fields="fields"></vue-input>
            </div>
        </div>
    </div>

    <h5 class="pt-2 pb-1">Reboque</h5>

    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <vue-input label="Placa do Veículo Reboque" tooltip="Informar em um dos seguintes formatos: XXX9999, XXX999, XX9999 ou XXXX999." name="reboque_placa" type="text" :errors="errors" :fields="fields"></vue-input>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <vue-select label="Estado onde o veículo reboque foi emplacado" select_label="Selecione" tooltip="Informar 'Exterior' se o veículo foi emplacado fora do Brasil." name="reboque_uf_veiculo" :options="estados" :errors="errors" :fields="fields"></vue-select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <vue-input label="Registro Nacional de Transportador de Carga (ANTT)" name="reboque_rntc" type="text" :errors="errors" :fields="fields"></vue-input>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <vue-input label="Identificação do vagão" name="vagao" type="text" :errors="errors" :fields="fields"></vue-input>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <vue-input label="Identificação da balsa" name="balsa" type="text" :errors="errors" :fields="fields"></vue-input>
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
            ieIsento: false,
            oldIe: null
        }
    },
    computed: mapState({
        estados: state => state.options.estados
    }),
    methods: {
        setIeIsento() {
            this.ieIsento = !this.ieIsento
            
            if(this.ieIsento) {
                this.oldIe = this.fields['ie']
                this.$set(this.fields, 'ie', 0)
            } else {
                this.$set(this.fields, 'ie', this.oldIe)
            }
 
        }
    }
}
</script>