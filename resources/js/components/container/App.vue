<template>
    <v-app class="background">
        <navbar v-if="temNavbar" :menu-open="menuAberto" />
        <v-container fluid :class="{ 'padding-70': temNavbar }" class="py-0">

            <keep-alive>
                <router-view
                    class="padding-container"
                    :key="$route.fullPath"
                ></router-view>
            </keep-alive>
        </v-container>
    </v-app>
</template>

<script>
import Navbar from "@/components/layouts/navbar/Navbar.vue";
import Header from "@/components/layouts/Header.vue";
export default {
    components: { Navbar, "base-header": Header },
    data() {
        return { menuAberto: true };
    },
    computed: {
        temNavbar() {
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
