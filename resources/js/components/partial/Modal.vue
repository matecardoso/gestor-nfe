<template>
    <div :refs="id ? id : 'myModal'" class="modal fade" tabindex="-1" role="dialog" :id="id ? id : 'myModal'">
        <div class="modal-dialog" :class="modal_class" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{title}}</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <slot name="body"></slot>
                </div>
                <div class="modal-footer">
                    <slot name="footer"></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['title', 'modal_class', 'id'],
    }
</script>