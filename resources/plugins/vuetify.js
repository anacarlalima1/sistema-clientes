import Vue from 'vue';
import Vuetify from 'vuetify/lib';
import 'vuetify/dist/vuetify.min.css';

Vue.use(Vuetify)

const opts = {
    icons: {
        iconfont: 'mdi',
        values: {
            home: {
                component: "home",
            },
            grafico: {
                component: "grafico",
            },
            chapeu: {
                component: "chapeu",
            },
            play: {
                component: "play",
            },
            arquivo: {
                component: "arquivo",
            },
            interrogacao: {
                component: "interrogacao",
            },
            sair: {
                component: "sair",
            },
            cadeado: {
                component: "cadeado",
            },
            calendario: {
                component: "calendario",
            },
            setinha_direita: {
                component: "setinha_direita",
            },
            setinha_esquerda: {
                component: "setinha_esquerda",
            },
            bolinha: {
                component: "bolinha",
            },
        },
    },
}

export default new Vuetify(opts)
