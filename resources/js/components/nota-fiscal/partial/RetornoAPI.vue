<template>
    <div v-if="retorno != undefined && retorno != null" :class="retorno.status == 'aprovado' || retorno.status == 'cancelado' ? 'alert alert-default-success' : 'alert alert-default-danger'">

        <div class="text-bold text-capitalize">
            {{retorno.status}}
        </div>

        <div v-if="retorno.error">
            {{retorno.error}}
        </div>
        
        <div v-if="retorno.log != undefined && retorno.log != null">
            {{retorno.log.aProt ? retorno.log.aProt[0].xMotivo : retorno.log.xMotivo}}
        </div>

    </div>
</template>

<script>
export default {
    props: ['retorno']
}
</script>
