<template>
    <v-list>
        <v-list-item-group
            v-model="selectedItem"
            dark
        >
            <template v-for="item in menus">
                <v-list-item color="white" :disabled="isActive(item.route)" @click="goToRouteName(item.route)">
                    <v-list-item-icon class="mr-2">
                        <v-icon small>{{ item.icon }}</v-icon>
                    </v-list-item-icon>

                    <v-list-item-title>{{ $t(item.text) }}</v-list-item-title>
                </v-list-item>
            </template>
        </v-list-item-group>
    </v-list>
</template>

<script>
export default {
    name: "LeftSideMenu",
    data() {
        return {
            selectedItem: 0,
            menus: [
                { id: 1, text: 'menu.dashboard', route: 'admin.dashboard', icon: 'fa-solid fa-gauge' },
                { id: 2, text: 'menu.menu', route: 'admin.menu', icon: 'fa-regular fa-bars' },
                { id: 3, text: 'menu.pages', route: 'admin.pages', icon: 'fa-regular fa-sidebar' },
                { id: 4, text: 'menu.employees', route: 'admin.employees', icon: 'fas fa-user-friends' },
                { id: 5, text: 'menu.tours', route: 'admin.tours', icon: 'fa-regular fa-tree-palm' },
                { id: 6, text: 'menu.posts', route: 'admin.posts', icon: 'fa-regular fa-newspaper' },
                { id: 7, text: 'menu.countries', route: 'admin.countries', icon: 'fa-solid fa-globe' },
                { id: 8, text: 'menu.orders', route: 'admin.orders', icon: 'fa-solid fa-bags-shopping' },
                { id: 9, text: 'menu.fm', route: 'admin.fm', icon: 'fa-sharp fa-regular fa-photo-film' },
                { id: 10, text: 'menu.settings', route: 'admin.settings', icon: 'fa-solid fa-screwdriver-wrench' }
                // { id: 7, text: 'menu.users', route: 'admin.users', icon: 'fa-solid fa-users' },
            ]
        }
    },
    methods: {
        goToRouteName(name) {
            if (name === 'admin.dashboard') {
                this.$router.push({ path: '/admin'} );
            } else {
                this.$router.push({ name: name});
            }
        },
        goToTranslationsPage() {
            window.open('/translations', '_blank').focus();
        },
        isActive(name) {
            return name === this.$route.name;
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
