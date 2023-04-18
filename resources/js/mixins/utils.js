export default {
    methods: {
        getArrayObjetosInputsFiltrados(inputs) {
            let arrayObjetosFiltrados = Object.entries(inputs).filter((array) => {
                let input = array[1];
                if (typeof input.valor == "object") {
                    if (Array.isArray(input.valor)) {
                        return input.valor.length > 0;
                    } else {
                        return input.valor;
                    }
                } else {
                    return input.valor;
                }
            });
            return arrayObjetosFiltrados;
        },

        getPostData(inputs) {
            let arrayObjetosInputs = this.getArrayObjetosInputsFiltrados(inputs || this.inputs);
            // console.log('array', arrayObjetosInputs);

            let formData = new FormData();

            for (let [chave, input] of arrayObjetosInputs) {
                formData.append(chave, input.valor);
            }

            return formData;
        },
        getInputsComMapArrayId() {
            let newInputs = structuredClone(this.inputs);
            console.log(newInputs);
            for (let input of Object.values(newInputs)) {
                if (input.multiplo) {
                    input.valor = input.valor.map((item) => item.id);
                } else {
                    input.valor = input.valor.id;
                }
            }

            return newInputs;
        },
        limparDadosInputs(inputs) {
            for (let input of Object.values(inputs || this.inputs)) {
                if (typeof input.valor != "object") {
                    input.valor = "";
                } else {
                    input.valor = [];
                }
            }
        },
        limparErrosInputs(inputs) {
            for (let input of Object.values(inputs || this.inputs)) {
                if (input.erros) {
                    input.erros = [];
                }
            }
        },

        setErrosInputs(messages = {}) {
            for (let nomeIndice in messages) {
                this.inputs[nomeIndice].erros = messages[nomeIndice].join(", ");
            }
        },
    },
};

