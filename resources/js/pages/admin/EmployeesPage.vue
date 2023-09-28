<template>
    <v-card flat>
        <v-card-title>
            {{ $t('titles.employees') }}
        </v-card-title>
        <v-card-text>
            <EmployeesTableComponent />
        </v-card-text>
    </v-card>
</template>

<script>
import EmployeesTableComponent from "../../components/employees/EmployeesTableComponent.vue";

export default {
    name: "EmployeesPage",
    components: {
        EmployeesTableComponent
    },
    data() {
        return {

        }
    }
}
</script>

<style scoped>

</style>
