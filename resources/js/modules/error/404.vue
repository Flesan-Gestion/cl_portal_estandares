<template>
    <div class="flex align-items-center flex-column">
        <span class="font-bold text-4xl">404</span>
        <span class="text-md text-center">La página a la que intentas acceder <b>no existe</b></span>
        <span class="text-md">Para regresar al panel de estándares haz clic
            <router-link class="" :to="{name: 'Standards'}">aquí</router-link>
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