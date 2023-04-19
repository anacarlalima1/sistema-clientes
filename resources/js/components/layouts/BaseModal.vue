<template>
    <v-dialog
        v-if="getIsModalOpen"
        v-model="getIsModalOpen"
        persistent
        :max-width="maxWidth"
        :retain-focus="retainFocus"
    >
        <div class="base-modal position-relative">
            <div class="d-flex justify-end">
                <v-btn
                    @click="$emit('close-modal')"
                    class="ms-3"
                    small
                    fab
                    color="#CE0000"
                >
                    <v-icon color="#fff"> mdi-close </v-icon>
                </v-btn>
            </div>

            <div class="modal__content" :class="getAlignClass()">
                <slot></slot>
                <slot name="imagem"> </slot>
                <slot name="descricao"> </slot>
            </div>

            <div class="mt-6 modal__buttons">
                <slot name="buttons"></slot>
            </div>
        </div>
    </v-dialog>
</template>

<script>
export default {
    name: "ModalPadrao",
    emits: ["closeModal"],
    props: {
        modalAberto: {
            type: Boolean,
            validator: (value) => value === true || value === false,
            required: true,
        },
        maxWidth: {
            type: String,
            default: "499",
        },
        content: {},
        justify: {
            default: "center",
            validator: (value) =>
                value == "center" || value == "right" || value == "left",
        },
        retainFocus: {
            type: Boolean,
            default: true,
        },
    },
    methods: {
        getAlignClass() {
            if (this.justify == "left") {
                return "align-left";
            } else if (this.justify == "right") {
                return "align-right";
            } else {
                return "align-center";
            }
        },
    },
    computed: {
        getIsModalOpen() {
            return this.modalAberto;
        },
    },
    mounted() {},
};
</script>
<style lang="scss" scoped>
.base-modal {
    background-color: #fff;
    padding: 30px;
    padding-bottom: 30px;
    position: relative;
    &__content,
    &__buttons {
        padding: 20px;
        padding-bottom: 0px;
        color: #00bfa6;
    }
    &__buttons {
        padding-top: 0px;
    }
    &__content {
        display: flex;
        flex-direction: column;
    }
    .btn-close {
        padding: 15px;
        background-color: transparent;
        border: 1px solid #4f4f4f;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
}
</style>
