import axios from 'axios';
import store from '../../../store/index';
export class StandardService {
    constructor() { }

    static async allViewer() {
        const standards = await axios.get(`/api/standard/allViewer`);
        return standards.data;
    }

    static async allAdministrator() {
        const standards = await axios.get(`/api/standard/allAdministrator`);
        return standards.data;
    }

    static async generateCode(idSpeciality) {
        const code = await axios.get(`/api/standard/generateCode/${idSpeciality}`);
        return code.data;
    }

    static async create(standard) {
        return await axios.post(`/api/standard/create`, standard);
    }

    static async update(id, standard) {
        return await axios.put(`/api/standard/update/${id}`, standard);
    }

    static async enable(id) {
        return await axios.put(`/api/standard/enable/${id}`, {
            user: store.state.user.data.email
        });
    }

    static async disable(id) {
        return await axios.put(`/api/standard/disable/${id}`, {
            user: store.state.user.data.email
        });
    }

    static formatNewStandard(standard) {
        return {
            st_code: standard.code,
            st_code_number: parseInt(standard.code.split('-')[1]),
            st_speciality_id: standard.speciality,
            st_real_estate_id: standard.realEstate,
            st_type_definition: standard.typeDefinition,
            st_request: standard.request,
            st_description: standard.description,
            st_information: standard.information,
            user_create: store.state.user.data.email,
        }
    }

    static formatEditStandard(standard) {
        return {
            st_code: standard.code,
            st_speciality_id: standard.speciality,
            st_real_estate_id: standard.realEstate,
            st_type_definition: standard.typeDefinition,
            st_request: standard.request,
            st_description: standard.description,
            st_information: standard.information,
            user_update: store.state.user.data.email,
        }
    }

}