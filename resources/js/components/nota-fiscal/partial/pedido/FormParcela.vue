<template>
<div class="col-12" :id="id">
    <h4  v-if="key == 0" class="pt-2">Parcelas</h4>
    <hr>
    <div class="card-footer">
        <div v-if="key != 0" class="row">
            <button type="button" class="btn btn-sm mr-n2 ribbon-wrapper" @click="removeRow(key)">
                <i class="fas fa-trash"></i>      
            </button>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <vue-input label="Data de vencimento" name="vencimento" type="date" :errors="errors" :fields="fields"></vue-input>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <vue-input label="Valor" name="valor" type="text" :errors="errors" :fields="fields"></vue-input>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        props: ['fields', 'errors', 'removeRow', 'id'],
        data() {
            return {
                key: this.$vnode.key,
            }
        },
    }
</script>