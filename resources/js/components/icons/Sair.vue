<template>
    <svg
        :width="width"
        :height="height"
        viewBox="0 0 23 24"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
    >
        <path
            d="M5.66875 17.0714L1 12.25M1 12.25L5.66875 7.42857M1 12.25H15.4643M5.82143 1L18.6786 1.00321C20.4529 1.00482 21.8929 2.44321 21.8929 4.2175V20.2809C21.8929 21.1334 21.5542 21.9509 20.9514 22.5537C20.3486 23.1565 19.5311 23.4952 18.6786 23.4952L5.82143 23.5"
            :stroke="color"
            stroke-linecap="round"
            stroke-linejoin="round"
        />
    </svg>
</template>
<script>
export default {
    name: "sair-icon",
    props: {
        width: {
            default: 24,
        },
        height: {
            default: 24,
        },
        color: {
            default: "#167A83",
        },
    },
};
</script>
