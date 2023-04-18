import axios from "@/api";

export default class Escolas {

    constructor() {}
    static async getByUser() {
        try {
            let response = await axios.get("/minhas-escolas");
            let data = response.data.escolas;
            return data;
        } catch (err) {
            throw new Error(err);
        }
    }

    static async getAll() {
        try {
            let response = await axios.get("/escolas");
            let data = response.data;

            return data;
        } catch (err) {
            throw new Error(err);
        }
    }

}
