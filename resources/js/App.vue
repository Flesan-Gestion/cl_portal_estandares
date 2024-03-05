<template>
    <Loader />
    <Toast position="top-left" />
    <ConfirmationModal />
    <router-view></router-view>
</template>

<script>
import setLocaleES from "../js/config/primevue.config";
export default {
    setup() {
        setLocaleES();
    },
    created() {
        setInterval(() => {
            if (window.location.pathname.startsWith('/panel')) {
                const token = this.$store.state.user.token;
                if (token) {
                    const tokenPayload = token.split(".")[1];
                    const decodedPayload = atob(tokenPayload);
                    const decodedUnicodePayload = decodeURIComponent(escape(decodedPayload));
                    const payload = JSON.parse(decodedUnicodePayload);

                    if (Date.now() >= payload.exp * 1000) {
                        this.$utl.genToast(this.$tstType.TOKEN_EXPIRED_OR_INVALID);
                        this.$utl.hiddenLoader();
                        this.$utl.navigate('Login');
                    }
                }
            }
        }, 3000);
    },
    watch: {
        '$store.state.toast.body': function (body) {
            setTimeout(() => {
                this.$toast.add(body);
            }, body.delay);
        }
    },
}
</script>