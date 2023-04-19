<template>
    <base-modal :modal-aberto="aberto" @close-modal="$emit('close-modal')" max-width="900" justify="left">
        <v-form v-model="valid" ref="form">
            <v-row>
                <v-col cols="12" v-for="(input, index) in inputs" :key="'inputModal-' + index">
                    <h4 class="mb-4">
                        <span style="color: red" v-if="input.obrigatorio">*</span>
                        {{ input.label }}
                    </h4>

                    <v-select
                        class="input"
                        v-if="input.tipo == 'select'"
                        :item-text="input.selectText||'nome'"
                        item-value="id"
                        v-model="input.valor"
                        :items="input.itens"
                        filled
                        :placeholder="input.placeholder"
                        :multiple="input.multiplo"
                        solo
                        :rules="[verificarSelectVazio(input),...(input.rules || [])]"
                        :error-messages="input?.erros || []"
                        @change="input?.onChange(input.valor)"
                    ></v-select>
                    <v-autocomplete
                        class="input"
                        v-if="input.tipo == 'autocomplete'"
                        :item-text="input.selectText||'nome'"
                        item-value="id"
                        v-model="input.valor"
                        :items="input.itens"
                        filled
                        :placeholder="input.placeholder"
                        :multiple="input.multiplo"
                        solo
                        :return-object= "false"
                        :rules="[verificarSelectVazio(input),...(input.rules || [])]"
                        :error-messages="input?.erros || []"
                    ></v-autocomplete>
                    <v-text-field
                        v-if="input.tipo == 'textfield'"
                        v-model="input.valor"
                        :placeholder="input.placeholder"
                        solo
                        class="mb-0 input"
                        :rules="[verificarCampoVazio(input) ,...(input.rules || [])]"
                        :error-messages="input?.erros || []"
                        v-mask="input.mask ?? ''"
                    ></v-text-field>
                    <v-text-field
                        v-if="input.tipo == 'password'"
                        v-model="input.valor"
                        :placeholder="input.placeholder"
                        solo
                        class="mb-0 input"
                        :rules="[verificarCampoVazio(input) ,...(input.rules || [])]"
                        :error-messages="input?.erros || []"
                        v-mask="input.mask ?? ''"
                        type="password"
                    ></v-text-field>
                    <v-text-field
                        v-if="input.tipo == 'video'"
                        v-model="input.valor"
                        :placeholder="input.placeholder"
                        solo
                        append-icon="mdi-video"
                        class="mb-0 input"
                        :rules="[verificarCampoVazio(input), ...(input.rules || [])]"
                        :error-messages="input?.erros || []"
                    ></v-text-field>
                    <v-textarea
                        v-if="input.tipo == 'textarea'"
                        class="input"
                        v-model="input.valor"
                        :placeholder="input.placeholder"
                        solo
                        :rules="[verificarCampoVazio(input),...(input.rules || [])]"
                        :error-messages="input?.erros || []"
                    ></v-textarea>
                    <date-picker
                        v-if="input.tipo == 'date'"
                        class="input"
                        @date-changed="input.valor = $event"
                        :valor="input.valor"
                        :placeholder="input.placeholder"
                        :rules="[verificarCampoVazio(input)]"
                        :error-messages="input?.erros || []"
                    />
                    <v-file-input
                        v-if="input.tipo == 'imagem' || input.tipo == 'imagem_pdf'"
                        class="input"
                        :placeholder="input.placeholder"
                        v-model="input.valor"
                        filled
                        append-icon="mdi-camera"
                        :accept="
							input.tipo == 'imagem_pdf'
								? '.jpeg, .jpg, .png, .svg, .tif, .tiff,.pdf'
								: '.jpeg, .jpg, .png, .svg, .tif, .tiff'
						"
                        solo
                        :rules="[verificarCampoVazio(input),...(input.rules || [])]"
                        :error-messages="input?.erros || []"
                    ></v-file-input>
                    <v-file-input
                        v-if="input.tipo == 'audio'"
                        class="input"
                        :placeholder="input.placeholder"
                        v-model="input.valor"
                        filled
                        append-icon="mdi-multimedia"
                        accept=".mp3, .wma, .wav"
                        solo
                        :rules="[verificarCampoVazio(input),...(input.rules || [])]"
                        :error-messages="input?.erros || []"
                    ></v-file-input>
                    <v-file-input
                        v-if="input.tipo == 'file'"
                        class="input"
                        :placeholder="input.placeholder"
                        v-model="input.valor"
                        filled
                        append-icon="mdi-file-document"
                        accept=".pdf"
                        solo
                        :rules="[verificarCampoVazio(input),...(input.rules || [])]"
                        :error-messages="input?.erros || []"
                    ></v-file-input>
                    <editor
                        v-if="input.tipo === 'editor'"
                        ref="myQuillEditor"
                        outlined
                        rounded
                        v-model="input.valor"
                        :label="input.placeholder"
                        :placeholder="input.placeholder"
                        :error-messages="input.erro"
                    />
                    <p class="red--text">{{ input.erro }}</p>
                </v-col>
            </v-row>
        </v-form>
        <v-btn @click="verificarCampos" large width="200px" dark rounded color="#00bfa6">Salvar</v-btn>
    </base-modal>
</template>
<script>
import BaseModal from "../../components/layouts/BaseModal.vue";
import DatePicker from "../../components/ui/DatePicker.vue";
import inputRules from "../../mixins/inputRules";
import alerts from "../../mixins/alerts";
import utils from "../../mixins/utils";
export default {
    name: "ModalInputs",
    components: {
        BaseModal,
        DatePicker,
    },
    props: {
        aberto: {
            type: Boolean,
        },
        inputs: {},
    },
    mixins: [inputRules, alerts, utils],
    emits: ["close-modal", "salvar-registro"],
    data() {
        return {
            inputsData: this.inputs,
            valid: false,
        };
    },
    methods: {
        closeModal() {
            this.$emit("close-modal");
        },
        verificarCampos() {
            if (this.valid) {
                this.$emit("salvar-registro", this.closeModal);
            } else {
                this.alertErro("", "Preencha os campos corretamente!");
                this.limparErrosInputs();
                this.$refs.form.validate();
            }
        },
    },

};
</script>
<style scoped>
.v-input__slot {
    margin-bottom: 0px;
}
.v-text-field__details {
    margin-top: 10px;
}
</style>
