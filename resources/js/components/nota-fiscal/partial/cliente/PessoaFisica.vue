<template>
<div class="col-12">
    <div class="row">
        <div :class="show_consumidor_final ? 'col-4' : 'col-6'">
            <div class="form-group">
                <vue-input v-if="!show_consumidor_final" label="Nome completo*" name="nome_completo" type="text" :errors="errors" :fields="fields" :loading="loading"></vue-input>
                <vue-search-input v-if="show_consumidor_final" label="Nome completo*" name="nome_completo" type="text" :errors="errors" :fields="fields" :loading="loading" :searchFields="clientes" searchKey="Nome/Razão social" :onSelect="getCliente"></vue-search-input>
            </div>
        </div>
        <div :class="show_consumidor_final ? 'col-4' : 'col-6'">
            <div class="form-group">
                <vue-input label="CPF*" name="cpf_cnpj" type="text" v-mask="'###.###.###-##'" placeholder="000.000.000-00" :errors="errors" :fields="fields" :loading="loading"></vue-input>
            </div>
        </div>
        <div v-if="show_consumidor_final" class="col-4">
            <div class="form-group">
                <vue-select label="Consumidor Final (opcional)" name="consumidor_final" :options="opcoesConsumidorFinal" select_label="---" :errors="errors" :fields="fields" :loading="loading"></vue-select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <div class="form-group">
                <vue-input label="CEP*" name="cep" type="text" v-mask="'#####-###'" placeholder="00000-000" :errors="errors" :fields="fields" :loading="loading"></vue-input>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <vue-input label="Endereço*" name="endereco" type="text" :errors="errors" :fields="fields" :loading="loading"></vue-input>
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <vue-input label="Número*" name="numero" type="number" :errors="errors" :fields="fields" :loading="loading"></vue-input>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <vue-input label="Complemento" name="complemento" type="text" :errors="errors" :fields="fields" :loading="loading"></vue-input>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <vue-input label="Bairro*" name="bairro" type="text" :errors="errors" :fields="fields" :loading="loading"></vue-input>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <vue-input label="Cidade*" name="cidade" type="text" :errors="errors" :fields="fields" :loading="loading"></vue-input>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <vue-select label="Estado*" select_label="Selecione" name="uf" :options="estados" :errors="errors" :fields="fields" :loading="loading"></vue-select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <vue-input label="E-mail*" name="email" type="email" :errors="errors" :fields="fields" :loading="loading"></vue-input>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <vue-input label="Telefone*" name="telefone" type="tel" v-mask="['(##) ####-####', '(##) #####-####']" placeholder="(00) 00000-0000" :errors="errors" :fields="fields" :loading="loading"></vue-input>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 align-self-end">
            <vue-checkbox v-if="showSalvarCliente && show_consumidor_final" label="Salvar cliente" name="salvar_cliente" value="2" :fields="fields" />
        </div>
    </div>
</div>
</template>

<script>
    import { mapState } from 'vuex';
    export default {
        props: ['fields', 'show_consumidor_final'],
        data() {
            return {
                opcoesConsumidorFinal: {
                    '0' : 'Não',
                    '1' : 'Sim'
                },
                error: null,
                loading: false,
                showSalvarCliente: true
            }
        },
        computed: {
            ...mapState({
                estados: state => state.options.estados,
                clientes: state => state.cliente.clientes,
                errors: state => state.nota.errors['cliente']
            }),
        },
        created() {
            if(this.show_consumidor_final) {
                this.$store.dispatch('getClientes', '?paginate=0&tipo=pessoa-fisica')   
            }
        },
        methods: {
            getCliente(id) {
                this.loading = true
                axios.get('/cliente/'+id).then(response => {
                    Object.assign(this.fields, response.data)
                    this.showSalvarCliente = false
                    this.loading = false
                }).catch(error => {
                    this.error = error
                    this.showSalvarCliente = true
                    this.loading = false
                });
            },
        }
    }
</script>