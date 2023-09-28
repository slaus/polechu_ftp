<template>
    <v-data-table
        fixed-header
        :items="employees"
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
                <SearchInput
                    :value.sync="options.search"
                    :placeholder="$t('placeholders.search')"
                />

                <v-btn
                    depressed
                    color="primary"
                    @click="editEmployee(0)"
                >
                    <v-icon small left>fa-solid fa-plus</v-icon>
                    <span class="no-upper">{{ $t('buttons.add') }}</span>
                </v-btn>
            </v-toolbar>

            <EditEmployeeComponent v-bind.sync="employeeEdit" v-on:reload="loadEmployees" />
        </template>

        <template v-slot:item.name="{ item }">
            {{ translation(item.name) }}
        </template>

        <template v-slot:item.visibility="{ item }">
            <v-icon v-if="item.visibility">fa-solid fa-check</v-icon>
        </template>

        <template v-slot:item.actions="{ item }">
            <v-btn icon @click="editEmployee(item.id)" color="success">
                <v-icon small>fa-solid fa-pen-to-square</v-icon>
            </v-btn>
            <v-btn icon @click="confirmDeleteEmployee(item.id)" color="error">
                <v-icon small>fa-solid fa-trash-can</v-icon>
            </v-btn>
        </template>
    </v-data-table>
</template>

<script>
import { mapState } from "vuex";
import confirm from "../../mixins/confirm";
import localization from "../../mixins/localization";
import SearchInput from "../shared/SearchInput";
import SeoComponent from "../shared/SeoComponent.vue";
import EditEmployeeComponent from "./EditEmployeeComponent.vue";

export default {
    name: "EmployeesTableComponent",
    mixins: [
        confirm,
        localization
    ],
    components: {
        EditEmployeeComponent,
        SearchInput,
        SeoComponent
    },
    computed: {
        ...mapState({
            isLoading: state => state.employeeStore.isLoading,
            employees: state => state.employeeStore.listWithPaginate,
            totalCount: state => state.employeeStore.totalCount,
            itemsPerPage: state => state.employeeStore.itemsPerPage,
            currentPage: state => state.employeeStore.currentPage
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
                { text: this.$t('columns.employeeName'), value: 'name', sortable: true },
                { text: this.$t('columns.order'), value: 'order', width: 100, sortable: true, align: 'center' },
                { text: this.$t('columns.visibility'), value: 'visibility', width: 120, sortable: true, align: 'center' },
                { text: '', value: 'actions', width: 120, sortable: false, align: 'right' }
            ],
            employeeEdit: {
                isActive: false,
                id: 0
            }
        }
    },
    watch: {
        options: {
            handler() {
                this.loadEmployees();
            },
            deep: true
        },
        '$store.state.confirmStore.isConfirmed': function (value) {
            if (value && this.confirmPayload.action && this.confirmPayload.action === 'deleteEmployee') {
                this.deleteEmployee();
            }
        }
    },
    methods: {
        loadEmployees() {
            this.$store.dispatch('employeeStore/listWithPaginate', this.options);
        },
        editEmployee(id) {
            this.employeeEdit.id = id;
            this.employeeEdit.isActive = true;
        },
        confirmDeleteEmployee(id) {
            this.setConfirm({
                title: 'confirm.deleteTitle',
                message: 'confirm.deleteMessage',
                payload: { action: 'deleteEmployee', id: id }
            });
        },
        deleteEmployee() {
            this.$store.dispatch('employeeStore/deleteEmployee', this.confirmPayload?.id ?? 0).finally(() => {
                this.loadEmployees();
                this.clearConfirm();
            });
        }
    }
}
</script>

<style scoped>

</style>
