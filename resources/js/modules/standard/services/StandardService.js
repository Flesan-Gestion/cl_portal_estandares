import axios from "axios";
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
}