import axios from "axios";
import store from '../../../store/index';
export class UserRolService {
    constructor() { }

    static async create(userRol) {
        const roles = await axios.post(`/api/userRol/create`, userRol);
        return roles.data;
    }

    static async updateRol(id, rol) {
        const roles = await axios.put(`/api/userRol/updateRol/${id}`, {
            rol
        });
        return roles.data;
    }

    static formatNewUserRol(idApplicationUser, idRol) {
        return {
            id_aplicacion_usuario: idApplicationUser,
            id_rol: idRol,
            objeto_permitido: null,
            fecha_ini: new Date(),
            estado: 1
        }
    }
}