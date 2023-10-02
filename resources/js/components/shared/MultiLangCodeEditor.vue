<template>
    <div>
        <v-tabs v-model="tab" height="40">
            <v-tab
                v-for="locale in localizations"
                :key="locale.code"
                @click="selectedLocale = locale.code"
            >{{ locale.name }}</v-tab>
        </v-tabs>

        <div ref="code" class="fill-height" style="height: 200px"></div>
    </div>
</template>

<script>
import { mapState } from "vuex";
import { EditorView, basicSetup } from "codemirror";
import { Compartment } from "@codemirror/state";
import { javascript } from "@codemirror/lang-javascript";

export default {
    name: "MultiLangCodeEditor",
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
            code: null
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

        this.code = this.initEditor('code', this.content[this.selectedLocale]);
    },
    methods: {
        initEditor(ref, code) {
            const languageConf = new Compartment;

            return  new EditorView({
                doc: code,
                extensions: [
                    basicSetup,
                    languageConf.of(javascript()),
                    EditorView.updateListener.of((v) => {
                        if (v.docChanged) {
                            this.content[this.selectedLocale] = this.code.state.doc.toString();

                            this.$emit('update:value', this.content);
                        }
                    })
                ],
                parent: this.$refs[ref]
            });
        }
    }
}
</script>

<style scoped>

</style>
