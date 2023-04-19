<template>
    <v-menu offset-y v-if="items && items.length > 0">
        <template v-slot:activator="{ attrs, on }">
            <v-btn
                rounded
                small
                color="var(--main-color)"
                class="white--text ma-5 mx-0"
                v-bind="attrs"
                v-on="on"
            >
                {{ titulo }}
            </v-btn>
        </template>

        <v-list>
            <v-list-item v-for="item in items" :key="item.id + 'item'">
                <v-list-item-title v-text="item.descricao"/>
            </v-list-item>
        </v-list>
    </v-menu>
    <div v-else class="text-center">Sem Item</div>
</template>

<script>
export default {
    props: {
        titulo: {
            type: String,
            required: true,
        },
        items: {
            required: true,
        },
    },
};
</script>

<style></style>
