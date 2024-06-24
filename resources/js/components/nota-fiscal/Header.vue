<template>
    <div class="col-12 mb-n2">
        <div class="row">
            <div class="col-1 text-center"></div>
            <div class="col-2 text-center">
                <router-link :to="{ name: 'nota-fiscal' }" class="btn btn-app">
                    <i class="fas fa-inbox"></i>
                    Notas fiscais
                </router-link>
            </div>
            <div class="col-2 text-center">
                <router-link :to="{ name: 'emitir' }" class="btn btn-app">
                    <i class="far fa-file-alt"></i>
                    Emitir notas
                </router-link>
            </div>
            <div class="col-2 text-center">
                <router-link :to="{ name: 'cliente' }" class="btn btn-app">
                    <i class="far fa-address-book"></i>
                    Clientes
                </router-link>
            </div>
            
            <div class="col-2 text-center">
                <router-link :to="{ name: 'produto' }" class="btn btn-app">
                    <i class="fas fa-shopping-cart"></i>
                    Produtos
                </router-link>
            </div>
            <div class="col-2 text-center">
                <router-link :to="{ name: 'configuracao' }" class="btn btn-app">
                    <i class="fas fa-cog"></i>
                    Configurações
                </router-link>
            </div>
            <div class="col-1 text-center"></div>
        </div>
    </div>
</template>

<script>
export default {
    watch:{
        $route (to, from){
            this.$store.dispatch('resetState')
        }
    }
}
</script>

