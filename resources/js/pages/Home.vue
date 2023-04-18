<template>
    <div>
        <base-button>Teste</base-button>
        <base-modal :aberto="true"></base-modal>
    </div>
</template>

<script>
import BaseButton from "@/components/ui/BaseButton.vue";
import BaseModal from "@/components/feedback/BaseModal.vue";
export default {
    components: { BaseButton, BaseModal },
};
</script>

<style></style>
