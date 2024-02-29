<template>
    <Dialog header="Detalle de Estándar Inmobiliario" v-model:visible="visible" modal :pt="this.$utl.modalBlur"
        :breakpoints="{ '2560px': '35vw', '1800px': '50vw', '1200px': '65vw', '980px': '80vw', '560px': '100vw' }"
        :closable="false" :draggable="false">
        <div class="grid">
            <FormGroup label="ID" :control="formStandard.controls.identifier" customClass="col-12">
                <div class="flex gap-2">
                    <InputText v-model="formStandard.controls.identifier.value" disabled
                        :class="`${formStandard.controls.identifier.getClass()} flex-1`" />
                    <Button :severity="isEditable ? 'success' : 'danger'"
                        :icon="`pi ${isEditable ? 'pi-unlock' : 'pi-lock'}`" @click="toggleActiveEditable" />
                </div>

            </FormGroup>
            <FormGroup label="Especialidad" :control="formStandard.controls.especialidad" customClass="col-12 md:col-6">
                <InputText v-model="formStandard.controls.especialidad.value" :disabled="!isEditable"
                    :class="formStandard.controls.especialidad.getClass()" />
            </FormGroup>
            <FormGroup label="Inmobiliaria" :control="formStandard.controls.inmobiliaria" customClass="col-12 md:col-6">
                <InputText v-model="formStandard.controls.inmobiliaria.value" :disabled="!isEditable"
                    :class="formStandard.controls.inmobiliaria.getClass()" />
            </FormGroup>
            <FormGroup label="Tipo de Definición" :control="formStandard.controls.tipo_definicion"
                customClass="col-12 md:col-6">
                <InputText v-model="formStandard.controls.tipo_definicion.value" :disabled="!isEditable"
                    :class="formStandard.controls.tipo_definicion.getClass()" />
            </FormGroup>
            <FormGroup label="Requerimiento" :control="formStandard.controls.requerimiento" :required="false"
                customClass="col-12 md:col-6">
                <InputText v-model="formStandard.controls.requerimiento.value" :disabled="!isEditable"
                    :class="formStandard.controls.requerimiento.getClass()" />
            </FormGroup>
            <FormGroup label="Descripción" :control="formStandard.controls.descripcion" customClass="col-12 md:col-6">
                <InputText v-model="formStandard.controls.descripcion.value" :disabled="!isEditable"
                    :class="formStandard.controls.descripcion.getClass()" />
            </FormGroup>
            <FormGroup label="Información" :control="formStandard.controls.informacion" customClass="col-12 md:col-6">
                <InputText v-model="formStandard.controls.informacion.value" :disabled="!isEditable"
                    :class="formStandard.controls.informacion.getClass()" />
            </FormGroup>
            <FormGroup label="Comentarios" :control="formStandard.controls.comentarios" customClass="col-12">
                <Textarea v-model="formStandard.controls.comentarios.value" rows="3"
                    :class="`w-full ${formStandard.controls.comentarios.getClass()}`" disabled />
            </FormGroup>

            <div :class="`w-full flex p-2 ${isEditable ? 'justify-content-between' : 'justify-content-center'}`">
                <Button label="Cerrar" severity="secondary" icon="pi pi-times" @click="closeModal" />
                <Button v-if="isEditable" label="Guardar" severity="success" icon="pi pi-check" @click="submit" />
            </div>
        </div>
    </Dialog>
</template>
<script>
export default {
    emits: ['onSaveStandard', 'closeModal'],
    props: {
        visible: Boolean,
        standardSelected: Object
    },
    data() {
        return {
            formStandard: this.$sstForm({
                identifier: this.$sstFormControl(null, [this.$sstRule.REQUIRED]),
                especialidad: this.$sstFormControl(null, [this.$sstRule.REQUIRED]),
                inmobiliaria: this.$sstFormControl(null, [this.$sstRule.REQUIRED]),
                tipo_definicion: this.$sstFormControl(null, [this.$sstRule.REQUIRED]),
                requerimiento: this.$sstFormControl(null),
                descripcion: this.$sstFormControl(null, [this.$sstRule.REQUIRED]),
                informacion: this.$sstFormControl(null, [this.$sstRule.REQUIRED]),
                comentarios: this.$sstFormControl(null, [this.$sstRule.REQUIRED]),
            }),
            isEditable: false,
        }
    },
    watch: {
        standardSelected(newValue, oldValue) {
            if (!newValue) return;
            this.setStandardData(newValue);
        }
    },
    created() {
        this.formStandard.applyWatchers(this);
    },
    methods: {
        setStandardData(standard) {
            this.formStandard.matchValue({
                identifier: standard.identifier,
                especialidad: standard.especialidad,
                inmobiliaria: standard.inmobiliaria,
                tipo_definicion: standard.tipo_definicion,
                requerimiento: standard.requerimiento,
                descripcion: standard.descripcion,
                informacion: standard.informacion,
                comentarios: standard.comentarios,
            })
        },
        toggleActiveEditable() {
            this.isEditable = !this.isEditable;
            if (!this.isEditable) {
                this.setStandardData(this.standardSelected);
            }
        },
        submit() {

        },
        closeModal() {
            this.formStandard.reset();
            this.$emit('closeModal');
        },
        onSaveStandard() {
            this.formStandard.reset();
            this.$emit('onSaveStandard');
        }
    }
}
</script>