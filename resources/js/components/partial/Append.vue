<template>
    <div class="row">
        <div class="col-12">
        
            <component :is="component" v-for="(content, index) in line_keys" :key="index" :id="component+'_append_'+index" :removeRow="removeRow" :fields="fields[index]" :errors="errors"></component>

            <button type="button" class="btn btn-sm btn-outline-primary float-right mt-2 mr-2" @click="addRow" :disabled="loading">
                <span v-if="loading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                {{ button_text ? button_text : 'Adicionar' }}
            </button>

        </div>
    </div>
</template>

<script>
export default {
    props: ['fields', 'errors', 'component', 'button_text'],
    data() {
        return {
            line_keys: [0],
            key_line_keys: 0,
            loading: false
        }
    },
    methods: {
        addRow() {
            this.key_line_keys++
            this.fields[this.key_line_keys] = {}
            this.line_keys.push(this.key_line_keys)
        },
        removeRow(line_number) {
            $('#'+this.component+'_append_'+line_number).remove()
            delete this.fields[line_number]
        }
    }
}
</script>