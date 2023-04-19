<template>
    <v-list-group :value="false">
        <template v-slot:activator>
            <v-list-item-icon class="d-flex align-center justify-center mx-0">
                <v-img max-width="30" max-height="30" :src="menu.icon" />
                <component :is="menu.icon" :color="rotaAtiva(menu.rota) ? '#fff' : '#949494'"/>
            </v-list-item-icon>

            <v-list-item-title class="ms-5" :style="{ whiteSpace: 'normal' }">
                {{ menu.titulo }}
            </v-list-item-title>
        </template>

        <div class="ps-5 py-1">
            <list-item
                @modalAppAgenda="$emit('modalAppAgenda')"
                :item="submenu"
                v-for="(submenu, i) in menu.itens"
                :key="'menu-professor-' + i"
            />
        </div>
    </v-list-group>
</template>

<script>
import ListItem from "./ListItem.vue";
export default {
    name: "ListGroupItem",
    props: {
        menu: { type: Object },
    },
    components: {
        ListItem,
    },
    methods: {
        rotaAtiva(rota) {
            return this.$route.fullPath.indexOf(rota) !== -1;
        },

    }
};
</script>

<style>

</style>
