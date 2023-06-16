<template>
    <v-card flat>
        <v-card-title>
            {{ $t('titles.settings') }}
        </v-card-title>
        <v-card-text>
            <v-tabs v-model="tab" class="px-3">
                <v-tab>{{ $t('tabs.main') }}</v-tab>
                <v-tab>{{ $t('tabs.notifications') }}</v-tab>
                <v-tab>{{ $t('tabs.subscribe') }}</v-tab>
                <v-tab>{{ $t('tabs.services') }}</v-tab>
            </v-tabs>

            <v-tabs-items v-model="tab">
                <v-tab-item>
                    <MainSettingsComponent />
                </v-tab-item>
                <v-tab-item>
                    <NotificationsSettingsComponent />
                </v-tab-item>
                <v-tab-item>
                    <SubscribeFormSettingsComponent />
                </v-tab-item>
                <v-tab-item>
                    <ServicesSettingsComponent />
                </v-tab-item>
            </v-tabs-items>
        </v-card-text>
    </v-card>
</template>

<script>
import MainSettingsComponent from "../../components/settings/MainSettingsComponent";
import NotificationsSettingsComponent from "../../components/settings/NotificationsSettingsComponent.vue";
import SubscribeFormSettingsComponent from "../../components/settings/SubscribeFormSettingsComponent.vue";
import ServicesSettingsComponent from "../../components/settings/ServicesSettingsComponent.vue";

export default {
    name: "SettingsPage",
    components: {
        MainSettingsComponent,
        NotificationsSettingsComponent,
        SubscribeFormSettingsComponent,
        ServicesSettingsComponent
    },
    data() {
        return {
            tab: null,
        }
    }
}
</script>

<style scoped>

</style>
