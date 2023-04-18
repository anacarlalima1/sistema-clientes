<template>
    <v-app class="background">
        <navbar v-if="temNavbar" :menu-open="menuAberto" />
        <v-container fluid :class="{ 'padding-70': temNavbar }">
            <keep-alive>
                <router-view :key="$route.fullPath"></router-view>
            </keep-alive>
        </v-container>
    </v-app>
</template>

<script>
import Navbar from "@/components/navbar/Navbar.vue";

export default {
    components: { Navbar },

    data() {
        return { menuAberto: true };
    },
    computed: {
        temNavbar() {
            console.log(this.$route);
            let rotasSemNavbar = ["/"];
            return !rotasSemNavbar.includes(this.$route.fullPath);
        },
    },
};
</script>

<style lang="scss">
@import "@sass/_variables.scss";

.background {
    background-color: $background !important;
}
.padding-70 {
    padding-left: 70px;
}
</style>
