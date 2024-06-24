<template>
    <div>
        <h5>{{texto}}</h5>
        <loading :active.sync="isLoading" 
            :can-cancel="true" 
            :on-cancel="onCancel"
            :is-full-page="fullPage"></loading>
    </div>
</template>

<script>
    // Import component
    import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';
    
    export default {
        props: ['texto'],
        data() {
            return {
                isLoading: false,
                fullPage: false
            }
        },
        components: {
            Loading
        },
        mounted() {
            this.doAjax()
        },
        methods: {
            doAjax() {
                this.isLoading = true;
                // simulate AJAX
                setTimeout(() => {
                  this.isLoading = false
                },5000)
            },
            onCancel() {
              console.log('User cancelled the loader.')
            }
        }
    }
</script>
