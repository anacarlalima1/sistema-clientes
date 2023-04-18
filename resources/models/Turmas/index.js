import api from "@/api";
import utils from "../../utils/formData";
const objetos = {
    data(){
        return {
            turmas: [],
        }
    },
    methods: {
        async getTurmasAnos(id_ano, id_escola) {
            try {
                let forms = utils.getDataInputs({anos: id_ano.map((e) => e.id), escola: id_escola})
                let dados = await api.post(`/turma-ano`, forms);
                this.turmas = dados.data.turmas;
            }catch (e){

            }
        },
        async getTurmasEscola(id_escola) {
            try {
                let forms = utils.getDataInputs({escola: id_escola})
                let dados = await api.post(`/turma-escola`, forms);
                this.turmas = dados.data.turmas;
            }catch (e){

            }
        },
        async getSelectTurmasEscolas(ids_escolas) {
            try {
                // let forms = utils.getDataInputs({ids_escolas: ids_escolas})
                let dados = await api.get(`/select-turmas`, {params: {'ids_escolas': ids_escolas}});
                return dados.data.turmas;
            }catch (e){
                throw new Error(e);
            }
        }
    }
};

export default objetos;
