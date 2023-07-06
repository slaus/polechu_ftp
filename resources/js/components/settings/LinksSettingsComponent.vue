<template>
    <v-card flat>
        <v-card-text class="py-3">
            <v-layout wrap class="my-4">
                <v-flex class="xs12 sm12 mb-6 px-sm-2">
                    <MultiLangTextField
                        :value.sync="settings.links.pay_page"
                        :label="$t('labels.payPageLink')"
                        :readonly="isLoading"
                    />
                </v-flex>
            </v-layout>

            <v-divider />

            <v-card-actions>
                <v-btn
                    color="primary"
                    text
                    @click="saveSettings"
                    :disabled="isLoading"
                    :loading="isLoading"
                >
                    {{ $t('buttons.save') }}
                </v-btn>
            </v-card-actions>
        </v-card-text>
    </v-card>
</template>

<script>
import { mapState } from "vuex";
import MultiLangTextField from "../shared/MultiLangTextField.vue";
import { mergeDeep } from "../../helpers/functions";

export default {
    name: "LinksSettingsComponent",
    components: {MultiLangTextField},
    data() {
        return {
            group: 'subscribe',
            settings: {
                links: {
                    pay_page: null,
                }
            }
        }
    },
    computed: {
        ...mapState({
            isLoading: state => state.settingStore.isLoading
        })
    },
    mounted() {
        this.$store.dispatch('settingStore/list', this.group).then(response => {
            this.settings = mergeDeep(this.settings, this.$store.state.settingStore.list);
        });
    },
    methods: {
        saveSettings() {
            this.$store.dispatch('settingStore/saveSettings', {
                group: this.group,
                settings: this.settings
            });
        }
    }
}
</script>

<style scoped>

</style>
