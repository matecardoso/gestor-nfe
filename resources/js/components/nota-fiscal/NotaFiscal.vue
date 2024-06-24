<template>
    <div class="row">
        <div class="col-12">

            <vue-retorno-api :retorno="retorno"></vue-retorno-api>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Notas</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Série</th>
                                <th>Número</th>
                                <th>Finalidade</th>
                                <th>Operação</th>
                                <th>Natureza</th>
                                <th>Cliente</th>
                                <th>Valor</th>
                                <th>Data</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody :key="'tbody_'+reload">
                            <tr v-if="!loading" v-for="nota in notas.data" :key="'nota_'+nota.id" >
                                <td>{{nota.id}}</td>
                                <td>{{nota.serie}}</td>
                                <td>{{nota.numero}}</td>
                                <td>{{fianlidadeNota(nota.finalidade)}}</td>
                                <td>{{opcoesOperacao[nota.operacao]}}</td>
                                <td>{{nota.natureza_operacao}}</td>
                                <td>{{nota.cliente}}</td>
                                <td>{{nota.valor}}</td>
                                <td>{{dateBR(nota.data)}}</td>
                                <td class="text-capitalize">
                                    <span :class="nota.status == 'aprovado' ? 'badge bg-success' : 'badge bg-danger'">
                                        {{ nota.status }}
                                    </span>
                                </td>
                                <td class="text-right">
                                    <div v-if="!nota.cancelada && nota.status == 'aprovado'" class="dropdown">
                                        <button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" @click="setNota(nota.id, nota.chave, 'devolucao')" data-toggle="modal" data-target="#myModalDevolucao">Emitir devolução</a>
                                            <a class="dropdown-item" @click="setNota(nota.id, nota.chave, 'cancelamento')" data-toggle="modal" data-target="#myModal">Cancelar</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr v-if="loading">
                                <td colspan="11" class="text-center">
                                    <vue-loading texto="Carregando dados..."></vue-loading>
                                </td>
                            </tr>
                            <tr v-else-if="this.isEmptyObject(this.notas.data)">
                                <td colspan="11" class="text-center">
                                    <h5>Nenhum dado encontrado</h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="ml-3 mt-3">
                        <vue-pagination 
                            :data="notas"  
                            @pagination-change-page="getResults"
                            :show-disabled="false"
                            :limit="2"
                            size="default"
                        ></vue-pagination>
                    </div>

                </div>
            </div>
        </div>
        <modal-cancelamento v-if="showModal == 'cancelamento'" :key="idNota" :idNota="idNota" :chaveNota="chaveNota" :onClose="onClose"></modal-cancelamento>
        <modal-devolucao v-if="showModal == 'devolucao'" :key="idNota" :idNota="idNota" :chaveNota="chaveNota" :onClose="onClose"></modal-devolucao>
    </div>
</template>

<script>
    import { mapState } from 'vuex';

    export default {
        data() {
            return {
                idNota: null,
                chaveNota: null,
                retorno: null,
                status: '',
                nota: {},
                reload: 0,
                showModal: null
            }
        },
        computed: mapState({
            notas: state => state.nota.notas,
            opcoesOperacao: state => state.options.opcoesOperacao,
            loading: state => state.nota.loading
        }),
        mounted() {
            this.getResults()
        },
        methods: {
            setNota(id, chave, modal) {
                this.showModal = modal
                this.idNota = id
                this.chaveNota = chave
            },
            onClose(retorno) {
                this.retorno = retorno
                this.reload++
            },
            getResults(page = 1) {
                this.$store.dispatch('getNotasFiscais', page)
            }
        }
    }
</script>

