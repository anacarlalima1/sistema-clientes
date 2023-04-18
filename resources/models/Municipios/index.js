import axios from "@/api";


export default class Municipios {
    constructor() {
    }

    static async getAll() {
        try {
            let response = await axios.get("/cadastro/escolas/listar-municipios");
            return response.data.municipio;
        } catch (err) {
            throw new Error(err);
        }
    }
}
