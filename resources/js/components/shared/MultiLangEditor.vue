<template>
    <div>
        <label class="d-block mb-2 font-weight-bold">{{ label }}</label>

        <v-tabs v-model="tab" height="40">
            <v-tab
                v-for="locale in localizations"
                :key="locale.code"
                @click="selectedLocale = locale.code"
            >{{ locale.name }}</v-tab>
        </v-tabs>

        <vue-editor v-model="content[selectedLocale]" @text-change="input" :editorToolbar="customToolbar"></vue-editor>
    </div>
</template>

<script>
import { VueEditor } from "vue2-editor";
import { mapState } from "vuex";

export default {
    name: "MultiLangEditor",
    components: {
        VueEditor
    },
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
        },
        height: {
            type: String,
            default: '500px'
        }
    },
    data() {
        return {
            tab: null,
            selectedLocale: '',
            customToolbar: [
                [{ header: [false, 1, 2, 3, 4, 5, 6] }],
                ["bold", "italic", "underline", "strike"], // toggled buttons
                [
                    { align: "" },
                    { align: "center" },
                    { align: "right" },
                    { align: "justify" }
                ],
                ["blockquote", "code-block"],
                [{ list: "ordered" }, { list: "bullet" }, { list: "check" }],
                [{ indent: "-1" }, { indent: "+1" }], // outdent/indent
                [{ color: [] }, { background: [] }], // dropdown with defaults from theme
                ["link", "video"],
                ["clean"] // remove formatting button
            ]
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
