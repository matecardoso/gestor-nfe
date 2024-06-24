<template>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th v-for="titulo in titulos" :key="titulo">{{titulo}}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="data in laravelData.data" :key="data.id">
                    <td v-for="item in data" :key="item">{{item}}</td>
                    <td class="text-right">
                        <div class="dropdown">
                            <button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" @click="editar(data.id)" data-toggle="modal" data-target="#myModal">Editar</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr v-if="loading">
                    <td colspan="5" class="text-center">
                        <vue-loading texto="Carregando dados..."></vue-loading>
                    </td>
                </tr>
                <tr v-if="empty">
                    <td colspan="5" class="text-center">
                        <h5>Nenhum dado encontrado</h5>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="ml-3 mt-3">
            <vue-pagination 
                :data="laravelData"  
                @pagination-change-page="getResults"
                :show-disabled="false"
                :limit="2"
                size="default"
            ></vue-pagination>
        </div>

    </div>    
</template>

<script>
    export default {
        props: ['rota', 'titulos', 'editar'],
        data() {
            return {
                // Our data object that holds the Laravel paginator data
                laravelData: {},
                loading: true,
                empty: false,
            }
        },
        created() {
            // Fetch initial results
            this.getResults();
        },
        methods: {
            // Our method to GET results from a Laravel endpoint
            getResults(page = 1) {
                axios.get(this.rota + '?page=' + page)
                    .then(response => {
                        this.laravelData = response.data;
                        this.loading = false;
                        this.empty = this.isEmptyObject(response.data.data)
                    });
            }
        }
    }
</script>