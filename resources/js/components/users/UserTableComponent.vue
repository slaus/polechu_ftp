<template>
    <v-data-table
        fixed-header
        :items="users"
        :headers="headers"
        :options.sync="options"
        :footer-props="footerProps"
        :server-items-length="totalCount"
        :loading="isLoading"
        :loader-height="1"
        class="elevation-0 bordered-td"
    >
        <template v-slot:top>
            <v-toolbar flat class="rounded-t-lg">
                <v-text-field
                    class="mr-6"
                    hide-details
                    ref="search_users"
                    append-icon="fas fa-search"
                    v-model="search"
                    :placeholder="$t('placeholders.search')"
                    @click:append="applySearch"
                    @keyup="applySearch($event)"
                    clearable
                    @click:clear="clearSearch($event)"
                ></v-text-field>

                <v-btn
                    depressed
                    color="primary"
                    @click="editUser(0)"
                >
                    <v-icon small left>fa-solid fa-plus</v-icon>
                    <span class="no-upper">{{ $t('buttons.add') }}</span>
                </v-btn>
            </v-toolbar>

            <EditUserComponent v-bind.sync="userEdit" v-on:reload="loadUsers" />
        </template>

        <template v-slot:item.actions="{ item }">
            <v-btn icon @click="editUser(item.id)" color="success">
                <v-icon small>fa-solid fa-pen-to-square</v-icon>
            </v-btn>
            <v-btn icon @click="confirmDeleteUser(item.id)" color="error">
                <v-icon small>fa-solid fa-trash-can</v-icon>
            </v-btn>
        </template>
    </v-data-table>
</template>

<script>
import { mapState } from "vuex";
import EditUserComponent from "./EditUserComponent";
import confirm from "../../mixins/confirm";

export default {
    name: "UserTableComponent",
    mixins: [
        confirm
    ],
    components: {
        EditUserComponent
    },
    computed: {
        ...mapState({
            isLoading: state => state.userStore.isLoading,
            users: state => state.userStore.listWithPaginate,
            totalCount: state => state.userStore.totalCount,
            itemsPerPage: state => state.userStore.itemsPerPage,
            currentPage: state => state.userStore.currentPage,
        })
    },
    data() {
        return {
            search: '',
            options: {
                itemsPerPage: 10,
            },
            footerProps: {
                itemsPerPageOptions: [10, 15, 30]
            },
            headers: [
                { text: this.$t('columns.userName'), value: 'name', sortable: false },
                { text: this.$t('columns.userEmail'), value: 'email', width: 150, sortable: false },
                { text: '', value: 'actions', width: 160, sortable: false, align: 'right' }
            ],
            userEdit: {
                isActive: false,
                id: 0
            }
        }
    },
    watch: {
        options: {
            handler() {
                this.loadUsers();
            },
            deep: true
        },
        '$store.state.confirmStore.isConfirmed': function (value) {
            if (value && this.confirmPayload.action && this.confirmPayload.action === 'deleteUser') {
                this.deleteUser();
            }
        }
    },
    methods: {
        loadUsers() {
            this.$store.dispatch('userStore/listWithPaginate', this.options);
        },
        applySearch(event) {
            if ((event.keyCode === 13 || event.type === 'click') && this.search !== '') {
                this.options.search = this.search;
                this.loadUsers();
            } else if (this.search === '') {
                this.options.search = '';
                this.loadUsers();
            }
        },
        clearSearch(event) {
            this.search = '';
            this.applySearch(event);
        },
        editUser(id) {
            this.userEdit.id = id;
            this.userEdit.isActive = true;
        },
        confirmDeleteUser(id) {
            this.setConfirm({
                title: 'confirm.deleteTitle',
                message: 'confirm.deleteMessage',
                payload: { action: 'deleteUser', id: id },
            });
        },
        deleteUser() {
            this.$store.dispatch('userStore/deleteUser', this.confirmPayload?.id ?? 0).finally(() => {
                this.loadUsers();
                this.clearConfirm();
            });
        }
    }
}
</script>

<style scoped>

</style>
