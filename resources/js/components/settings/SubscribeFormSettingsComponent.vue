<template>
    <v-card flat>
        <v-card-text class="py-3">
            <v-layout wrap class="my-4">
                <v-flex class="xs12 sm12 mb-6 px-sm-2">
                    <MultiLangTextField
                        :value.sync="settings.subscribe.title"
                        :label="$t('labels.title')"
                        :readonly="isLoading"
                    />
                </v-flex>
                <v-flex class="xs12 sm12 mb-6 px-sm-2">
                    <MultiLangEditor
                        :value.sync="settings.subscribe.description"
                        :label="$t('labels.description')"
                        :readonly="isLoading"
                    />
                </v-flex>
                <v-flex class="xs12 sm6 mb-6 px-sm-2">
                    <MultiLangTextField
                        :value.sync="settings.subscribe.email_placeholder"
                        :label="$t('labels.emailPlaceholder')"
                        :readonly="isLoading"
                    />
                </v-flex>
                <v-flex class="xs12 sm6 mb-6 px-sm-2">
                    <MultiLangTextField
                        :value.sync="settings.subscribe.button_text"
                        :label="$t('labels.buttonText')"
                        :readonly="isLoading"
                    />
                </v-flex>
                <v-flex class="xs12 sm12 mb-6 px-sm-2">
                    <MultiLangTextField
                        :value.sync="settings.subscribe.success_send_message"
                        :label="$t('labels.successSubscribeSendMessage')"
                        :readonly="isLoading"
                    />
                </v-flex>
                <v-flex class="xs12 sm12 mb-6 px-sm-2">
                    <MultiLangTextField
                        :value.sync="settings.subscribe.fail_send_message"
                        :label="$t('labels.failSubscribeSendMessage')"
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
import MultiLangEditor from "../shared/MultiLangEditor.vue";

export default {
    name: "SubscribeFormSettingsComponent",
    components: { MultiLangTextField, MultiLangEditor },
    data() {
        return {
            group: 'subscribe',
            settings: {
                subscribe: {
                    title: null,
                    description: null,
                    email_placeholder: null,
                    button_text: null,
                    success_send_message: null,
                    fail_send_message: null
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
