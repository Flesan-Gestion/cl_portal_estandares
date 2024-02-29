<template>
    <Dialog header="Formulario de Usuario" v-model:visible="visible" modal :pt="this.$utl.modalBlur"
        :breakpoints="{ '2560px': '35vw', '1800px': '50vw', '1200px': '65vw', '980px': '80vw', '560px': '100vw' }"
        :closable="false" :draggable="false">
        <div class="grid">
            <FormGroup label="País" :control="formUser.controls.country" customClass="col-12">
                <SelectButton v-model="formUser.controls.country.value" :options="countries"
                    :class="`w-full-important flex ${formUser.controls.country.getClass()}`" />
            </FormGroup>

            <FormGroup label="Correo" :control="formUser.controls.email" customClass="col-12">
                <InputText v-model="formUser.controls.email.value" :class="formUser.controls.email.getClass()" />
            </FormGroup>

            <FormGroup label="Nombres" :control="formUser.controls.nombres" customClass="col-12 md:col-4">
                <InputText v-model="formUser.controls.nombres.value" :class="formUser.controls.nombres.getClass()" />
            </FormGroup>

            <FormGroup label="Apellidos" :control="formUser.controls.apellidos" customClass="col-12 md:col-4">
                <InputText v-model="formUser.controls.apellidos.value" :class="formUser.controls.apellidos.getClass()" />
            </FormGroup>

            <FormGroup label="DNI" :control="formUser.controls.dni" customClass="col-12 md:col-4">
                <InputText v-model="formUser.controls.dni.value" :class="formUser.controls.dni.getClass()" />
            </FormGroup>

            <FormGroup label="Perfil" :control="formUser.controls.profile" customClass="col-12">
                <Dropdown v-model="formUser.controls.profile.value" :options="roles" optionLabel="nombre"
                    :panelStyle="{ width: '2rem' }" placeholder="Seleccionar perfil" optionValue="id_rol"
                    :class="`w-full-important ${formUser.controls.profile.getClass()}`" />
            </FormGroup>
        </div>

        <div class="w-full flex justify-content-between p-2">
            <Button label="Cancelar" severity="secondary" icon="pi pi-times" @click="closeModal" />
            <Button label="Guardar" severity="success" icon="pi pi-check" @click="saveUser" />
        </div>

    </Dialog>
</template>
<script>
import { UserService } from '../services/UserService';
import { RolService } from '../services/RolService';
import { UserRolService } from '../services/UserRolService';


export default {
    emits: ['onSaveUser', 'closeModal'],
    props: {
        visible: Boolean,
        userSelected: Object,
    },
    data() {
        return {
            formUser: this.$sstForm({
                country: this.$sstFormControl(null, [this.$sstRule.REQUIRED]),
                email: this.$sstFormControl(null, [this.$sstRule.REQUIRED, this.$sstRule.EMAIL]),
                nombres: this.$sstFormControl(null, [this.$sstRule.REQUIRED]),
                apellidos: this.$sstFormControl(null, [this.$sstRule.REQUIRED]),
                dni: this.$sstFormControl(null, [this.$sstRule.REQUIRED]),
                profile: this.$sstFormControl(null, [this.$sstRule.REQUIRED]),
            }),
            countries: ['PE', 'CL'],
            roles: []
        }
    },
    async created() {
        this.formUser.applyWatchers(this);
        this.$utl.showLoader();
        this.roles = await RolService.all();
        this.$utl.hiddenLoader();
    },
    watch: {
        userSelected(newValue, oldValue) {
            if (!newValue) return;
            this.formUser.matchValue({
                email: newValue.username,
                nombres: newValue.nombres,
                apellidos: newValue.apellidos,
                dni: newValue.dni,
                profile: newValue.rol.id_rol,
                country: newValue.pais
            })
        }
    },
    methods: {
        async saveUser() {
            if (!this.formUser.validateAll()) {
                this.$utl.genToast(this.$tstType.FORM_ERROR);
                return;
            }
            const formValue = this.formUser.value();
            this.$utl.showLoader()

            if (this.userSelected) {
                await UserService.update(this.userSelected.id_aplicacion_usuario, UserService.formatEditUser(formValue));
                await UserRolService.updateRol(this.userSelected.rol.id_user_rol, formValue.profile);
            } else {
                const user = await UserService.create(UserService.formatNewUser(formValue));
                await UserRolService.create(UserRolService.formatNewUserRol(user.data.id_aplicacion_usuario, formValue.profile));
            }
            this.$utl.genToast(this.$tstType.REGISTER_SUCCESS);
            this.onSaveUser();

        },
        closeModal() {
            this.formUser.reset();
            this.$emit('closeModal');
        },
        onSaveUser() {
            this.formUser.reset();
            this.$emit('onSaveUser');
        }
    }

}
</script>