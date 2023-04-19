<template>
    <v-menu v-model="ativo" left>
        <template v-slot:activator="{ on }">
            <v-btn elevation="0" color="white" class="text-none" v-on="on" small fab>
                <v-icon>mdi-dots-vertical</v-icon>
            </v-btn>
        </template>

        <v-list>
            <v-list-item @click="$emit('editar')">
                <v-list-item-content>
                    <v-list-item-title> Editar </v-list-item-title>
                </v-list-item-content>
            </v-list-item>

            <v-list-item @click="$emit('excluir')">
                <v-list-item-content>
                    <v-list-item-title> Excluir </v-list-item-title>
                </v-list-item-content>
            </v-list-item>
            <v-divider />
        </v-list>
    </v-menu>
</template>

<script>
export default {
    name: "MenuAction",
    data() {
        return {
            ativo: false,
        };
    },
};
</script>

<style></style>
