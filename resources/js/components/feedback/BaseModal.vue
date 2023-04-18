<template>
    <v-dialog
        v-if="getIsModalOpen"
        v-model="getIsModalOpen"
        persistent
        :max-width="maxWidth"
        :retain-focus="retainFocus"
    >
        <div class="modal card-aluno-default position-relative">
            <div class="d-flex justify-end">
                <v-btn
                    @click="$emit('close')"
                    class="ms-3"
                    small
                    fab
                    color="#E73232"
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
    emits: ["close"],
    props: {
        aberto: {
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
            return this.aberto;
        },
    },

    mounted() {},
};
</script>
<style lang="scss" scoped></style>
