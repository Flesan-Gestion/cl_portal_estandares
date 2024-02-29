<template>
    <div :class="`fast-transition fixed bottom-0 left-0 right-0 top-0 super-position ${showLoader ? 'block' : 'hidden'}`">
        <div :class="`fast-transition relative w-full h-full ${showBlur ? 'bg-blur' : ''}`">
            <div class="opacity-80 absolute bottom-0 left-0 right-0 top-0 "></div>
            <div
                :class="`fast-transition flex flex-column absolute bottom-0 left-0 right-0 top-0 flex justify-content-center align-items-center ${showLogo ? 'opacity-100' : 'opacity-0'}`">
                <img :src="this.$utl.getSvg('loader')" width="180">
                <img :src="this.$utl.getImg('logoGrupoFlesan')"
                    :class="`fast-transition mb-2 ${showNameCompany ? 'opacity-100' : 'opacity-0'}`" height="40">
                <span :class="`text-md font-bold fast-transition mb-7 ${showMessage ? 'opacity-100' : 'opacity-0'}`">{{
                    message }}</span>

            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            showLoader: false,
            showLogo: false,
            showNameCompany: false,
            showBlur: false,
            showMessage: false,
            message: null
        }
    },
    watch: {
        '$store.state.loader.visible': async function (visible) {

            if (visible) {
                this.showLoader = true;
                this.message = this.$store.state.loader.message;
                await this.sleep(10);
                this.showBlur = true;
                await this.sleep(200);
                this.showLogo = true;
                this.showNameCompany = true;
                this.showMessage = this.message != null;
            } else {
                this.showMessage = false;
                this.showNameCompany = false;
                this.showLogo = false;
                await this.sleep(200);
                this.showBlur = false;
                await this.sleep(200);
                this.showLoader = false;
            }
        }
    },
    methods: {
        sleep(miliseconds) {
            return new Promise((resolve, reject) => {
                setTimeout(() => {
                    resolve(true);
                }, miliseconds)
            })
        }
    }
}
</script>
<style scoped>
.super-position {
    z-index: 9000;
}

.fast-transition {
    transition: all .4s ease;
}

.bg-blur {
    transition: var(--sidebar-transition);
    backdrop-filter: blur(5px);
}
</style>