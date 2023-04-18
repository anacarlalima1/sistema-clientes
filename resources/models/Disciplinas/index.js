import axios from "@/api";

export default class Disciplinas {
    constructor() {}

    static async getAll() {
        try {
            let response = await axios.get("/disciplinas");
            return response.data.disciplinas;
        } catch (err) {
            throw new Error(err);
        }
    }

}
