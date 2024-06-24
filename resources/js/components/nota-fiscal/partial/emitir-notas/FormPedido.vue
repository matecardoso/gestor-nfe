<template>
    <div class="px-2">

        <form-pedido :fields="pedido" :errors="errors"></form-pedido>

        <vue-append :component="'form-pagamento'" button_text="Adicionar meio de pagamento" :fields="pedido['pagamento']" :errors="errors"></vue-append>

        <form-fatura :fields="pedido['fatura']" :errors="errors"></form-fatura>

        <vue-append :component="'form-parcela'" button_text="Adicionar parcela" :fields="pedido['parcelas']" :errors="errors"></vue-append>

    </div>
</template>

<script>
import { mapState } from 'vuex';
export default {
    data() {
        return {
            errors: {}
        }
    },
    computed: mapState({
        pedido: state => state.nota.pedido
    })
}
</script>