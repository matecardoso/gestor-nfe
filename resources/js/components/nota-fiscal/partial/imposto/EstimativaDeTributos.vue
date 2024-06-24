<template>
    <div class="mt-3">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <vue-input label="Alíquota estimada de Tributos Federais" 
                        tooltip="Consulte a porcentagem no IBPT: https://deolhonoimposto.ibpt.org.br" 
                        name="tributos_federais" 
                        placeholder="0,00" 
                        value="0" 
                        :errors="errors" 
                        :fields="fields">
                    </vue-input>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <vue-input label="Alíquota estimada de Tributos Estaduais" 
                        tooltip="Consulte a porcentagem no IBPT: https://deolhonoimposto.ibpt.org.br" 
                        name="tributos_estaduais" 
                        placeholder="0,00" 
                        value="0" 
                        :errors="errors" 
                        :fields="fields">
                    </vue-input>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['fields', 'errors'],
        data() {
            return {
                porcentage: {
                    decimal: '.',
                    thousands: ',',
                    suffix: ' %',
                    precision: 2,
                }
            }
        },
    }
</script>