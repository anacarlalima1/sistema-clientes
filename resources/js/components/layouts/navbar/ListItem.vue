<template>
    <v-list-item
        @click="clickAcaoMenu(item)"
        class="item-nav"
        :class="{ selected: getIsSelectByRoute(item) }"
    >
        <v-list-item-icon class="d-flex align-center justify-center mx-0 my-2">
            <component
                :is="item.icon"
                :color="rotaAtiva(item.rota) ? '#167A83' : '#167A83'"
            />
        </v-list-item-icon>

        <v-list-item-title
            class="item-title ms-5 my-0"
            :style="{ whiteSpace: 'normal' }"
        >
            {{ item.titulo }}
        </v-list-item-title>
    </v-list-item>
</template>

<script>
import api from "@/api";

import Swal from "sweetalert2";
export default {
    name: "ListItem",
    props: {
        item: { type: Object },
    },
    methods: {
        clickAcaoMenu(menu) {
            if (menu.rota == "/sair") {
                this.sair();
            } else if (menu.rota) {
                if (menu.rota != this.$route.fullPath) {
                    this.$router.push(menu.rota);
                }
            } else {
                this.alertWarning(menu.detalhesModal);
            }
        },
        getIsSelectByRoute(item) {
            return this.$route.fullPath.includes(item.rota);
        },

        rotaAtiva(rota) {
            return this.$route.fullPath.indexOf(rota) !== -1;
        },

        sair() {
            Swal.fire({
                title: "Tem certeza que deseja sair?",
                confirmButtonText: "Sair",
                showCancelButton: true,
                cancelButtonText: "Quero estudar",
                customClass: {
                    title: "text-swal",
                    cancelButton: "azul-swal",
                    confirmButton: "vermelho-swal",
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    api.get("/sair");
                    window.location.href = "/sair";
                }
            });
        },
    },
};
</script>

<style scoped lang="scss">
@import "@sass/_variables.scss";
.item-nav {
    padding-top: 10px;
    padding-bottom: 10px;
    margin-bottom: 10px;
}
.item-title {
    font-size: 1.1rem;
    color: $primary60;
    margin: 0px;
    font-weight: 500;
}
.item-nav.selected {
    background-color: #167a831d;
}
</style>
