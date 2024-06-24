<template>
    <div>
        <div class="icheck-primary" :class="custonControlInline">
            <input type="checkbox" :id="'checkbox-'+value" :value="value" v-model="fields[name]" @change="onchange !== undefined ? onchange(value) : '#'">
            <label :for="'checkbox'+'-'+value">
                {{label}}
            </label>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['name', 'label', 'value', 'inline', 'fields', 'onchange', 'checked'],
        data() {
            return {
                custonControlInline: this.inline ? 'custom-control-inline' : ''
            }
        },
        mounted() {
            if(this.checked !== undefined && this.checked !== null && this.checked) {
                $('#checkbox-'+this.value).click()
            }
        }
    }
</script>