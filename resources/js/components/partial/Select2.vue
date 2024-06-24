<template>
    <select class="js-example-basic-single form-control" name="state">
        <option v-for="(option, key) in options" :value="key" :key="key">{{ option }}</option>
    </select>
</template>

<script>
export default {
    props: ['options'],
    mounted() {
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    }
}
</script>