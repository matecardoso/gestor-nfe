<template>
    <div class="col-12">
    <div class="row">
        <div :class="show_consumidor_final ? 'col-4' : 'col-6'">
            <div class="form-group">
                <vue-input v-if="!show_consumidor_final" label="Razão social*" name="razao_social" type="text" :errors="errors" :fields="fields" :loading="loading"></vue-input>
                <vue-search-input v-if="show_consumidor_final" label="Razão social*" name="razao_social" :errors="errors" :fields="fields" :loading="loading" :searchFields="clientes" searchKey="Nome/Razão social" :onSelect="getCliente"></vue-search-input>
            </div>
        </div>
        <div :class="show_consumidor_final ? 'col-4' : 'col-6'">
            <div class="form-group">
                <vue-input label="CNPJ*" name="cpf_cnpj" type="text" v-mask="'##.###.###/####-##'" placeholder="00.000.000/0000-00" :errors="errors" :fields="fields" :loading="loading"></vue-input>
            </div>
        </div>
        <div v-if="show_consumidor_final" class="col-4">
            <div class="form-group">
                <vue-select label="Consumidor Final (opcional)" name="consumidor_final" :options="opcoesConsumidorFinal" select_label="---" :errors="errors" :fields="fields" :loading="loading"></vue-select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <vue-input label="Inscrição estadual (I.E.)*" :disabled="ieIsento" name="ie" type="number" :errors="errors" :fields="fields" :loading="loading"></vue-input>
            </div>
        </div>
        <div class="col-2 align-self-center">
            <vue-checkbox label="Isento" name="isento_ie_pessoa" value="1" :onchange="setIeIsento" :fields="fields" />
        </div>
        <div class="col-3">
            <div class="form-group">
                <vue-input label="Inscrição SUFRAMA" name="suframa" type="text" :errors="errors" :fields="fields" :loading="loading"></vue-input>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <vue-select label="Substituto tributário*" name="substituto_tributario" :options="opcoesSubstitutoTributario" :errors="errors" :fields="fields" :loading="loading"></vue-select>
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
                <vue-input label="Telefone" name="telefone" type="tel" v-mask="['(##) ####-####', '(##) #####-####']" placeholder="(00) 00000-0000" :errors="errors" :fields="fields" :loading="loading"></vue-input>
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
                opcoesSubstitutoTributario: {
                    0 : 'Não',
                    1 : 'Sim'
                },
                opcoesConsumidorFinal: {
                    '0' : 'Não',
                    '1' : 'Sim'
                },
                error: null,
                loading: false,
                ieIsento: false,
                oldIe: null,
                showSalvarCliente: true
            }
        },
        computed: {
            ...mapState({
                estados: state => state.options.estados,
                clientes: state => state.cliente.clientes,
                errors: state => state.nota.errors['cliente']
            })
        },
        created() {
            if(this.show_consumidor_final) {
                this.$store.dispatch('getClientes', '?paginate=0&tipo=pessoa-juridica')
            }
        },
        mounted() {
            if(this.fields['ie'] == 0) {
                $('#checkbox-1').click()
            }
        },
        methods: {
            getCliente(id) {
                this.loading = true
                axios.get('/cliente/'+id).then(response => {
                    Object.assign(this.fields, response.data)
                    if(response.data['ie'] == 0) {
                        $('#checkbox-1').click()
                    }
                    this.showSalvarCliente = false
                    this.loading = false
                }).catch(error => {
                    this.error = error
                    this.showSalvarCliente = true
                    this.loading = false
                });
            },
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