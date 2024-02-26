<template>
    <div id="page" :class="`site ${this.$store.state.sidebar.siteClass}`">
        <Sidebar></Sidebar>
        <div class="main">
            <div class="container">
                <Header></Header>
                <div class="panel">
                    <router-view></router-view>
                </div>
                <Footer></Footer>
            </div>
        </div>
    </div>
</template>
<script>
import Sidebar from './sidebar/Sidebar.vue';
import Footer from './footer/Footer.vue';
import Header from './header/Header.vue';

export default {
    components: {
        Sidebar,
        Footer,
        Header
    },
}
</script>

<style>
@import './sidebar/SidebarStyles.css';
@import './PanelStyles.css';
</style>