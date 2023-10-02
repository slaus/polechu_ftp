<template>
    <div>
        <v-tabs v-model="tab" height="40">
            <v-tab
                v-for="locale in localizations"
                :key="locale.code"
                @click="selectedLocale = locale.code"
            >{{ locale.name }}</v-tab>
        </v-tabs>

        <div ref="code" class="fill-height" ></div>
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

        setTimeout(() => {
            this.code = this.initEditor('code', this.content[this.selectedLocale]);
        }, 100);
    },
    methods: {
        initEditor(ref, code) {
            const languageConf = new Compartment;

            return new EditorView({
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
