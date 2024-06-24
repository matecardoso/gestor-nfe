<template>
<div class="col-12">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <vue-input v-if="!show_consumidor_final" label="Nome completo" :required="'vuelidate'" name="nome_completo" type="text" :errors="errors" :fields="fields" :loading="loading"></vue-input>
                <vue-search-input v-if="show_consumidor_final" label="Nome completo" :required="'vuelidate'" name="nome_completo" type="text" :errors="errors" :fields="fields" :loading="loading" :searchFields="clientes" searchKey="Nome/Razão social" :onSelect="getCliente"></vue-search-input>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <vue-input label="Identificação (Passaporte ou outro documento legal)" name="cpf_cnpj" type="text" :errors="errors" :fields="fields" :loading="loading"></vue-input>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <vue-select label="País" :required="'vuelidate'" name="uf" :options="paises" select_label="Selecione" :errors="errors" :fields="fields" :loading="loading"></vue-select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <vue-input label="Endereço" :required="'vuelidate'" name="endereco" type="text" :errors="errors" :fields="fields" :loading="loading"></vue-input>
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <vue-input label="Número" :required="'vuelidate'" name="numero" type="text" :errors="errors" :fields="fields" :loading="loading"></vue-input>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <vue-input label="Complemento" name="complemento" type="text" :errors="errors" :fields="fields" :loading="loading"></vue-input>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <vue-input label="Bairro" :required="'vuelidate'" name="bairro" type="text" :errors="errors" :fields="fields" :loading="loading"></vue-input>
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
                showSalvarCliente: true,
                loading: false,
            }
        },
        computed: {
            ...mapState({
                paises: state => state.options.paises,
                clientes: state => state.cliente.clientes,
                errors: state => state.nota.errors['cliente']
            })
        },
        created() {
            if(this.show_consumidor_final) {
                this.$store.dispatch('getClientes', '?paginate=0&tipo=estrangeiro')
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
