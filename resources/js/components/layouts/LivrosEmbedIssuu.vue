<template>
    <div>
        <section>
            <div
                style="
                    margin-top: 20px;
                    position: relative;
                    padding-top: max(60%, 326px);
                    height: 100%;
                    width: 100%;
                "
            >
                <iframe
                    allow="clipboard-write"
                    sandbox="allow-top-navigation allow-top-navigation-by-user-activation allow-downloads allow-scripts allow-same-origin allow-popups allow-modals allow-popups-to-escape-sandbox allow-forms"
                    allowfullscreen="true"
                    style="
                        position: absolute;
                        border: none;
                        width: 100%;
                        height: 100%;
                        left: 0;
                        right: 0;
                        top: 0;
                        bottom: 0;
                    "
                    :src="urlLivro"
                ></iframe>
            </div>
        </section>
    </div>
</template>

<script>
import Loading from "@/components/Loading.vue";
import alerts from "@/alerts";

export default {
    name: "LivrosEmbedIssuu",
    mixins: [alerts],
    components: {
        Loading,
    },
    computed: {
        urlLivro() {
            return this.$route.params.link;
        },
    },
    methods: {
        verificarSeLivroEstaSetado() {
            if (!this.$route.params.link) {
                this.$router.go(-1);
            }
        },
    },
    activated() {
        this.verificarSeLivroEstaSetado();
    },
};
</script>
