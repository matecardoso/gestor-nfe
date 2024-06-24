<template>
<div class="col-12">
    <h4 class="pt-2">Informações do Pedido</h4>
    <hr>
    <div class="row">
        <div class="col-3">
            <div class="form-group">
                <vue-input label="Número do pedido" name="ID" type="text" :errors="errors" :fields="fields"></vue-input>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <vue-input label="Data de Entrada ou Saída" name="data_entrada_saida" type="date" :errors="errors" :fields="fields"></vue-input>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <vue-select label="Presença*" name="presenca" :options="opcoesPresenca" :errors="errors" :fields="fields"></vue-select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <div class="form-group">
                <vue-input label="Total frete" name="frete" type="text" :errors="errors" :fields="fields"></vue-input>
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <vue-input label="Total desconto" name="desconto" type="text" :errors="errors" :fields="fields" :onchange="calculaTotal"></vue-input>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <vue-input label="Outras despesas acessórias" name="despesas_acessorias" type="text" :errors="errors" :fields="fields" :onchange="calculaTotal"></vue-input>
            </div>
        </div>
        <div class="col-5">
            <div class="form-group">
                <vue-input label="Total pedido" name="total" placeholder="0,00" :disabled="true" type="text" :errors="errors" :fields="fields"></vue-input>
            </div>
        </div>
    </div>
    <div v-if="emissao == 'importacao'" class="row">
        <div class="col-12">
            <div class="form-group">
                <vue-input label="Despesas aduaneiras (Siscomex)" name="despesas_aduaneiras" :required="'vuelidate'" type="text" :errors="errors" :fields="fields" :onchange="calculaTotal"></vue-input>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <vue-textarea label="Informações complementares" name="informacoes_complementares" rows="3" type="text" :errors="errors" :fields="fields"></vue-textarea>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <vue-textarea label="Informações ao fisco" name="informacoes_fisco" rows="3" type="text" :errors="errors" :fields="fields"></vue-textarea>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    import { mapState } from 'vuex';
    export default {
        props: ['fields'],
        data() {
            return {
                opcoesPresenca: {
                    '0' : 'Não se aplica (por exemplo, Nota Fiscal complementar ou de ajuste)',
                    '1' : 'Operação presencial',
                    '2' : 'Operação não presencial, pela Internet',
                    '3' : 'Operação não presencial, Teleatendimento',
                    '4' : 'NFC-e em operação com entrega a domicílio',
                    '5' : 'Operação presencial, fora do estabelecimento',
                    '9' : 'Operação não presencial, outros'
                },
                opcoesModalidadeFrete: {
                    '0' : 'Contratação do Frete por conta do Remetente (CIF)',
                    '1' : 'Contratação do Frete por conta do Destinatário (FOB)',
                    '2' : 'Contratação do Frete por conta de Terceiros',
                    '3' : 'Transporte Próprio por conta do Remetente',
                    '4' : 'Transporte Próprio por conta do Destinatário',
                    '9' : 'Sem Ocorrência de Transporte'
                }
            }
        },
        computed: {
            ...mapState({
                total: state => state.nota.total,
                errors: state => state.nota.errors['pedido'],
                emissao: state => state.nota.emissao
            }),
            valorFrete() {
                return this.fields.frete;
            }
        },
        watch: {
            valorFrete() {
                this.calculaTotal()
            },
            total() {
                this.calculaTotal()
            }
        },
        mounted() {
            if(this.fields['frete'] === undefined) {
                this.$set(this.fields, 'frete', 0)
                this.$set(this.fields, 'desconto', 0)
                this.$set(this.fields, 'despesas_acessorias', 0)
            }
        },
        methods: {
            calculaTotal() {
                let frete = this.fields['frete'] === undefined ? 0 : this.floatval(this.fields['frete'])
                let desconto = this.fields['desconto'] === undefined ? 0 : this.floatval(this.fields['desconto'])
                let despesas_acessorias = this.fields['despesas_acessorias'] === undefined ? 0 : this.floatval(this.fields['despesas_acessorias'])
                let despesas_aduaneiras = this.fields['despesas_aduaneiras'] === undefined ? 0 : this.floatval(this.fields['despesas_aduaneiras'])

                console.log(despesas_aduaneiras)

                var totalPedido = this.total + (frete - desconto) + despesas_acessorias + despesas_aduaneiras
                this.$set(this.fields, 'total', totalPedido)
            }
        }
    }
</script>