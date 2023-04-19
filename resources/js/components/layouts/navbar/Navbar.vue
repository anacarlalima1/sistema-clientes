<template>
    <v-navigation-drawer
        class="navigation"
        :expand-on-hover="!isMobile"
        fixed
        permanent
        stateless
        touchless
        left
        mini-variant-width="70"
        v-if="isMenuOpen"
    >
        <v-row class="pa-4">
            <v-col cols="12 d-flex justify-end">
                <v-icon v-if="isMobile" @click="$emit('toggleMenu')" size="35">
                    mdi-close
                </v-icon>
            </v-col>

            <v-col class="px-0">
                <template>
                    <v-list-item class="d-flex justify-center pa-0" two-line>
                        <img class="logo" src="/icones/logo.png" />
                    </v-list-item>
                </template>
                <v-list>
                    <div
                        v-for="(menu, i) in menus"
                        :key="'menu' + i"
                    >
                        <list-item v-if="!menu.group" :item="menu" />

                        <list-group-item v-else :menu="menu" />
                    </div>
                </v-list>
            </v-col>
        </v-row>
    </v-navigation-drawer>
</template>

<script>
import Home from "../../icons/Home.vue";
import Avaliacao from "../../icons/Avaliacao.vue";
import Sair from "../../icons/Sair.vue";
import Relatorio from "../../icons/Relatorio.vue";
import ListItem from "./ListItem.vue";
import ListGroupItem from "./ListGroupItem.vue";

export default {
    props: ["menuOpen", "toggleMenu"],
    components: {
        Home,
        Avaliacao,
        Relatorio,
        Sair,
        ListItem,
        ListGroupItem,
    },
    data() {
        return {
            drawer: true,
            isMenuOpen: false,
            menus: [
                {
                    titulo: "Início",
                    icon: Home,
                    rota: "/home",
                    ativo: false,
                },
                {
                    titulo: "Redações Reescritas",
                    icon: Avaliacao,
                    rota: "/redacao/reescrita",
                    ativo: false,
                },
                {
                    titulo: "Relatorio",
                    icon: Relatorio,
                    rota: "/relatorio",
                    ativo: false,
                },
                {
                    titulo: "Sair",
                    icon: Sair,
                    rota: "/sair",
                    ativo: false,
                },
            ],
        };
    },
    watch: {
        toggleMenu() {
            this.isMenuOpen = !this.isMenuOpen;
        },
    },
    computed: {
        isMobile() {
            return this.$vuetify.breakpoint.width <= 600;
        },
    },
    created() {
        this.isMenuOpen = this.menuOpen;
    },
};
</script>

<style scoped lang="scss">
.logo {
    max-width: 80px;
    width: 80%;
    object-fit: cover;
}
.padding-left-70 {
    padding-left: 70px;
}
</style>
