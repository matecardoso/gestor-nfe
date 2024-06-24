<template>
    <div>
        <label v-if="label" :for="name">{{required ? label+'*' : label}}</label>
        <textarea 
            class="form-control" 
            :class="{ 'border-danger' : errors && errors[name]}"
            :id="name"
            :required="required && required != 'vuelidate'" 
            :name="name" 
            :rows="rows" 
            v-model="fields[name]"
            :disabled="loading"
        ></textarea>
        <div v-if="errors && errors[name]" class="text-danger">{{ errors[name][0] }}</div>
    </div>    
</template>

<script>
    export default {
        props: ['label', 'name', 'errors', 'fields', 'rows', 'classes', 'required', 'loading'],
    }
</script>
