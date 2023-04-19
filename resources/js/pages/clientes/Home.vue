<template>
    <div>
        <base-header titulo="Meus Clientes" />

        <div class="container-default">
            <base-crud
                titulo="Clientes"
                label-pesquisa="Digite o nome"
                :inputs="inputs"
                @filtrar-nome="
					nomeFiltro = $event;"
                @salvar-registro="(callback) => adicionarCliente(callback)"
            >
                <template #tabela>
                    <v-data-table
                        :headers="tableHeaders"
                        :items="table.data"
                        :items-per-page="table.per_page"
                        hide-default-footer
                        class="elevation-1"
                    >
                        <template #item.imagem="{ item }">
                            <td>
                                <v-avatar @click="imagemSelecionada = item.imagem; modalVerMediaAberto = true" size="30">
                                    <img :src="item.imagem" alt="Imagem Tabela"/>
                                </v-avatar>
                            </td>
                        </template>
                        <!-- Editar | Excluir column -->
                        <template #item.actions="{ item }">
                            <td>
                                <menu-action @excluir="excluirCliente(item.id)" @editar="editarCliente(item.id)"  />
                            </td>
                        </template>
                    </v-data-table>

                    <div class="text-center pt-2">
                        <v-pagination
                            v-if="table.last_page > 1"
                            v-model="table.current_page"
                            :length="table.last_page"
                            @input="listarClientes('?page=' + table.current_page)"
                        />
                    </div>
                </template>
            </base-crud>
        </div>
        <modal-ver-media
            tipo="imagem"
            :url="imagemSelecionada"
            :aberto="modalVerMediaAberto"
            @close-modal="modalVerMediaAberto = false"
        />

        <modal-atualizar
            :aberto="modalAtualizarAberto"
            @close-modal="
				modalAtualizarAberto = false;
				resetarDadosInputs();
			"
            @salvar-registro="atualizarCliente"
            :inputs="inputs"
        />

        <loading :dialog="isLoading" />
    </div>
</template>

<script>
import BaseCrud from "../BaseCrud.vue";
import Header from "../../components/layouts/Header.vue";
import MenuAction from "../MenuAction.vue";
import { BaseField, TableHeader } from "../../../utils/construtorObjetos";
import axios from "@/api";
import alerts from "../../mixins/alerts";
import inputRules from "../../mixins/inputRules";
import utils from "../../mixins/utils";
import ModalInputs from "../../components/feedback/ModalInputs";
import ModalVerMedia from "../../components/feedback/ModalVerMedia";
import Loading from "../../components/ui/Loading";

const inputObject = {
    nome: new BaseField("Nome", "Digite o nome", "textfield", true, ""),
    nome_social: new BaseField("Nome Social", "Digite o nome social", "textfield", true, ""),
    cpf: {...new BaseField("CPF ou CNPJ", "Digite o CPF ou CNPJ", "textfield", true, ""),
        rules: [(valor) => this.validarCnpj(valor)],},
    data_nasc: new BaseField("Data de Nascimento", "Digite a sua data de nascimento", "date", true, ""),
    imagem: new BaseField("Foto", "Selecione a foto", "imagem", true, []),};
export default {
    name: "Home",
    props: { tipo: String },
    components: {
        BaseCrud,
        "base-header": Header,
        MenuAction,
        "modal-atualizar": ModalInputs,
        ModalVerMedia,
        Loading,
    },
    mixins: [alerts, utils, inputRules],
    data() {
        return {
            nomeFiltro: "",
            clienteSelecionado: null,
            imagemSelecionada: null,

            isLoading: false,
            modalAtualizarAberto: false,
            modalVerMediaAberto: false,

            inputs: JSON.parse(JSON.stringify(inputObject)),

            tableHeaders: [
                new TableHeader("Foto", "start", false, "imagem"),
                new TableHeader("Nome", "start", false, "nome"),
                new TableHeader("Nome Social", "start", false, "nome_social"),
                new TableHeader("CPF ou CNPJ", "start", false, "cpf"),
                new TableHeader("Data de Nascimento", "start", false, "data_nasc"),
                new TableHeader("Actions", "start", false, "actions"),
            ],
            table:{},
}
},
    methods: {
        resetarDadosInputs() {
            this.inputs = JSON.parse(JSON.stringify(inputObject));
        },
        async excluirCliente(id) {
            try {
                let { isConfirmed } = await this.alertAnswer("Deseja excluir o cliente?", "");
                if (isConfirmed) {
                    let response = await axios.delete(`/cadastro/cliente?id=${id}`, {
                        id: id,
                    });
                    let data = response.data;
                    if (data.success) {
                        this.listarClientes();
                    }
                }
            } catch (err) {
                this.alertErro(err, err);
            }
        },
        async editarCliente(id) {
            try {
                let response = await axios.get(`/cadastro/cliente?id=${id}`);
                let data = response.data;
                this.clienteSelecionado = data.cliente;
                this.setDataAtualizarEscola(data.cliente);
                this.modalAtualizarAberto = true;
            } catch (err) {
                this.alertErro(err, err);
            }
        },
        setDataAtualizarEscola(data) {
            this.inputs["imagem"].valor = null;
            this.inputs["imagem"].obrigatorio = false;
            this.inputs["imagem"].placeholder = "Deixe vazio caso não queira atualizar o campo";

            this.inputs["nome_social"].valor = data?.nome_social;
            this.inputs["nome"].valor = data?.nome;
            this.inputs["cpf"].valor = data?.cpf;
            this.inputs["data_nasc"].valor = data?.data_nasc;
        },
        async atualizarCliente(callback = () => {}) {
            this.isLoading = true;
            try {
                const formData = this.getPostData();
                formData.append("id", this.clienteSelecionado.id);
                let response = await axios.post(`/cadastro/editar-cliente`, formData);
                if (response.data.success) {
                    this.alertSuccess("Cliente atualizado com sucesso!");
                    callback();
                    this.listarClientes();
                }
            } catch (err) {
                this.alertErro(err, err);
                this.isLoading = false;
                this.setErrosInputs(err?.response?.data?.message || []);
            }
            this.isLoading = false;
        },
        async adicionarCliente(callback = () => {}) {
            this.isLoading = true;
            try {
                const formData = this.getPostData();
                let response = await axios.post(`/cadastro/cliente`, formData);
                if (response.data.success) {
                    this.alertSuccess("Cliente adicionado com sucesso!");
                    callback();
                    this.listarClientes();
                    this.limparDadosInputs();
                }
            } catch (err) {
                this.alertErro(err, err);
                this.setErrosInputs(err?.response?.data?.message || []);
            }
            this.isLoading = false;
        },
        async listarClientes(pagina = "?page=1") {
            this.isLoading = true;
            try {
                let response = await axios.get(`/cadastro/clientes${pagina}`, {params:{nome: this.nomeFiltro}});
                let data = response.data;
                this.table = data.clientes;
            } catch (err) {
                this.alertErro(err, err);
            }
            this.isLoading = false;
        },
    },
    created() {
        this.listarClientes();
    }
};
</script>
<style></style>
