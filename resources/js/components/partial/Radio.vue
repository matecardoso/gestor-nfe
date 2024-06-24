<template>
    <div>

        <div class="custom-control custom-radio" :class="custonControlInline" v-for="(option, key) in JSON.parse(options)" :key="key">
            <input class="custom-control-input" type="radio" :id="name+'_'+key" :name="name" :value="key" v-model="fields[name]" @change="onchange">
            <label :for="name+'_'+key" class="custom-control-label">{{option}}</label>
        </div>
        
        <div v-if="errors && errors.name" class="text-danger">{{ errors[name][0] }}</div>

    </div>    
</template>

<script>
    export default {
        props: ['name', 'options', 'inline', 'fields', 'onchange', 'errors'],
        data() {
            return {
                custonControlInline: this.inline ? 'custom-control-inline' : ''
            }
        }
    }
</script>
