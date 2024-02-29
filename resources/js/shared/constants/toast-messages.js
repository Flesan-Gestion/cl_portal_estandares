import { ToastTypeMessage } from './toast-type-message';
import { ToastSeverityMessage } from './toast-severity-message';

export const ToastsMessages = [
  {
    title: ToastTypeMessage.LOGOUT_SUCCESS,
    severity: ToastSeverityMessage.SUCCESS,
    summary: 'Operación Exitosa',
    detail: 'Se ha cerrado su sesión'
  },
  {
    title: ToastTypeMessage.USER_ALREADY_LOGGED,
    severity: ToastSeverityMessage.ERROR,
    summary: 'Hubo un problema',
    detail: 'Su usuario ya se encuentra logeado'
  },
  {
    title: ToastTypeMessage.USER_NOT_LOGGED_IN,
    severity: ToastSeverityMessage.ERROR,
    summary: 'Hubo un problema',
    detail: 'Su usuario no se encuentra logeado'
  },
  {
    title: ToastTypeMessage.USER_ROL_NOT_ALLOWED,
    severity: ToastSeverityMessage.ERROR,
    summary: 'Hubo un problema',
    detail: 'Su usuario no tiene acceso a este recurso'
  },
  {
    title: ToastTypeMessage.FORM_ERROR,
    severity: ToastSeverityMessage.WARN,
    summary: 'Hubo un problema',
    detail: 'Los campos no están rellenados correctamente'
  },

  {
    title: ToastTypeMessage.SERVER_ERROR,
    severity: ToastSeverityMessage.ERROR,
    summary: 'Hubo un problema interno',
    detail: 'Contacta con la área de sistemas'
  },

  {
    title: ToastTypeMessage.UNKNOWN_ERROR,
    severity: ToastSeverityMessage.ERROR,
    summary: 'Hubo un problema interno',
    detail: 'Hubo un error desconocido'
  },
  {
    title: ToastTypeMessage.REGISTER_SUCCESS,
    severity: ToastSeverityMessage.SUCCESS,
    summary: 'Operación Exitosa',
    detail: 'El registro ha sido guardado'
  },
  {
    title: ToastTypeMessage.REGISTER_ERROR,
    severity: ToastSeverityMessage.ERROR,
    summary: 'Hubo un problema',
    detail: 'Hubo un error desconocido'
  },
  {
    title: ToastTypeMessage.REGISTER_COMMENT_SUCCESS,
    severity: ToastSeverityMessage.SUCCESS,
    summary: 'Hubo un problema',
    detail: 'Se ha guardado su comentario'
  },
]

