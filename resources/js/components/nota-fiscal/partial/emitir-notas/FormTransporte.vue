<template>
<div class="col-12">
    <h4 class="pt-2">Informações de Transporte</h4>
    <hr>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <vue-select label="Modalidade do frete*" name="modalidade_frete" :options="opcoesModalidadeFrete" :onchange="selectModalidadeFrete" :show_key="true" :errors="errors" :fields="pedido"></vue-select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <vue-select v-if="ocorrenciaTransporte" label="Forma de envio" name="forma_envio" :options="opcoesFormasEnvio" :onchange="selectFormaEnvio" :errors="errors" :fields="fields"></vue-select>
            </div>
        </div>
    </div>
    <div v-if="ocorrenciaTransporte" class="row">
        <div class="col-3">
            <div class="form-group">
                <vue-input label="Total frete" name="frete" type="text" :errors="errors" :fields="pedido"></vue-input>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <vue-input label="Qtd. Volumes" name="volume" type="text" :errors="errors" :fields="transporte"></vue-input>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <vue-input label="Peso bruto" name="peso_bruto" type="text" value="0" :errors="errors" :fields="transporte"></vue-input>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <vue-input label="Peso líquido" name="peso_liquido" type="text" value="0" :errors="errors" :fields="transporte"></vue-input>
            </div>
        </div>
    </div>
    <div v-if="ocorrenciaTransporte" class="row">
        <div class="col-3">
            <div class="form-group">
                <vue-input label="Espécie" name="especie" type="text" :errors="errors" :fields="transporte"></vue-input>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <vue-input label="Marca" name="marca" type="text" :errors="errors" :fields="transporte"></vue-input>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <vue-input label="Numeração" name="numeracao" type="text" :errors="errors" :fields="transporte"></vue-input>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <vue-input label="Número dos lacres" name="lacres" type="text" :errors="errors" :fields="transporte"></vue-input>
            </div>
        </div>
    </div>
    <div v-if="ocorrenciaTransporte && (formaEnvio === 'transportadora')" class="row">
        <div class="col-12">
            <vue-checkbox label="Informar dados da transportadora" name="show_form_transportadora" value="show" :onchange="selectInformarDadosTransportadora" :fields="fields" />
        </div>
    </div>

    <form-transportadora v-if="show_form_transportadora && ocorrenciaTransporte" :errors="errors" :fields="transporte"></form-transportadora>
   
</div>
</template>

<script>
import { mapState } from 'vuex';
export default {
    data() {
        return {
            fields: {},
            show_form_transportadora: false,
            formaEnvio: '',
            ocorrenciaTransporte: true,
            opcoesModalidadeFrete: {
                '0' : 'Contratação do Frete por conta do Remetente (CIF)',
                '1' : 'Contratação do Frete por conta do Destinatário (FOB)',
                '2' : 'Contratação do Frete por conta de Terceiros',
                '3' : 'Transporte Próprio por conta do Remetente',
                '4' : 'Transporte Próprio por conta do Destinatário',
                '9' : 'Sem Ocorrência de Transporte'
            },
            opcoesFormasEnvio: {
                'correios' : 'Correios',
                'transportadora' : 'Transportadora',
                'outros' : 'Outros',
            } 
        }
    },
    computed: mapState({
        pedido: state => state.nota.pedido,
        transporte: state => state.nota.transporte,
        errors: state => state.nota.errors['transporte']
    }),
    methods: {
        selectFormaEnvio(event) {
            this.formaEnvio = event.target.value
        },
        selectInformarDadosTransportadora(event) {
            this.show_form_transportadora = !this.show_form_transportadora
        },
        selectModalidadeFrete(event) {
            if(event.target.value == 9) {
                this.ocorrenciaTransporte = false
            } else {
                this.ocorrenciaTransporte = true
            }
        }
    }
}
</script>