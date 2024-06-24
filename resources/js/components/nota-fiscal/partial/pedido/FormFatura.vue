<template>
<div class="col-12">
    <h4 class="pt-2">Fatura</h4>
    <hr>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <vue-input label="Número da fatura" name="numero" type="text" :errors="errors" :fields="fields"></vue-input>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <vue-input label="Valor original" name="valor" type="text" :errors="errors" :fields="fields"></vue-input>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <vue-input label="Valor líquido" name="valor_liquido" type="text" :errors="errors" :fields="fields"></vue-input>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <vue-input label="Desconto" name="desconto" type="text" :errors="errors" :fields="fields"></vue-input>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        props: ['fields', 'errors']
    }
</script>