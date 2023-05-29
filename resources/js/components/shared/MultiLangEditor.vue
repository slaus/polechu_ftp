<template>
    <div>
        <label class="d-block mb-2 font-weight-bold">{{ label }}</label>

        <v-tabs v-model="tab">
            <v-tab
                v-for="locale in localizations"
                :key="locale.code"
                @click="selectedLocale = locale.code"
            >{{ locale.name }}</v-tab>
        </v-tabs>

        <Editor
            :init="editorOpt"
            v-model="content[selectedLocale]"
            :api-key="tinyApiKey"
            @input="input"
        ></Editor>
    </div>
</template>

<script>
import Editor from "@tinymce/tinymce-vue";
import { mapState } from "vuex";

export default {
    name: "MultiLangEditor",
    components: {
        Editor
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
            tinyApiKey: 'uqrwnf5eemmc8gq2ytkajtgss8qdhfng7zzwjmo6hv1k3uzh',
            editorOpt: {
                height: this.height,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount', 'directionality'
                ],
                toolbar: 'undo redo | blocks | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ltr rtl | ' +
                    'removeformat | help'
            }
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
