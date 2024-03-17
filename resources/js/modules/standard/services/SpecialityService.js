import axios from 'axios';
export class SpecialityService {
    constructor() { }

    static async all() {
        const specialities = await axios.get(`/api/speciality/all`);
        return specialities.data;
    }
}