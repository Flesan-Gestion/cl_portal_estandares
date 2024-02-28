<template>
    <div class="flex align-items-center flex-column">
        <span class="font-bold text-4xl">403</span>
        <span class="text-md text-center">Su usuario <b>no tiene acceso</b> a esta plataforma</span>
        <span class="text-md">Para regresar al login haz clic
            <router-link class="" :to="{name: 'Login'}">aquí</router-link>
        </span>
    </div>
</template>

<style scoped>
a {
    color: black;
    font-weight: bold;
    text-decoration: none;
    color: var(--primary-color);
    transition: var(--sidebar-transition);
}

a:hover {
    color: var(--sidebar-scrollbar-color);
}
</style>