<template>
    <div class="d-flex multi-lang">
        <div class="input-field">
            <v-text-field
                dense
                outlined
                :label="label"
                v-model="content[selectedLocale]"
                @input="input"
                :error-messages="errorMessages"
                hide-details="auto"
                :readonly="readonly"
                :disabled="disabled"
            ></v-text-field>
        </div>
        <div class="select-locale">
            <v-select
                :items="localizations"
                item-value="code"
                item-text="name"
                dense
                outlined
                menu-props="offsetY"
                hide-details="auto"
                v-model="selectedLocale"
            ></v-select>
        </div>
    </div>
</template>

<script>
import { mapState } from "vuex";

export default {
    name: "MultiLangTextField",
    props: {
        value: {
            type: Object,
            default: {}
        },
        label: {
            type: String,
            default: ''
        },
        errorMessages: {
            type: String,
            default: ''
        },
        readonly: {
            type: Boolean,
            default: false
        },
        disabled: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            selectedLocale: ''
        }
    },
    computed: {
        ...mapState({
            locale: state => state.localizationStore.locale,
            localizations: state => state.localizationStore.localizations,
        }),
        content() {
            const content = {};

            for (const key in this.localizations) {
                const locale = this.localizations[key].code;

                content[locale] = '';

                if (this.value && this.value[locale]) {
                    content[locale] = this.value[locale];
                }
            }

            return content;
        }
    },
    mounted() {
        this.selectedLocale = this.locale;
    },
    methods: {
        input() {
            this.$emit('update:value', this.content);
        }
    }
}
</script>

<style scoped lang="scss">
.input-field {
    width: 100%;
}
.select-locale {
    width: 80px;
}
</style>
