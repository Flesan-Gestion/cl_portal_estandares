import { ToastTypeMessage } from './toast-type-message';
import { ToastSeverityMessage } from './toast-severity-message';

export const ToastsMessages = [

  {
    title: ToastTypeMessage.REGISTER_SUCCESS,
    severity: ToastSeverityMessage.SUCCESS,
    summary: 'Operación Exitosa',
    detail: 'El registro ha sido guardado'
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
]

