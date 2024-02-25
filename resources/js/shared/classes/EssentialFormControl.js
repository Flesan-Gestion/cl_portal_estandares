import { FormRules } from "../constants/form-rules";

export class EssentialFormControl {

    existError = false;
    error = null;
    doValidate = true;
    visible = true;


    constructor(value, rules = []) {
        this.value = value;
        this.rules = rules;
    }

    // False = Error
    // True = Todo OK
    validate() {
        if (this.doValidate && this.visible) {
            for (const ruleName of this.rules) {
                const rule = FormRules.find(fr => fr.name == ruleName);

                if (!rule.regex.test(this.value) || this.value === null) {
                    this.existError = true;
                    this.error = rule;
                    return false;
                }
            }
        }

        this.doValidate = true;
        this.existError = false;
        this.error = null;
        return true;
    }

    // Obtiene la clase invalid para los elementos del form
    getClass() {
        return this.existError ? 'p-invalid' : '';
    }

    // Limpia el control individualmente
    clear() {
        this.value = null;
    }

    // Limpia el control pero para la limpieza general del formulario
    clearInAllForm() {
        this.doValidate = false;
        this.value = null;
        setTimeout(() => {
            this.existError = false;
            this.error = null;
        }, 1)
    }

    // Agrega una regla al control
    addRule(rule) {
        this.rules = [...this.rules, rule];
    }

    // Elimina una regla al control
    deleteRule(rule) {
        this.rules = this.rules.filter(r => r != rule);
    }

    // Muestra al control
    show() {
        this.visible = true;
    }

    // Oculta al control
    hidden() {
        this.clear();
        this.visible = false;
    }

}