<template>
    <div>
        <section class="ma-8">
            <h3 class="mb-4">
                {{ titulo ?? "" }}
            </h3>
            <p>
                Plataforma desenvolvida com o intuito de armazenar informações de clientes.
            </p>
            <slot name="tabs"/>

            <div class="d-flex justify-space-between align-center my-10">
                <section class="d-flex align-center">
                    <slot name="botoes"></slot>
                </section>
                <v-btn large @click="modalInserirAberto = true" dark rounded color="#00bfa6">
                    Inserir Novo Cliente
                </v-btn>
            </div>
            <div class="d-flex align-center mt-5">
                <v-text-field
                    v-model="pesquisa"
                    :label="labelPesquisa"
                    class="mb-0 flex-grow-1"
                    outlined rounded
                    hide-details="true"
                    append-icon="mdi-magnify"
                    @click:append="$emit('filtrar-nome', pesquisa)"
                    @keyup.enter="$emit('filtrar-nome', pesquisa)"
                />
            </div>
        </section>

        <section class="ma-5">
            <slot name="tabela"/>
        </section>

        <modal-inserir
            :aberto="modalInserirAberto"
            @close-modal="modalInserirAberto = false"
            @salvar-registro="$emit('salvar-registro', $event)"
            :inputs="inputs"
        />

        <Loading :dialog="isLoading"/>
    </div>
</template>

<script>
import alerts from "../mixins/alerts";
import Loading from "../components/ui/Loading.vue";
import ModalInputs from "../components/feedback/ModalInputs.vue";
import Filtro from "../pages/Filtro.vue";

export default {
    name: "BaseCrud",
    components: {
        Loading,
        "modal-inserir": ModalInputs,
        Filtro,
    },
    mixins: [alerts],

    props: {
        filtros: {},
        labelPesquisa: {},
        inputs: {},

        titulo: {
            default: "",
        },
    },
    data() {
        return {
            page: 1,
            pesquisa: "",
            isLoading: false,
            modalInserirAberto: false,
            modalExcluirAberto: false,
        };
    },

    methods: {},
    created() {
        this.editar = () => (this.modalInserirAberto = true);
    },
};
</script>

<style></style>
