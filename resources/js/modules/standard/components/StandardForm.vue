<template>
    <Dialog header="Formulario de Estándar Inmobiliario" v-model:visible="visible" modal :pt="this.$utl.modalBlur"
        :breakpoints="{ '2560px': '35vw', '1800px': '50vw', '1200px': '65vw', '980px': '80vw', '560px': '100vw' }"
        :closable="false" :draggable="false">
        <div class="grid">
            <FormGroup label="Código" :control="formStandard.controls.code" customClass="col-12">
                <div class="flex gap-2">
                    <InputText v-model="formStandard.controls.code.value" :disabled="true"
                        :class="`${formStandard.controls.code.getClass()} flex-1`" />
                    <Button :severity="isEditable ? 'success' : 'danger'" v-if="this.standardSelected"
                        :icon="`pi ${isEditable ? 'pi-unlock' : 'pi-lock'}`" @click="toggleActiveEditable" />
                </div>

            </FormGroup>
            <FormGroup label="Especialidad" :control="formStandard.controls.speciality" customClass="col-12 md:col-6">
                <Dropdown v-model="formStandard.controls.speciality.value" :options="specialities"
                    optionLabel="sp_description" :panelStyle="{ width: '2rem' }" placeholder="Seleccionar"
                    :disabled="this.standardSelected && !isEditable" optionValue="sp_id"
                    :class="`w-full-important ${formStandard.controls.speciality.getClass()}`" filter
                    @change="generateCode($event.value)" />
            </FormGroup>
            <FormGroup label="Inmobiliaria" :control="formStandard.controls.realEstate" customClass="col-12 md:col-6">
                <Dropdown v-model="formStandard.controls.realEstate.value" :options="realEstates"
                    optionLabel="re_description" :panelStyle="{ width: '2rem' }" placeholder="Seleccionar"
                    :disabled="this.standardSelected && !isEditable" optionValue="re_id" filter
                    :class="`w-full-important ${formStandard.controls.realEstate.getClass()}`" />
            </FormGroup>
            <FormGroup label="Tipo de Definición" :control="formStandard.controls.typeDefinition"
                customClass="col-12 md:col-6">
                <InputText v-model="formStandard.controls.typeDefinition.value"
                    :disabled="this.standardSelected && !isEditable"
                    :class="formStandard.controls.typeDefinition.getClass()" />
            </FormGroup>
            <FormGroup label="Requerimiento" :control="formStandard.controls.request" :required="false"
                customClass="col-12 md:col-6">
                <InputText v-model="formStandard.controls.request.value"
                    :disabled="this.standardSelected && !isEditable"
                    :class="formStandard.controls.request.getClass()" />
            </FormGroup>
            <FormGroup label="Descripción" :control="formStandard.controls.description" customClass="col-12">
                <Textarea v-model="formStandard.controls.description.value" rows="2"
                    :disabled="this.standardSelected && !isEditable"
                    :class="`w-full ${formStandard.controls.description.getClass()}`" />
            </FormGroup>
            <FormGroup label="Información" :control="formStandard.controls.information" customClass="col-12">
                <Textarea v-model="formStandard.controls.information.value" rows="3"
                    :disabled="this.standardSelected && !isEditable"
                    :class="`w-full ${formStandard.controls.information.getClass()}`" />
            </FormGroup>

            <div
                :class="`w-full flex p-2 ${(!this.standardSelected || (isEditable && this.standardSelected)) ? 'justify-content-between' : 'justify-content-center'}`">
                <Button label="Cerrar" severity="secondary" icon="pi pi-times" @click="closeModal" />
                <Button v-if="!this.standardSelected || (isEditable && this.standardSelected)" label="Guardar"
                    severity="success" icon="pi pi-check" @click="submit" />
            </div>
        </div>
    </Dialog>
</template>
<script>
import { StandardService } from '../services/StandardService';

export default {
    emits: ['onSaveStandard', 'closeModal'],
    props: {
        visible: Boolean,
        standardSelected: Object,
        specialities: Array,
        realEstates: Array
    },
    data() {
        return {
            formStandard: this.$sstForm({
                code: this.$sstFormControl(null, [this.$sstRule.REQUIRED]),
                speciality: this.$sstFormControl(null, [this.$sstRule.REQUIRED]),
                realEstate: this.$sstFormControl(null, [this.$sstRule.REQUIRED]),
                typeDefinition: this.$sstFormControl(null, [this.$sstRule.REQUIRED]),
                request: this.$sstFormControl(null),
                description: this.$sstFormControl(null, [this.$sstRule.REQUIRED]),
                information: this.$sstFormControl(null, [this.$sstRule.REQUIRED]),
            }),
            isEditable: false,
        }
    },
    watch: {
        visible(newValue, oldValue) {
            if (!newValue) return;
            if (this.standardSelected) {
                this.setStandardData(this.standardSelected);
            }
        }
    },
    created() {
        this.formStandard.applyWatchers(this);
    },
    methods: {
        setStandardData(standard) {
            this.formStandard.matchValue({
                code: standard.st_code,
                speciality: standard.speciality.sp_id,
                realEstate: standard.real_estate.re_id,
                typeDefinition: standard.st_type_definition,
                request: standard.st_request,
                description: standard.st_description,
                information: standard.st_information,
            })
        },
        toggleActiveEditable() {
            this.isEditable = !this.isEditable;
            if (!this.isEditable) {
                this.setStandardData(this.standardSelected);
            }
        },
        async generateCode(idSpeciality) {
            this.$utl.showLoader();
            const code = await StandardService.generateCode(idSpeciality);
            this.formStandard.controls.code.value = code;
            this.$utl.hiddenLoader();
        },
        async submit() {
            if (!this.formStandard.validateAll()) {
                this.$utl.genToast(this.$tstType.FORM_ERROR);
                return;
            }

            const formValue = this.formStandard.value();
            this.$utl.showLoader();
            if (this.standardSelected) {
                await StandardService.update(this.standardSelected.st_id, StandardService.formatEditStandard(formValue));
            } else {
                await StandardService.create(StandardService.formatNewStandard(formValue));
            }

            this.$utl.genToast(this.$tstType.REGISTER_SUCCESS);
            this.onSaveStandard();
        },
        closeModal() {
            this.formStandard.reset();
            this.isEditable = false;
            this.$emit('closeModal');
        },
        onSaveStandard() {
            this.formStandard.reset();
            this.isEditable = false;
            this.$emit('onSaveStandard');
        }
    }
}
</script>