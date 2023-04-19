<template>
    <header>
        <h2>{{ titulo }}</h2>
    </header>
</template>

<script>
export default {
    props: {
        titulo: {
            type: String,
            default: "Seja Bem Vindo !",
        },
    },
};
</script>

<style lang="scss" scoped>
@import "@sass/_variables.scss";
header {
    display: flex;
    align-items: center;
    padding: 0px 60px;
    height: 90px;
    background-color: $primary60 !important;
    color: white;
}
</style>
