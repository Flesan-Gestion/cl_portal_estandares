<template>
    <Dialog header="Agregar un comentario" v-model:visible="visible" modal :pt="this.$utl.modalBlur"
        :breakpoints="{ '2560px': '35vw', '1800px': '50vw', '1200px': '65vw', '980px': '80vw', '560px': '100vw' }"
        :closable="false" :draggable="false">
        <div class="grid">
            <FormGroup label="Estándar Seleccionado" :control="formComment.controls.standard" customClass="col-12">
                <InputText v-model="formComment.controls.standard.value" disabled
                    :class="formComment.controls.standard.getClass()" />
            </FormGroup>
            <FormGroup label="Comentarios" :control="formComment.controls.comment" customClass="col-12">
                <Textarea v-model="formComment.controls.comment.value" rows="3"
                    :class="`w-full ${formComment.controls.comment.getClass()}`" />
            </FormGroup>
        </div>

        <div class="w-full flex justify-content-between p-2">
            <Button label="Cancelar" severity="secondary" icon="pi pi-times" @click="closeModal" />
            <Button label="Guardar" severity="success" icon="pi pi-check" @click="submit" />
        </div>
    </Dialog>
</template>
<script>
import { StandardService } from '../services/StandardService';

export default {
    emits: ['onSaveStandard', 'closeModal'],
    props: {
        visible: Boolean,
        standardSelected: Object
    },
    data() {
        return {
            formComment: this.$sstForm({
                standard: this.$sstFormControl(null),
                comment: this.$sstFormControl(null, [this.$sstRule.REQUIRED]),
            }),
        }
    },
    watch: {
        visible(newValue, oldValue) {
            if (!newValue) return;
            this.formComment.matchValue({
                standard: `${this.standardSelected.identifier} / ${this.standardSelected.inmobiliaria}`,
                comment: this.standardSelected.comentarios,
            })
        }
    },
    created() {
        this.formComment.applyWatchers(this);
    },
    methods: {
        async submit() {
            if (!this.formComment.validateAll()) {
                this.$utl.genToast(this.$tstType.FORM_ERROR);
                return;
            }
            const formValue = this.formComment.value();

            if (this.standardSelected.comentarios) {
                this.$utl.showConfirmation({
                    message: 'Se sobreescribirá el comentario existente en este estándar',
                    accept: async () => {
                        this.$utl.showLoader();
                        await StandardService.saveComment(this.standardSelected.correlativo, formValue.comment);
                        this.$utl.genToast(this.$tstType.REGISTER_COMMENT_SUCCESS);
                        this.onSaveStandard();
                    },
                    reject: () => { },
                })
            } else {
                this.$utl.showLoader();
                await StandardService.saveComment(this.standardSelected.correlativo, formValue.comment);
                this.onSaveStandard();
            }


        },
        closeModal() {
            this.formComment.reset();
            this.$emit('closeModal');
        },
        onSaveStandard() {
            this.formComment.reset();
            this.$emit('onSaveStandard');
        }
    }
}
</script>