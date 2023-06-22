<template>
    <v-card flat>
        <v-card-title>
            {{ $t('titles.countries') }}
        </v-card-title>
        <v-card-text>
            <CountriesTableComponent />
        </v-card-text>
    </v-card>
</template>

<script>
import CountriesTableComponent from "../../components/countries/CountriesTableComponent.vue";

export default {
    name: "CountriesPage",
    components: {
        CountriesTableComponent
    },
    data() {
        return {

        }
    }
}
</script>

<style scoped>

</style>
