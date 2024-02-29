import axios from "axios";
import store from '../../../store/index';
export class RolService {
    constructor() { }

    static async all() {
        const roles = await axios.get(`/api/rol/all`);
        return roles.data;
    }
}