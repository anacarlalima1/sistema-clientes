<template>
    <v-menu
        v-model="menu"
        :close-on-content-click="false"
        :nudge-right="40"
        transition="scale-transition"
        offset-y
        min-width="auto"
    >
        <template v-slot:activator="{ on, attrs }">
            <v-text-field
                placeholder="Selecione a data"
                :value="date"
                prepend-icon="mdi-calendar"
                readonly
                v-bind="attrs"
                v-on="on"
                :rules="rules"
            />
        </template>

        <date-picker
            class="w-full"
            mode="date"
            timezone
            v-model="date"
            :model-config="dataMask"
            outlined
            locale="pt-br"
            color="var(--main-color)"
            is24hr
        />

        <!-- <v-date-picker locale="pt-BR" no-title v-model="date" @input="menu = false"></v-date-picker> -->
    </v-menu>
</template>

<script>
import moment from "moment";
import DatePicker from "v-calendar/lib/components/date-picker.umd";
export default {
    props: {
        label: {type: String},
        rules: {type: Array},
        valor: {default: null},
    },
    components: {DatePicker},
    data() {
        return {
            menu: false,
            date: null,
            dateText: "",
            dataMask: {
                type: "string",
                mask: "YYYY/MM/DD", // Uses 'iso' if missing
            },
        };
    },
    methods: {},
    computed: {
        computedDateFormattedDate() {
            return this.date ? moment(this.date).format("YYYY/MM/DD") : "";
        },
    },
    created() {
        if (this.valor){
            this.date = this.valor;
        }
    },
    watch: {
        valor() {
            this.date = this.valor;
        },
        date(value) {
            this.$emit("date-changed", value);
        },
    },
};
</script>

<style></style>
