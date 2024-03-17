import axios from 'axios';
export class RealEstateService {
    constructor() { }

    static async all() {
        const realEstates = await axios.get(`/api/realEstate/all`);
        return realEstates.data;
    }
}