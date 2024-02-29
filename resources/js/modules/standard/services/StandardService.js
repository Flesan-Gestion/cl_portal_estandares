import axios from 'axios';
import store from '../../../store/index';
export class StandardService {
    constructor() { }

    static async all() {
        const standards = await axios.get(`/api/standard/all`);
        return standards.data;
    }

    static async saveComment(id, comment) {
        return await axios.put(`/api/standard/saveComment/${id}`, {
            comment,
            user: store.state.user.data.email
        });
    }

    static async create(standard) {
        return await axios.post(`/api/standard/create`, standard);
    }

    static async update(id, standard) {
        return await axios.put(`/api/standard/update/${id}`, standard);
    }

    static async delete(id) {
        return await axios.put(`/api/standard/delete/${id}`, {
            user: store.state.user.data.email
        });
    }

    static formatNewStandard(standard) {
        return {
            identifier: standard.identifier,
            especialidad: standard.especialidad,
            inmobiliaria: standard.inmobiliaria,
            tipo_definicion: standard.tipo_definicion,
            requerimiento: standard.requerimiento,
            descripcion: standard.descripcion,
            informacion: standard.informacion,
            user_create: store.state.user.data.email,
        }
    }

    static formatEditStandard(standard) {
        return {
            especialidad: standard.especialidad,
            inmobiliaria: standard.inmobiliaria,
            tipo_definicion: standard.tipo_definicion,
            requerimiento: standard.requerimiento,
            descripcion: standard.descripcion,
            informacion: standard.informacion,
            user_update: store.state.user.data.email,
        }
    }

}