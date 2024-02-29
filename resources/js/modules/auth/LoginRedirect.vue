<template>
    <!-- <div class="w-full h-screen flex justify-content-center align-items-center relative">
        <div class="absolute left-0 right-0 top-0 flex justify-content-center">
        </div>
        <div class="p-4 w-full sm:w-20rem shadow-3 flex flex-column align-items-center justify-content-center text-center">
            <img :src="this.$assets.image.logoGrupoFlesan" class="w-14rem mb-4">
            <ProgressSpinner style="width: 50px; height: 50px" strokeWidth="8" animationDuration=".5s"
                aria-label="Custom ProgressSpinner" />
        </div>
    </div> -->
</template>


<script>
import { AuthService } from './services/AuthService';

export default {
    async created() {
        this.$utl.showLoader('Redirigiendo al sistema');
        const email = this.$route.params.email;

        const token = await AuthService.getToken(email);
        
        if (!token) {
            this.$utl.navigate('Login');
            this.$utl.hiddenLoader();
        }

        const tokenPayload = token.split(".")[1];
        const decodedPayload = atob(tokenPayload);
        const decodedUnicodePayload = decodeURIComponent(escape(decodedPayload));
        const payload = JSON.parse(decodedUnicodePayload);
        this.$utl.store.commit('user/setUser', payload.user);
        this.$utl.store.commit('user/setToken', token);

        await this.$utl.sleep(2000);
        this.$utl.hiddenLoader();
        await this.$utl.sleep(600);

        this.$utl.navigate('Standards');
 

    }
}
</script>