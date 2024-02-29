import axios from "axios";
import store from '../../../store/index';
export class UserService {
    constructor() { }

    static async getUsers() {
        const users = await axios.get(`/api/user/getUsers`);
        return users.data;
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