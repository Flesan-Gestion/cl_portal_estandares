import { EssentialForm } from "../shared/classes/EssentialForm";
import { EssentialFormControl } from "../shared/classes/EssentialFormControl";
import { FormTypeRule } from "../shared/constants/form-type-rule";
import { Utilities } from "../shared/classes/Utilities";
import { ToastTypeMessage } from "../shared/constants/toast-type-message";
import { ToastSeverityMessage } from "../shared/constants/toast-severity-message";
import { environment } from "../environment/environment";

export default function setGlobalProperties(app) {
    app.config.globalProperties.$env = environment;

    app.config.globalProperties.$utl = Utilities;

    app.config.globalProperties.$tstType = ToastTypeMessage;
    app.config.globalProperties.$tstSeverity = ToastSeverityMessage;

    app.config.globalProperties.$sstForm = (controls) => new EssentialForm(controls);
    app.config.globalProperties.$sstFormControl = (value, rules = []) => new EssentialFormControl(value, rules);
    app.config.globalProperties.$sstRule = FormTypeRule;
}