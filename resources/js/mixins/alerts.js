import Swalert from "sweetalert2";

const objetos = {
    methods: {
        //tratamento de erro
        alertErro(e, errorMessage) {
            let mensagem;

            let responseErrorMessage = e?.response?.data?.message || "";

            if (responseErrorMessage) {
                if (typeof responseErrorMessage == "object") {
                    mensagem = Object.values(responseErrorMessage).join(",");
                } else {
                    mensagem = responseErrorMessage;
                }
            } else if (errorMessage) {
                mensagem = errorMessage;
            } else {
                mensagem =
                    erros?.[e?.response?.status] ||
                    "Sem conexão com o servidor";
            }
            console.log(e);

            Swalert.fire({
                icon: "error",
                title: mensagem,
            });
        },

        //alert de confirmação
        async alertAnswer(
            message = "Tem certeza que deseja realizar o procedimento?",
            text = "",
            icone = "warning"
        ) {
            return Swalert.fire({
                icon: icone,
                title: message,
                html: text,
                showCancelButton: true,
            });
        },

        //alert de alerta
        async alertWarning(
            message = "Verifique as informações",
            descricao = ""
        ) {
            return Swalert.fire({
                icon: "warning",
                title: message,
                text: descricao,
            });
        },

        async alertSuccess(
            message = "Procedimento realizado com sucesso!",
            text = ""
        ) {
            return Swalert.fire({
                icon: "success",
                title: message,
                html: text,
            });
        },
    },
};

export default objetos;
