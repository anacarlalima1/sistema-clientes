<template>
    <button
        dark
        class="button"
        :class="getStyle()"
        @click="!disabled ? $emit('click') : ''"
        :style="{ backgroundColor: background || '', color: color || '' }"
    >
        <slot></slot>
    </button>
</template>

<script>
export default {
    props: {
        disabled: {},
        small: {},
        large: {},
        gradient: {},
        outlined: {},
        full: {},
        color: {},
        background: {},
    },

    methods: {
        getStyle() {
            let stringClass = "";

            if (this.gradient !== undefined && this.outlined === undefined) {
                stringClass += "button--gradient ";
            }

            if (
                this.gradient === undefined &&
                this.outlined === undefined &&
                this.background === undefined
            ) {
                stringClass += "button--background ";
            }
            if (this.outlined !== undefined) {
                stringClass += "button--outlined ";
            }
            if (this.full != undefined) {
                stringClass += "button--full ";
            }
            if (this.large != undefined) {
                stringClass += "button--large ";
            }
            if (this.disabled != undefined) {
                stringClass += "button--disabled";
            }
            return stringClass;
        },
    },
    computed: {
        isLarge() {
            return this.small == undefined && this.large != undefined;
        },
    },
};
</script>

<style scoped lang="scss">
@import "@sass/_variables.scss";

.button {
    font-weight: bold;

    color: white;

    text-transform: none;

    border-radius: 10px;

    color: white;

    padding: 5px 25px;

    &--background {
        background-color: $primary60 !important;
    }

    &--outlined {
        border-width: 1px;
        border-style: solid;
        border-color: $primary60 !important;
        background-color: none !important;
        color: $primary60;
    }
    &--disabled {
        pointer-events: none;
    }
    &--large {
        padding: 10px 20px;
    }

    &--full {
        width: 100%;
    }
}
</style>
