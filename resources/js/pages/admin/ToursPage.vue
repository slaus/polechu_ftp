<template>
    <v-card flat>
        <v-card-title>
            {{ $t('titles.tours') }}
        </v-card-title>
        <v-card-text>
            <ToursTableComponent />
        </v-card-text>
    </v-card>
</template>

<script>
import ToursTableComponent from "../../components/tours/ToursTableComponent";

export default {
    name: "ToursPage",
    components: {
        ToursTableComponent
    },
    data() {
        return {

        }
    }
}
</script>

<style scoped>

</style>
