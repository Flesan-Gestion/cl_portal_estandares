import axios from "axios";
import store from '../../../store/index';
export class UserService {
    constructor() { }

    static async getUsers() {
        const users = await axios.get(`/api/user/getUsers`);
        return users.data;
    }

    static async create(user) {
        return await axios.post(
            `/api/user/create`,
            user
        );
    }

    static async update(id, user) {
        return await axios.put(
            `/api/user/update/${id}`,
            user
        );
    }

    
    static formatNewUser(newUser) {
        return {
            username: newUser.email,
            fecha_ini: new Date(),
            name: `${newUser.nombres} ${newUser.apellidos}`,
            provider: 'GOOGLE',
            estado_sesion: 1,
            dni: newUser.dni,
            nombres: newUser.nombres,
            apellidos: newUser.apellidos,
            estado_validacion: 1,
            pais: newUser.country
        }
    }

    static formatEditUser(newUser) {
        return {
            name: `${newUser.nombres} ${newUser.apellidos}`,
            provider: 'GOOGLE',
            dni: newUser.dni,
            nombres: newUser.nombres,
            apellidos: newUser.apellidos,
            pais: newUser.country
        }
    }

    static async enable(id) {
        const users = await axios.put(`/api/user/enable/${id}`);
        return users.data;
    }

    static async disable(id) {
        const users = await axios.put(`/api/user/disable/${id}`);
        return users.data;
    }

}