<template>
    <div class="col-12">

        <!-- <div class="alert alert-info"> 
            <strong>
                O que NÃO é permitido corrigir com a carta de correção?
            </strong>
            <br> - Valores como base de cálculo, alíquota, diferença de preço e quantidade.
            <br> - Dados cadastrais que implique mudança do remetente ou do destinatário.
            <br> - A data de emissão ou de saída.
            <br> - Série e número da nota fiscal.
            <br> 
        </div>

        <div class="alert alert-warning"> 
            <strong>
                A sua alteração não se enquadra na carta de correção?
            </strong>
            <br> Emita uma nota fiscal de devolução para anular os efeitos fiscais da NF-e emitida anteriormente, logo após emita uma nova nota fiscal normalmente. 
        </div> -->

        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <vue-input label="Chave de acesso da NF-e emitida anteriormente" name="chave" type="text" :required="'vuelidate'" :errors="errors" :fields="cartaCorrecao"></vue-input>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <vue-textarea label="Correção" name="correcao" rows="3" type="text" :required="'vuelidate'" :errors="errors" :fields="cartaCorrecao"></vue-textarea>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import { mapState } from 'vuex';
export default {
    computed: mapState({
        cartaCorrecao: state => state.nota.cartaCorrecao,
        errors: state => state.nota.errors['carta_correcao']
    })
}
</script>