import Vue from "vue";
import Vuetify from "vuetify/lib";
import "vuetify/dist/vuetify.min.css";
import "material-design-icons-iconfont/dist/material-design-icons.css";
import "@mdi/font/css/materialdesignicons.min.css";

Vue.use(Vuetify);

const opts = {
    iconfont: "mdi",
};

export default new Vuetify(opts);
