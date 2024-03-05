import { Utilities } from '../shared/classes/Utilities';
import { ToastTypeMessage } from '../shared/constants/toast-type-message';

// Validaciones y Protección de rutas
export default async (to, from, next) => {

    // Intenta acceder al login y está logeado
    if (to.path.includes("auth") && Utilities.store.state.user.data) {
        Utilities.genToast(ToastTypeMessage.USER_ALREADY_LOGGED);
        next({ name: 'Standards' });
        return;
    }

    // Intenta acceder al panel y no se encontró un usuario
    if (to.path.includes("panel") && !Utilities.store.state.user.data) {
        Utilities.genToast(ToastTypeMessage.USER_NOT_LOGGED_IN);
        next({ name: "Login" });
        return;
    }

    // Verificamos si la ruta tiene role(s) específicos y el usuario lo(s) cumple
    if (
        Array.isArray(to.meta.roles) &&
        !to.meta.roles.includes(Utilities.store.state.user.data.rol.id_rol)
    ) {
        Utilities.genToast(ToastTypeMessage.USER_ROL_NOT_ALLOWED);
        next(from.path);
        return;
    }

    // Pasaron las validaciones. El usuario cumple con los accesos necesarios.
    next();
};
