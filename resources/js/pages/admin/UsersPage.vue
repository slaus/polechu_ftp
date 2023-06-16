<template>
    <v-card flat>
        <v-card-title>
            {{ $t('titles.users') }}
        </v-card-title>
        <v-card-text>
            <UserTableComponent />
        </v-card-text>
    </v-card>
</template>

<script>
import UserTableComponent from "../../components/users/UserTableComponent";

export default {
    name: "UsersPage",
    components: {
        UserTableComponent
    },
    data() {
        return {

        }
    }
}
</script>

<style scoped>

</style>
