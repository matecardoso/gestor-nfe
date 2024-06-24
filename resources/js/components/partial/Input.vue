<template>
    <div>
        <label v-if="label" :for="name">{{required ? label+'*' : label}}</label>
        <i v-if="tooltip" class="fa fa-question-circle" v-tooltip:top="tooltip"></i>
        <input
            :type="type" 
            class="form-control" 
            :class="[{ 'border-danger' : errors && errors[name]}, classes]" 
            :placeholder="placeholder" 
            :name="id !== undefined ? name+'_'+id : name" 
            v-model.lazy="fields[name]" 
            :required="required && required != 'vuelidate'" 
            :disabled="disabled || loading"
            @change="change"
        />
        <div v-if="errors && errors[name]" class="text-danger">{{ errors[name][0] }}</div>  
    </div>    
</template>

<script>
    export default {
        props: ['label', 'name', 'id', 'required', 'type', 'placeholder', 'errors', 'fields', 'classes', 'tooltip', 'disabled', 'value', 'onchange', 'loading'],
        created() {
            if(!this.fields[this.name] && this.value !== undefined) {
                this.fields[this.name] = this.value
            }
        },
        methods: {
            change(event) {
                if(this.onchange) {
                    this.onchange(event)
                }
            },
        }
    }
</script>
