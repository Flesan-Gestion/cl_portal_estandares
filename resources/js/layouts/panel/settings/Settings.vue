<template>
    <div class="w-12rem max-w-12rem text-white flex flex-column overflow-hidden">
        <div class="w-full py-2 px-3 flex justify-content-between align-items-center hover-item" v-for="(item, index) in settings"
            @click="item.action">
            <i :class="item.icon"></i>
            <span>{{ item.description }}</span>
        </div>


    </div>
</template>
<script>

export default {
    data() {
        return {
            settings: [
                {
                    icon: 'pi pi-sign-out',
                    description: 'Cerrar sesión',
                    action: () => { this.logout() }
                }
            ],
        }
    },
    methods: {
        logout() {
            this.$utl.genToast(this.$tstType.LOGOUT_SUCCESS);
            this.$utl.navigate('Login');
        }
    }
}

</script>

<style scoped>
.hover-item {
    transition: var(--sidebar-transition);
    -webkit-transition: var(--sidebar-transition);
    height: 2.5rem;
}

.hover-item:hover {
    cursor: pointer;
    background-color: var(--sidebar-secondary-color);

}
</style>