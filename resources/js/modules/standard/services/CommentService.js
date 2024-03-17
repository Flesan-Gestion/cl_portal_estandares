import axios from 'axios';
import store from '../../../store/index';
export class CommentService {
    constructor() { }

    static async getByStandard(idStandard) {
        const comments = await axios.get(`/api/comment/getByStandard/${idStandard}`);
        return comments.data;
    }

    static async create(comment) {
        return await axios.post(`/api/comment/create`, comment);
    }

    static formatNewComment(newComment, idStandard) {
        return {
            cm_comment: newComment,
            cm_standard_id: idStandard,
            user_create: store.state.user.data.email,
        }
    }
}