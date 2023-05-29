<template>
    <v-card flat>
        <v-card-title>
            {{ $t('titles.pages') }}
        </v-card-title>
        <v-card-text>
            <PagesTableComponent />
        </v-card-text>
    </v-card>
</template>

<script>
import PagesTableComponent from "../../components/pages/PagesTableComponent";

export default {
    name: "PagesPage",
    components: {
        PagesTableComponent
    },
    data() {
        return {

        }
    }
}
</script>

<style scoped>

</style>
