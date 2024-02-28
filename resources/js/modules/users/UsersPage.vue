<template>
    <span class="text-lg">Users Page</span>
</template>
<script>
export default {
    created() {
        console.log(this.$utl.store.state.user.data);
    }
}
</script>