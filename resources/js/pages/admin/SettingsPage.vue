<template>
    <v-card flat>
        <v-card-title>
            {{ $t('titles.settings') }}
        </v-card-title>
        <v-card-text>
            <v-tabs v-model="tab" class="px-3">
                <v-tab>{{ $t('tabs.main') }}</v-tab>
            </v-tabs>

            <v-tabs-items v-model="tab">
                <v-tab-item>
                    <MainSettingsComponent />
                </v-tab-item>
            </v-tabs-items>
        </v-card-text>
    </v-card>
</template>

<script>
import MainSettingsComponent from "../../components/settings/MainSettingsComponent";

export default {
    name: "SettingsPage",
    components: {
        MainSettingsComponent
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
