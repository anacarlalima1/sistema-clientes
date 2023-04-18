import axios from "@/api";
import utils from "../../../utils/formData";


export default class Turmas {
    constructor() {
    }

    static async getByUser() {
        try {
            let response = await axios.get("/minhas-turmas");
            return response.data.turmas;
        } catch (err) {
            throw new Error(err);
        }
    }
    static async selectTurmas() {
        try {
            let response = await axios.get("/select-turmas");
            return response.data.turmas;
        } catch (err) {
            throw new Error(err);
        }
    }

    static async getAll() {
        try {
            let response = await axios.get("/turmas");
            return response.data.turmas;
        } catch (err) {
            throw new Error(err);
        }
    }
    static async getByEscola() {
        try {
            let response = await axios.get("/turmas-escolas");
            return response.data.turmas;
        } catch (err) {
            throw new Error(err);
        }
    }
}
