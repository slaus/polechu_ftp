<template>
    <v-dialog v-model="isActive" width="900" scrollable persistent :retain-focus="false">
        <v-card tile>
            <v-toolbar flat dark color="primary" max-height="64">
                <v-toolbar-title>{{ $t(title, { employee: translation(employee.name) }) }}</v-toolbar-title>

                <v-spacer/>

                <v-btn icon :title="$t('buttons.close')" @click="close">
                    <v-icon>fa-solid fa-circle-xmark</v-icon>
                </v-btn>
            </v-toolbar>

            <v-progress-linear
                v-if="isLoading"
                indeterminate
                color="primary"
            ></v-progress-linear>

            <v-card-text class="pa-3">
                <v-layout wrap class="mt-4">
                    <v-flex class="xs12 sm5 px-0 px-sm-2 pb-10">
                        <ImageThumb
                            :value.sync="employee.image"
                            :label="$t('labels.photo')"
                            :disabled="isLoading"
                            :error-messages="messageFieldError('image')"
                            class="mx-auto"
                        />
                    </v-flex>

                    <v-flex class="xs12 sm7 px-0 px-sm-2 pb-10 pt-8">
                        <MultiLangTextField
                            :value.sync="employee.name"
                            :label="$t('labels.employeeName')"
                            :readonly="isLoading"
                            class="mb-4"
                            :error-messages="messageFieldError('name')"
                        />

                        <MultiLangTextField
                            :value.sync="employee.position"
                            :label="$t('labels.employeePosition')"
                            :readonly="isLoading"
                            :error-messages="messageFieldError('position')"
                        />
                    </v-flex>

                    <v-flex class="xs12 sm12 mt-3 mb-6 px-sm-2">
                        <label class="d-block font-weight-bold mb-4">{{ $t('labels.contacts') }}</label>

                        <div v-for="(item, i) in contacts" :key="i" class="d-flex flex-wrap mb-4">
                            <div class="name" style="max-width: 240px">
                                <MultiLangTextField
                                    :value.sync="item.name"
                                    :label="$t('labels.name')"
                                    :readonly="isLoading"
                                />
                            </div>
                            <div class="mx-1"></div>
                            <div class="flex-grow-2" style="max-width: 140px">
                                <v-select
                                    :items="types"
                                    outlined
                                    dense
                                    v-model="item.type"
                                    :readonly="isLoading"
                                    :label="$t('labels.type')"
                                    hide-details="auto"
                                ></v-select>
                            </div>
                            <div class="mx-1"></div>
                            <div class="value flex-grow-1">
                                <v-text-field
                                    outlined
                                    dense
                                    v-model="item.value"
                                    :readonly="isLoading"
                                    :label="$t('labels.value')"
                                    hide-details="auto"
                                ></v-text-field>
                            </div>
                            <div class="px-2">
                                <v-btn icon @click="removeContact(item)" color="error">
                                    <v-icon small>fa-solid fa-trash-can</v-icon>
                                </v-btn>
                            </div>
                        </div>

                        <v-btn
                            color="primary"
                            @click="addContact"
                            small
                        >
                            {{ $t('buttons.addContact')}}
                        </v-btn>
                    </v-flex>

                    <v-flex class="xs12 sm12 px-0 px-sm-2 mb-6 align-self-center">
                        <MultiLangTextarea
                            :value.sync="employee.description"
                            :placeholder="$t('labels.description')"
                            :error-messages="messageFieldError('description')"
                            rows="3"
                            :no-resize="true"
                        />
                    </v-flex>

                    <v-flex class="xs12 sm2 px-0 px-sm-2">
                        <v-text-field
                            v-model="employee.order"
                            :label="$t('labels.order')"
                            dense
                            outlined
                            :readonly="isLoading"
                            :error-messages="messageFieldError('order')"
                            type="number"
                            min="0"
                            step="1"
                        ></v-text-field>
                    </v-flex>

                    <v-flex class="xs12 sm8 px-0 px-sm-2">
                        <v-switch
                            v-model="employee.visibility"
                            inset
                            :readonly="isLoading"
                            :label="$t('labels.visibility')"
                            :error-messages="messageFieldError('visibility')"
                            class="mt-1 mx-2"
                        ></v-switch>
                    </v-flex>
                </v-layout>
            </v-card-text>

            <v-divider />

            <v-card-actions>
                <v-btn
                    color="primary"
                    text
                    @click="savePost"
                    :disabled="isLoading"
                    :loading="isLoading"
                >
                    {{ $t('buttons.save') }}
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import { mapState } from "vuex";
import validation from "../../mixins/validation";
import localization from "../../mixins/localization";
import MultiLangTextField from "../shared/MultiLangTextField";
import ImageThumb from "../shared/ImageThumb.vue";
import MultiLangTextarea from "../shared/MultiLangTextarea.vue";

export default {
    name: "EditEmployeeComponent",
    mixins: [
        validation,
        localization
    ],
    components: {
        MultiLangTextarea,
        MultiLangTextField,
        ImageThumb
    },
    props: {
        isActive: {
            type: Boolean,
            default: false
        },
        id: {
            type: Number,
            default: 0
        }
    },
    data() {
        return {
            noEditSlug: true,
            contacts: [],
            types: [
                { value: 'facebook', text: this.$t('labels.facebook') },
                { value: 'instagram', text: this.$t('labels.instagram') },
                { value: 'phone', text: this.$t('labels.phone') },
                { value: 'email', text: this.$t('labels.email') },
                { value: 'telegram', text: this.$t('labels.telegram') },
                { value: 'viber', text: this.$t('labels.viber') },
            ],
        }
    },
    computed: {
        ...mapState({
            isLoading: state => state.employeeStore.isLoading,
            employee: state => state.employeeStore.employee
        }),
        title() {
            return this.id > 0 ? 'titles.editEmployee' : 'titles.newEmployee';
        }
    },
    watch: {
        '$props.isActive': function (value) {
            if (value) {
                if (this.id > 0) {
                    this.loadEmployeeData();
                }
            } else {
                this.contacts = [];
                this.$store.commit('employeeStore/resetEmployee');
            }
        }
    },
    methods: {
        loadEmployeeData() {
            this.$store.dispatch('employeeStore/loadEmployee', this.id).then(() => {
                this.contacts = this.employee.details?.contacts ?? [];
            });
        },
        savePost() {
            if (!this.employee.details) {
                this.employee.details = {};
            }

            this.employee.details.contacts = this.contacts;

            if (this.id > 0) {
                this.$store.dispatch('employeeStore/updateEmployee', this.employee).then(response => {
                    this.successSaveAction();
                });
            } else  {
                this.$store.dispatch('employeeStore/saveEmployee', this.employee).then(response => {
                    this.successSaveAction();
                });
            }
        },
        addContact() {
            this.contacts.push({
                name: null,
                icon: '',
                value: ''
            });
        },
        removeContact(contact) {
            this.contacts = this.contacts.filter(item => item !== contact);
        },
        successSaveAction() {
            this.$emit('reload');
            this.close();
        },
        close() {
            this.cleanErrors();
            this.$emit('update:isActive', false);
        }
    }
}
</script>

<style scoped>

</style>
