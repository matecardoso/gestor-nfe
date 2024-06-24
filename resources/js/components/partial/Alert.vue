<template>
    <div v-if="success" class="alert alert-default-success">
        {{mensagem}}
    </div>
</template>

<script>
    export default {
        props: ['mensagem', 'success'],
    }
</script>