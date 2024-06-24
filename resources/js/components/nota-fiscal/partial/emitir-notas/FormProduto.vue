<template>
    <div class="px-2">

        <vue-table-append 
            :titulos="['Nome', 'CFOP', 'Unidade', 'Qtd', 'Subtotal', 'Total', '']"
            :errors="errors" 
            :fields="fields"
        ></vue-table-append>

    </div>
</template>

<script>
export default {
    data() {
        return {
            fields: {},
            errors: {},
        }
    }
}
</script>