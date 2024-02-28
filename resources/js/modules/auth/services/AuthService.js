import axios from "axios";

export class AuthService {
    constructor(){}

    static async getToken(email){
        const token = await axios.get(`/api/auth/getToken/${email}`);
        return token.data;
    }
}