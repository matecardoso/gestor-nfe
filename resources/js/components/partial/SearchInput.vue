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
            v-model="fields[name]" 
            :required="required && required != 'vuelidate'" 
            :disabled="disabled || loading"
            @change="change"
            autocomplete="nope"
        />
        <div v-if="optionsFields && !isEmptyObject(optionsFields) && !optionSelected" class="autocomplete-menu">
            <!-- <div v-if="!(index % 2 == 0)" style="background-color: rgb(238, 238, 238);">{{ option[searchKey] }}</div> -->
            <div v-for="(option, index) in optionsFields" :key="index" style="background-color: transparent;" @click="getData(option)">{{ option[searchKey] }}</div>
        </div>
        <div v-if="errors && errors[name]" class="text-danger">{{ errors[name][0] }}</div>
    </div>    
</template>

<script>
    export default {
        props: ['label', 'name', 'id', 'required', 'type', 'placeholder', 'errors', 'fields', 'classes', 
            'tooltip', 'disabled', 'value', 'onchange', 'loading', 'searchFields', 'searchKey', 'onSelect'],
        data() {
            return {
                optionsFields: null,
                optionSelected: false
            }
        },
        created() {
            if(!this.fields[this.name] && this.value !== undefined) {
                this.fields[this.name] = this.value
            }
        },
        computed: {
            fieldValue() {
                return this.fields[this.name];
            }
        },
        watch: {
            fieldValue() {
                this.filterSearch()
            },
            loading() {
                this.optionSelected = true
            }
        },
        methods: {
            change(event) {
                if(this.onchange) {
                    this.onchange(event)
                }
            },
            filterSearch() {
                this.optionSelected = false
                if(!this.isEmptyObject(this.searchFields)) {
                    if(this.fields[this.name]) {
                        this.optionsFields = (this.cleanObserver(this.searchFields).data).filter(field => {
                            return field[this.searchKey] !== null && field[this.searchKey].toLowerCase().includes(this.fields[this.name].toLowerCase())
                        })
                    } else {
                        this.optionsFields = null
                    }
                } 
            },
            getData(option) {
                this.onSelect(option.id)
                this.optionSelected = true
            }
        }
    }
</script>

<style scoped>
    .autocomplete-menu {
        position: absolute;
        /* top: 100%; */
        left: 0;
        right: 0;
        background-color: #FFF;
        border: 1px solid #ccc;
        z-index: 9;
        max-height: 180px;
        overflow: auto;
        margin-right: 8px;
        margin-left: 8px;
        cursor: pointer;
    }
</style>
