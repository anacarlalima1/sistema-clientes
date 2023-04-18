window.Vue = require("vue");

import Vue from "vue";
import VueRouter from "vue-router";
import Vuetify from "vuetify/lib";
import routes from "./routes/router";
import VuePlyr from "vue-plyr";
import "vue-plyr/dist/vue-plyr.css";
import "vue-datetime/dist/vue-datetime.css";

import { Settings } from "luxon";
import { VueMaskDirective } from "v-mask";

const lightTheme = {
    primary10: "#00BFA6;",
    primary60: "#167A83;",
    red10: "#FDEAEA;",
    red60: "#E73232;",
    yellow10: "#FFF5E5;",
    yellow60: "#FF9900;",
};
const darkTheme = {
    primary10: "#00BFA6;",
    primary60: "#167A83;",
};

const vuetify = new Vuetify({
    theme: {
        themes: {
            dark: darkTheme,
            light: lightTheme,
        },
    },
});

Vue.use(Vuetify);
Vue.use(VueRouter);
Vue.use(VuePlyr, {
    plyr: {},
});

Vue.directive("mask", VueMaskDirective);

Vue.component("app", require("./components/container/App.vue").default);

Settings.defaultLocale = "pt-br";

const router = new VueRouter({
    routes,
    mode: "history",
});

const app = new Vue({
    el: "#app",
    vuetify,
    router: router,
});
