<template>
    <div class="card">

        <div class="card-header">

            <h3 class="card-title">Produtos</h3>

            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <button type="button" class="btn btn-block bg-gradient-primary" data-toggle="modal" data-target="#myModal" @click="setProduto(null)">Cadastrar novo</button>
                </div>
            </div>

        </div>

        <vue-table
            :key="novoCadastro"
            :rota="$routes.route('produtos')"
            :titulos="['#', 'Nome', 'Código', 'NCM', 'Valor']"
            :editar="setProduto"
        ></vue-table>

        <modal-produto :key="produto_id" :produto_id="produto_id" :onClose="onClose"></modal-produto>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                produto_id: null,
                novoCadastro: 0
            }
        },
        methods: {
            setProduto(num) {
                this.produto_id = num
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
