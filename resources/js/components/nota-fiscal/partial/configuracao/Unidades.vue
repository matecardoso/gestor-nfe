<template>
    <div class="card-body">

        <div class="card-header">

            <h3 class="card-title">Unidades de medida</h3>

            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 110px;">
                    <button type="button" class="btn btn-block btn-sm bg-gradient-primary" data-toggle="modal" data-target="#myModal">Cadastrar nova</button>
                </div>
            </div>

        </div>

        <div class="table-responsive">
            <table class="table m-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Sigla</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="unidade in unidades" :key="unidade.id">
                        <td>{{unidade.id}}</td>
                        <td>{{unidade.descricao}}</td>
                        <td>{{unidade.valor}}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <modal-unidade :onClose="onClose"></modal-unidade>
    </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
    data() {
        return {
            novoCadastro: 0
        }
    },       
    computed: {
        ...mapState({
            unidades: state => state.configuracoes.unidades,
        })
    },
    created() {
        this.$store.dispatch('getUnidades')
    },
    methods: {
        onClose() {
            this.$store.dispatch('getUnidades')
        }
    }
}
</script>