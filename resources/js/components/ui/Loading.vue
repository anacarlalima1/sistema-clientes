<template>
    <div class="vld-parent">
        <loading :active="dialog"
                 :can-cancel="cancel"
                 :color="color"
                 :is-full-page="fullPage"
                 :loader="loader"
                 :width="width"
        />
    </div>
</template>

<script>
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';

export default {
    name: "Loading2",
    components: {
        Loading
    },

    props: {
        fullPage: {
            default: true
        },

        dialog: {
            default: false
        },

        cancel: {
            default: false
        },

        color: {
            default: 'blue'
        },

        loader: {
            default: 'spinner'
        },

        width: {
            default: 128
        }

    }
}
</script>

<style scoped>
</style>
