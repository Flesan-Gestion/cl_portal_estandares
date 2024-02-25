<template>
    <div v-if="control?.visible == null ? true : control.visible" :class="`${spaceBottom ? 'mb-1' : ''} ${customClass}`">
        <div class="flex flex-column">
            <span class="font-bold">{{ label }} <span v-show="required" class="text-primary">*</span></span>
            <div class="mt-1">
            </div>

            <slot></slot>

            <span v-if="control?.existError && showErrorMessage" class="text-primary font-bold">{{
                control?.error.message
            }}</span>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        spaceBottom: {
            type: Boolean,
            default: true
        },
        required: {
            type: Boolean,
            default: true
        },
        showErrorMessage: {
            type: Boolean,
            default: true
        },
        customClass: {
            type: String,
            default: ''
        },
        control: {
            type: Object,
            default: null
        },
        label: String,
    }
}
</script>