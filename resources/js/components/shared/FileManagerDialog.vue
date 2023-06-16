<template>
    <v-dialog v-model="isActive" scrollable width="900" persistent>
        <v-card tile>
            <v-toolbar flat dark color="primary" max-height="64">
                <v-toolbar-title>{{ $t('titles.fm') }}</v-toolbar-title>

                <v-spacer/>

                <v-btn icon :title="$t('buttons.close')" @click="close">
                    <v-icon>fa-solid fa-circle-xmark</v-icon>
                </v-btn>
            </v-toolbar>

            <v-card-text>
                <file-manager v-bind:settings="settings" style="min-height: 550px"></file-manager>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script>
import { mapState } from "vuex";

export default {
    name: "FileManagerDialog",
    props: {
        isActive: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            // https://github.com/alexusmai/vue-laravel-file-manager/tree/v2.5.4
            settings: {
                windowsConfig: 2,
                lang: 'en'
            }
        }
    },
    watch: {
        '$props.isActive': function (value) {
            if (value) {
                this.settings.lang = this.locale;

                this.$store.commit('fm/setFileCallBack', (fileUrl) => {
                    this.$emit('url', fileUrl.slice(fileUrl.indexOf('/media')));
                    this.$emit('update:isActive', false);
                });
            }
        }
    },
    computed: {
        ...mapState({
            locale: state => state.localizationStore.locale
        })
    },
    methods: {
        close() {
            this.$emit('update:isActive', false);
        }
    }
}
</script>

<style lang="scss">

</style>
