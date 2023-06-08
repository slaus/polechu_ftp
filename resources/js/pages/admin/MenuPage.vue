<template>
    <v-card flat>
        <v-card-title>
            {{ $t('titles.menu') }}
        </v-card-title>
        <v-card-text>
            <MenuComponent />
        </v-card-text>
    </v-card>
</template>

<script>
import MenuComponent from "../../components/menu/MenuComponent";

export default {
    name: "MenuPage",
    components: {
        MenuComponent
    },
    data() {
        return {

        }
    }
}
</script>

<style scoped>

</style>
