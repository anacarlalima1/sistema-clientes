<template>
    <v-menu offset-y :close-on-content-click="false">
        <template v-slot:activator="{ on }">
            <v-btn
                v-if="tipo != 'botao'"
                text
                tile
                depressed
                color="var(--main-color)"
                class="ml-4 d-inline-block text-none"
                v-on="on"
            >
                Filtrar
                <v-icon class="ml-1">mdi-chevron-down</v-icon>
            </v-btn>

            <v-btn outlined v-else large rounded color="var(--main-color)" class="ml-4 d-inline-block text-none" v-on="on">
                <v-icon class="ml-1">mdi-filter-outline</v-icon>
                <h4>Filtrar</h4>
            </v-btn>
        </template>
        <v-card class="pa-4" width="450">
            <v-expansion-panels accordion flat multiple>
                <v-expansion-panel v-for="(filtro, i) in filtros" :key="filtro.nome + i">
                    <v-expansion-panel-header class="px-0">
                        {{ filtro?.nome  }}
                    </v-expansion-panel-header>
                    <v-expansion-panel-content class="px-0">
                        <v-expansion-panel v-for="(subfiltro, i) in filtro.subfiltros" :key="subfiltro.nome + i">
                            <v-expansion-panel-header class="px-0">
                                {{ subfiltro.nome || subfiltro.descricao }}
                            </v-expansion-panel-header>
                            <v-expansion-panel-content class="px-0">
                                <v-checkbox
                                    v-for="checkbox in subfiltro.itens"
                                    :key="checkbox.nome"
                                    v-model="checkbox.ativo"
                                    :label="checkbox.nome"
                                    class="mt-0"
                                    color="var(--main-color)"
                                />
                            </v-expansion-panel-content>
                        </v-expansion-panel>

                        <div v-if="!filtro.subfiltros" class="limitar-scroll">
                            <v-checkbox
                                v-for="checkbox in filtro.itens"
                                :key="checkbox.nome"
                                v-model="checkbox.ativo"
                                :label="checkbox.nome||checkbox.descricao"
                                class="mt-0"
                                color="var(--main-color)"
                            />
                        </div>
                    </v-expansion-panel-content>
                </v-expansion-panel>
            </v-expansion-panels>
            <v-btn @click="getFiltrosObject" color="var(--main-color)" class="mt-2" dark>
                Filtrar
                <v-icon right dark>mdi-filter</v-icon>
            </v-btn>
        </v-card>
    </v-menu>
</template>

<script>
export default {
    name: "FiltroComponent",
    props: {
        filtros: {},
        tipo: {
            default: "text",
        },
    },
    data() {
        return {};
    },
    methods: {
        getFiltrosObject() {
            let object = {};

            for (let [chave, valor] of Object.entries(this.filtros)) {
                let valores = valor.itens.filter((item) => item.ativo).map((item) => item.id);

                object[chave] = valores || [];
            }

            this.$emit("filtrar", object);
        },
    },
};
</script>

<style scoped>
.limitar-scroll {
    max-height: 300px;
    overflow: auto;
}
</style>
