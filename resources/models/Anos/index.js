import axios from "@/api";

export default class Anos {
    constructor() {}

    static async getAll() {
        try {
            let response = await axios.get("/anos");
            return response.data.anos;
        } catch (err) {
            throw new Error(err);
        }
    }

}
