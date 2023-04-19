<template>
    <div class="modal" v-if="modalAberto" @click.self="$emit('close-modal')">
        <v-icon
            @click="$emit('close-modal')"
            color="white"
            class="modal__icon-close"
        >
            mdi-close
        </v-icon>

        <img
            v-if="tipo == 'imagem'"
            class="modal__media"
            :src="url"
            alt="Imagem Visualização"
        />

    </div>
</template>

<script>
export default {
    name: "ModalVerMedia",
    props: {
        aberto: {
            type: Boolean,
        },
        url: {
            type: String,
        },
        tipo: {
            type: String,
            validator: (value) =>
                value == "imagem",
        },
        itens: {},
    },
    emits: ["close-modal"],
    computed: {
        modalAberto() {
            return this.aberto;
        },
    },
    created() {
        console.log(this.url);
    },
};
</script>

<style lang="scss" scoped>
.plyr--video {
    max-width: 600px;
    max-height: 400px;
    min-height: 200px;
    width: 100%;
}
.modal {
    position: fixed;
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    z-index: 100;
    display: flex;
    justify-content: center;
    align-items: center;
    background: rgba(0, 0, 0, 0.8);
    &__media {
        min-width: 200px;
        max-width: 600px;
        max-height: 500px;
        margin: 0 30px;
    }
    &__icon-close {
        position: absolute;
        top: 50px;
        right: 50px;
        z-index: 110;
    }
}
</style>
