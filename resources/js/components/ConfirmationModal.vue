<template>
    <Dialog v-model:visible="this.$store.state.confirmation.visible" :pt="this.$utl.modalBlur" modal :closable="false"
        :draggable="false">
        <div class="dialog-width">
            <div class="flex justify-content-center align-items-center flex-column ">
                <div class="bg-primary p-4 border-circle">
                    <i class="pi pi-question text-2xl"></i>
                </div>
                <div class="mt-2 flex flex-column align-items-center text-center">
                    <span class="font-bold  text-xl mb-2">{{ this.$store.state.confirmation.header }}</span>
                    <span>{{ this.$store.state.confirmation.message }}</span>
                </div>
                <div class="w-full mt-3 flex justify-content-between">
                    <Button label="Sí, estoy seguro" outlined @click="accept" />
                    <Button label="No, no estoy seguro" @click="reject" />
                </div>
            </div>
        </div>


    </Dialog>
</template>
<script>
export default {
    methods: {
        accept() {
            this.$store.state.confirmation.accept();
            this.$utl.hiddenConfirmation();
        },
        reject() {
            this.$store.state.confirmation.reject();
            this.$utl.hiddenConfirmation();
        }
    }
}
</script>
<style scoped>
.dialog-width {
    width: 23rem;
}

@media (max-width: 600px) {

    .dialog-width {
        width: 100%;
    }
}
</style>