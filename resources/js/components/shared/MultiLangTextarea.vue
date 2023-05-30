<template>
    <div>
        <v-tabs v-model="tab" height="40">
            <v-tab
                v-for="locale in localizations"
                :key="locale.code"
                @click="selectedLocale = locale.code"
            >{{ locale.name }}</v-tab>
        </v-tabs>

        <v-textarea
            v-model="content[selectedLocale]"
            outlined
            dense
            :label="label"
            :placeholder="placeholder"
            :error-messages="errorMessages"
            hide-details="auto"
            :readonly="readonly"
            :disabled="disabled"
            @input="input"
            :rows="rows"
            :no-resize="noResize"
        ></v-textarea>
    </div>
</template>

<script>
import { mapState } from "vuex";

export default {
    name: "MultiLangTextarea",
    props: {
        value: {
            type: Object,
            default: {}
        },
        label: {
            type: String,
            default: ''
        },
        placeholder: {
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
        },
        rows: {
            type: String,
            default: '5'
        },
        noResize: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            tab: null,
            selectedLocale: '',
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

<style scoped>

</style>
