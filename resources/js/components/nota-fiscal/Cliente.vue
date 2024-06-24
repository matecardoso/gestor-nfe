<template>
    <div class="card">

        <div class="card-header">

            <h3 class="card-title">Clientes</h3>

            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <button type="button" class="btn btn-block bg-gradient-primary" data-toggle="modal" data-target="#myModal" @click="novoCliente">Cadastrar novo</button>
                </div>
            </div>

        </div>

        <vue-table
            :key="novoCadastro" 
            :rota="$routes.route('clientes')"
            :titulos="['#', 'Nome/Razão social', 'CPF/CNPJ']"
            :editar="setCliente"
        ></vue-table>

        <modal-cliente :key="cliente_id" :cliente_id="cliente_id" :tipos_pessoa="tipos_pessoa" :onClose="onClose"></modal-cliente>
    </div>
</template>

<script>
    export default {
        props: ['tipos_pessoa'],
        data() {
            return {
                cliente_id: null,
                novoCadastro: 0
            }
        },
        methods: {
            setCliente(num) {
                this.cliente_id = num
            },
            novoCliente() {
                this.cliente_id = null
            },
            onClose() {
                this.novoCadastro++
            }
        }
    }
</script>

<style scoped>
    .card-title {
        font-size: 1.5rem;
    }
</style>
