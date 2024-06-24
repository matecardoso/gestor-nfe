<template>
    <div >
        <label v-if="label" :for="name">{{required ? label+'*' : label}}</label>
        <i v-if="tooltip" class="fa fa-question-circle" v-tooltip:top="tooltip"></i>
        <select 
            class="form-control" 
            :name="id ? name+'_'+id : name" 
            :class="[{ 'border-danger' : errors && errors[name]}, classes]" 
            @change="change" 
            :required="required && required != 'vuelidate'"
            :disabled="loading">
            <option v-if="select_label" value="">{{select_label}}</option>
            <option v-if="!fields[name] && !select_label" value="">Selecione</option>
            <option 
                v-for="(option, key) in options" 
                :value="option['id'] ? option['id'] : key" 
                :key="key" 
                :selected="((option['id'] ? option['id'] : key) == fields[name]) || (!fields[name] && option['padrao'])"
                >
                {{show_key ? key+' - ' : ''}}{{text_key ? option[text_key] : option}}
            </option>
        </select>
        <div v-if="errors && errors[name]" class="text-danger">{{ errors[name][0] }}</div>  
    </div>
</template>

<script>
    export default {
        props: ['label', 'name', 'id', 'required', 'options', 'errors', 'fields', 'onchange', 
            'text_key', 'select_label', 'tooltip', 'show_key', 'classes', 'loading'],
        mounted() {
            this.selectValue()
        },
        methods: {
            change(event) {
                this.fields[this.name] = event.target.value
                if(this.onchange) {
                    this.onchange(event)
                }
            },
            selectValue() {
                if(!this.fields[this.name]) {
                    if(this.id) {
                        var selected = $('select[name="'+this.name+'_'+this.id+'"] option:selected').val()
                    } else {
                        var selected = $('select[name="'+this.name+'"] option:selected').val()
                    }
                    if(selected) {
                        this.fields[this.name] = selected
                    }   
                }
            }
        }
    }
</script>