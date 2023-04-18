const objetos = {
    getDataInputs: (inputs) => {
        let formData = new FormData();

        for (let chave in inputs) {
            if (typeof inputs[chave] == "object") {
                for (let [index, ch] of inputs[chave].entries()) {
                    formData.append(`${chave}[${index}]`, ch);
                }
                continue;
            }

            formData.append(`${chave}`, inputs[chave]);

            // console.log(chave, inputs[chave]);
        }

        return formData;
    },

    limparInputs: (inputs) => {
        for (let obj in inputs) {
            if (typeof inputs[obj] == "object") {
                inputs[obj] = [];
                continue;
            }

            if (typeof inputs[obj] == "number") {
                inputs[obj] = 0;
            }

            inputs[obj] = "";
        }

        return inputs;
    },
};

export default objetos;
