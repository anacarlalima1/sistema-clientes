export default {
    methods: {
        //valida pelo objeto input
        verificarCampoVazio(input) {
            if (Array.isArray(input.valor)) {
                return Boolean(input.obrigatorio) && "Campo obrigatório";
            }

            if (Boolean(input.obrigatorio) && !input.valor) {
                return "Campo obrigatório";
            } else {
                return true;
            }
        },

        verificarSelectVazio(input) {
            if (input.multiplo) {
                return Boolean(input.obrigatorio) && !input.valor.length > 0 ? "Campo obrigatório" : true;
            } else if (Boolean(input.obrigatorio) && !input.valor) {
                return "Campo obrigatório";
            } else {
                return true;
            }
        },

        //Validar por valor
        validarUrlVideo(valor) {
            let regExpUrl = /^(http:\/\/|https:\/\/)(vimeo\.com|youtu\.be|www\.youtube\.com)\/([\w\/]+)([\?].*)?$/;

            if (valor.match(regExpUrl)) {
                return true;
            } else {
                return "Url inválida,apenas url do youtube ou vimeo.";
            }
        },

        validarEmail(valor) {
            let regExpUrl = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/gi;

            if (valor.match(regExpUrl)) {
                return true;
            } else {
                return "Email inválido.";
            }
        },

        validarTelefone(valor, obrigatorio = true) {
            let regExp = /^\(\d{2}\)\s\d{1}\s\d{4}-\d{4}$/;

            if (valor.match(regExp)) {
                return true;
            } else {
                if (!obrigatorio && !valor) {
                    return true;
                }
                return "Número inválido.";
            }
        },

        validarCnpj(valor, obrigatorio = true) {
            let regExp = /^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$/;

            if (valor.match(regExp)) {
                return true;
            } else {
                if (!obrigatorio && !valor) {
                    return true;
                }
                return "Cnpj Inválido.";
            }
        },

        validarLimiteCaracteres(valor, limite) {
            if (valor.length <= limite) {
                return true;
            } else {
                return `Limite de caracteres atingido.Max ${limite} caracteres.`;
            }
        },

        validarMinimoCaracteres(valor, limite) {
            if (valor.length > limite) {
                return true;
            } else {
                return `Limite de caracteres não atingido.Min ${limite} caracteres.`;
            }
        },
    },
};
