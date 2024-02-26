<template>
    <div class="header">
        <div class="header-toggle-nav" @click="toggleFloatNav">
            <i :class="`pi pi-align-justify font-bold text-primary`"></i>
        </div>
        <div class="header-title">
            <i :class="`pi ${this.icon} pr-2 font-bold text-primary`"></i>
            <span class="line-height-1 text-gray-800 font-bold">
                {{ description }}
            </span>
        </div>
    </div>
</template>

<script>
import routes from '../../../routes/routes';
export default {
    data() {
        return {
            icon: '',
            description: ''
        }
    },
    mounted() {
        this.getData();
    },
    watch: {
        '$route'(to, from) {
            this.getData();
        }
    },
    methods: {
        getData() {
            const routePanel = routes.find(r => r.path == '/panel');
            const routeSelected = routePanel.children.find(rp => window.location.href.endsWith(rp.path));
            this.icon = routeSelected?.icon;
            this.description = routeSelected?.description;
        },
        toggleFloatNav() {
            this.$store.commit('sidebar/setSiteClass',
                this.$store.state.sidebar.siteClass == 'floatnav' ? '' : 'floatnav'
            );
        }
    }
}
</script>

<style scoped>
@import './HeaderStyles.css';
</style>