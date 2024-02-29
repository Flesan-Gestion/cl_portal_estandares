import { Assets } from "../constants/assets";
import store from '../../store/index';
import { ToastsMessages } from '../constants/toast-messages';
import router from "../../routes/router";
export class Utilities {

    // Propiedad de blur para los modales
    static modalBlur = { mask: { style: 'backdrop-filter: blur(5px)' } };

    // Propiedad de conexión al store
    static store = store;

    // Formatear fecha
    static formatDate(date) {
        const year = date.getFullYear();
        const month = ("0" + (date.getMonth() + 1)).slice(-2);
        const day = ("0" + date.getDate()).slice(-2);
        return `${day}-${month}-${year}`;
    }

    // Formatear hora
    static formatTime(date) {
        const hours = ("0" + date.getHours()).slice(-2);
        const minutes = ("0" + date.getMinutes()).slice(-2);
        const seconds = ("0" + date.getSeconds()).slice(-2);
        return `${hours}:${minutes}:${seconds}`;
    }

    // Formatear dinero
    static formatMoney(number, currency, locale) {
        const formatNumber = new Intl.NumberFormat(locale, {
            style: "currency",
            currency: currency,
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
        });
        return formatNumber.format(number);
    }

    // Esperar unos segundos
    static sleep(miliseconds) {
        return new Promise((res, rej) => {
            setTimeout(() => {
                res(true);
            }, miliseconds);
        });
    }

    // Mostrar loader
    static showLoader(message = null) {
        store.commit("loader/show", message);
    }

    // Ocultar loader
    static hiddenLoader() {
        store.commit("loader/hidden");
    }

    // Mostrar modal de confirmación
    static showConfirmation(config) {
        store.commit('confirmation/show', config);
    }

    // Ocultar modal de confirmación
    static hiddenConfirmation() {
        store.commit('confirmation/hidden');
    }

    // Navegar a otra ruta
    static navigate(name) {
        router.push({ name });
    }

    // Generar un mensaje toast
    static genToast(typeMessage) {
        const message = ToastsMessages.find((m) => m.title == typeMessage);
        const toastBody = {
            severity: message?.severity,
            summary: message?.summary,
            detail: message?.detail,
            life: 4500,
        };
        store.commit("toast/show", toastBody);
    }

    // Generar un mensaje personalizado toast
    static genCustomeToast(severity, summary, detail) {
        const toastBody = { severity, summary, detail, life: 4500 };
        store.commit("toast/show", toastBody);
    }

    // Obtener imagen
    static getImg(fileName) {
        return Assets.image[fileName];
    }

    // Obtener svg
    static getSvg(fileName) {
        return Assets.svg[fileName];
    }

    static accessRol(roles){
        return roles.includes(store.state.user.data?.rol?.nombre);
    }

}
