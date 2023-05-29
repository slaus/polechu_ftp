<template>
    <v-app class="app">
        <v-navigation-drawer color="sidebar" app v-model="drawer">
            <div class="px-10 py-4">
                <a href="/" target="_blank"><v-img src="/images/logo.png" width="80" class="mx-auto" /></a>
            </div>

            <LeftSideMenu />
        </v-navigation-drawer>

        <v-app-bar app>
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

            <v-spacer></v-spacer>

            <v-menu offset-y>
                <template v-slot:activator="{ attrs, on }">
                    <div v-bind="attrs" v-on="on">
                        <v-list-item class="px-0 mx-3 profile-item">
                            <v-list-item-content>
                                <v-list-item-title>{{ authUser.name }}</v-list-item-title>
                                <v-list-item-subtitle>{{ authUser.email }}</v-list-item-subtitle>
                            </v-list-item-content>

                            <v-list-item-action>
                                <v-icon small>fa-solid fa-chevron-down</v-icon>
                            </v-list-item-action>
                        </v-list-item>
                    </div>
                </template>

                <v-list>
                    <v-list-item link @click="exit">
                        <v-list-item-icon class="pl-3 mr-7">
                            <v-icon>fa-solid fa-right-from-bracket</v-icon>
                        </v-list-item-icon>

                        <v-list-item-title>{{ $t('buttons.logout') }}</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>
        </v-app-bar>

        <v-main>
            <v-container fluid>
                <router-view></router-view>
            </v-container>
        </v-main>

        <AlertDialog />
        <ConfirmDialog />
    </v-app>
</template>

<script>
import { mapState } from "vuex";
import AlertDialog from "../components/shared/AlertDialog";
import ConfirmDialog from "../components/shared/ConfirmDialog";
import LeftSideMenu from "../components/shared/LeftSideMenu";

export default {
    name: "AdminLayout",
    mixins: [],
    components: {
        AlertDialog,
        ConfirmDialog,
        LeftSideMenu
    },
    data() {
        return {
            drawer: true
        }
    },
    computed: {
        ...mapState({
            authUser: state => state.authStore
        })
    },
    mounted() {
        this.$store.dispatch('authStore/user');
        this.$store.commit('localizationStore/setLocale', this.authUser.locale);
    },
    methods: {
        exit() {
            this.$store.commit('authStore/cleanUser');
            location.href = '/logout';
        }
    }
}
</script>

<style scoped lang="scss">

</style>
