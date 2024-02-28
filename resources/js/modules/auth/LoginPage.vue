<template>
    <Button label="Sign in with google" icon="pi pi-google" severity="secondary" size="large"
        outlined @click="submit" class="w-full"></Button>
    <div v-ripple class="p-2 bg-primary mt-2 border-round  p-ripple text-center select-none ">
        <img :src="this.$utl.getSvg('chrome')" width="12">
        <span class="ml-2 text-sm">Sistema optimizado para navegador Google Chrome.</span>
    </div>
</template>

<script>
export default {
    methods: {
        async submit() {
            window.location.href = '/api/auth/google';
        }
    },
};
</script>