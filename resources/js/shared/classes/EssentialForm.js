
export class EssentialForm {


    constructor(controls) {
        this.controls = controls; // Un arreglo de EssentialFormControl
    }

    //Aplica los watchers para la validación constante
    applyWatchers(context) {
        Object.keys(this.controls).forEach((key) => {
            context.$watch(() => this.controls[key].value, () => {
                // Validar el control cuando cambia su propiedad 'value'
                this.controls[key].validate(key);
            });
        });
    }

    // Valida todo el formulario 
    validateAll() {
        let isFine = true;
        for (const key of Object.keys(this.controls)) {
            if (!this.controls[key].validate()) {
                isFine = false;
            }
        }
        return isFine;
    }

    // Limpia el formulario
    reset() {
        for (const key of Object.keys(this.controls)) {
            this.controls[key].clearInAllForm();
        }
    }

    // Retorna los valores de los controles
    value() {
        const controlsValue = {}
        Object.keys(this.controls).forEach(k => {
            controlsValue[k] = this.controls[k].value
        });
        return controlsValue;
    }

    // Actualiza los valores de los controles
    matchValue(controls) {
        Object.keys(controls).forEach(k => {
            this.controls[k].value = controls[k];
        });
    }

    // Cambia el valor de un control 
    setControl(control, value) {
        this.controls[control].value = value;
    }

    // Recibe un arreglo de controles a mostrar
    showControls(controls) {
        for (let control of controls) {
            this.controls[control].show();
        }
    }

    // Recibe un arreglo de controles a ocultar
    hiddenControls(controls) {
        for (let control of controls) {
            this.controls[control].hidden();
        }
    }



}