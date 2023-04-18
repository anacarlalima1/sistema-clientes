<template>
    <footer :class="{ 'professor-footer': professorFooter }">
        <!-- <v-row
            class="justify-center position-relative footer-row-header align-center"
        >
            <v-col
                xs="12"
                sm="12"
                md="12"
                lg="2"
                xl="2"
                class="d-flex align-center justify-space-between flex-lg-column pa-0 pb-3 gap-15"
            >
                <img
                    class="logo"
                    src="/assets/images/novo-logo-mais-saber.svg"
                />
                <div class="socials d-flex justify-center">
                    <img src="/icones/instagram.svg" />
                    <img src="/icones/linkedin.svg" />
                    <img src="/icones/facebook.svg" />
                </div>

                <img
                    v-if="!deviceLgAndUp"
                    src="/icones/arrow-top.svg"
                    class="button-navigate-top"
                    @click="navigateTop"
                />
            </v-col>

            <v-col
                v-if="deviceLgAndUp"
                cols="4"
                class="line-vertical pa-0 ms-10 me-10"
            ></v-col>

            <v-col
                v-if="!deviceLgAndUp"
                cols="12"
                class="line-honrizontal pa-0"
            ></v-col>

            <v-col
                xs="12"
                sm="12"
                md="12"
                lg="8"
                xl="8"
                class="d-flex align-end"
            >
                <img src="/icones/lunik.svg" class="pe-5 lunik-logo" />
                <div>
                    <p :class="getFontWeightByWidthDevice">
                        Av. Francisco Matarazzo 1752 - Água Branca São Paulo -
                        SP - CEP 05001-200
                    </p>
                    <p class="mt-3">
                        <span class="font-weight-900">Tel: </span>
                        <span class="font-weight-700">(83) 4141 - 9850</span>
                    </p>
                </div>

                <img
                    v-if="deviceLgAndUp"
                    class="button-navigate-top button-absolute"
                    src="/icones/arrow-top.svg"
                    @click="navigateTop"
                />
            </v-col>
        </v-row> -->
        <v-row class="socials-container">
            <v-col cols="12" class=" ">
                <div class="d-flex flex-column justify-center">
                    <p class="text-center copyright">
                        <span class="copyright-empresa"
                            >@Copyright LUNIK Educacional
                        </span>
                        <span class="font-weight-700"
                            >Todos os direitos reservados.</span
                        >
                    </p>
                    <p class="text-center copyright-empresa">
                        {{ anoAtual }}
                    </p>
                </div>
            </v-col>
        </v-row>
    </footer>
</template>

<script>
export default {
    props: {
        professorFooter: Boolean,
    },
    data() {
        return {
            anoAtual: new Date().getFullYear(),
        };
    },
    name: "Footer",
    methods: {
        navigateTop() {
            window.scrollTo(0, 0);
        },
    },
    computed: {
        deviceLgAndUp() {
            return this.$vuetify.breakpoint.width >= 1264;
        },
        getFontWeightByWidthDevice() {
            if (this.$vuetify.breakpoint.smAndDown) {
                return "font-weight-700";
            } else {
                return "font-weight-900";
            }
        },
    },
};
</script>

<style scoped lang="scss">
footer {
    display: flex;
    flex-direction: column;
    flex: 1;
    justify-content: flex-end;
    padding: 40px 50px 10px 60px;

    .footer-row-header {
        display: flex;
        flex: 20;
        align-items: flex-end;
    }

    &.professor-footer {
        padding: 40px 50px 10px 70px;
    }

    @media (max-width: 550px) {
        &,
        &.professor-footer {
            padding: 200px 20px 60px 20px;
            max-height: 500px;
        }
    }

    p {
        padding: 0px;
        margin: 0px;
    }
    .gap-15 {
        gap: 15px;
    }

    .line-vertical,
    .line-honrizontal {
        border-radius: 8px;
        background-color: rgba(0, 0, 0, 0.1);
    }
    .line-vertical {
        max-width: 3px;
        height: 100%;
    }
    .line-honrizontal {
        height: 3px;
    }
    .lunik-logo {
        max-width: 90px;
        min-width: 70px;
    }
    .logo {
        max-width: 120px;
        min-width: 70px;

        @media (max-width: 1264px) {
            & {
                margin-left: 0px;
            }
        }
        @media (max-width: 550px) {
            & {
                width: 120px;
            }
        }
    }

    .socials {
        margin-top: 10px;
        max-width: 300px;
        gap: 20px;

        > * {
            cursor: pointer;
            width: 35px;
            height: 35px;

            &:hover {
                transition: 0.2s;
                transform: translateY(-5px);
            }
        }

        @media (max-width: 1264px) {
            & {
                margin-top: 0px;
            }
        }
        @media (max-width: 550px) {
            & {
                gap: 10px;
            }
        }

        & img {
            text-align: center;
            @media (max-width: 550px) {
                & {
                    max-width: 40px;
                    max-height: 40px;
                }
            }
        }
    }

    .button-absolute {
        position: absolute;
        right: 0px;
        top: -10px;
    }
    .button-navigate-top {
        cursor: pointer;
        @media (max-width: 550px) {
            & {
                max-width: 35px;
                max-height: 35px;
            }
        }
        @media (max-width: 700px) {
            & {
                position: relative;
                top: -50px;
            }
        }
    }
    .copyright {
        color: rgba(0, 0, 0, 0.5);
        text-align: justify;
    }
    .copyright-empresa {
        color: #808080;
        font-weight: 700;
    }
}
</style>
