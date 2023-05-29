<template>
    <v-dialog v-model="isActive" width="450" scrollable persistent>
        <v-card>
            <v-toolbar flat dark color="primary">
                <v-toolbar-title>{{ $t(title, { user: user.name }) }}</v-toolbar-title>

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
                    <v-flex class="xs12 sm12 px-0 px-sm-2">
                        <v-text-field
                            outlined
                            dense
                            v-model="user.name"
                            :readonly="isLoading"
                            :label="$t('labels.userName')"
                            :error-messages="messageFieldError('name')"
                        ></v-text-field>
                    </v-flex>

                    <v-flex class="xs12 sm12 px-0 px-sm-2">
                        <v-text-field
                            outlined
                            dense
                            v-model="user.email"
                            :readonly="isLoading"
                            :label="$t('labels.userEmail')"
                            :error-messages="messageFieldError('email')"
                        ></v-text-field>
                    </v-flex>

                    <v-flex v-if="id > 0" class="xs12 sm12 px-0 px-sm-2">
                        <v-checkbox
                            v-model="withChangePassword"
                            outlined
                            dense
                            :label="$t('labels.changePassword')"
                        ></v-checkbox>
                    </v-flex>

                    <template v-if="id === 0 || withChangePassword">
                        <v-flex class="xs12 sm6 px-0 px-sm-2">
                            <v-text-field
                                outlined
                                dense
                                v-model="password"
                                :readonly="isLoading"
                                :append-icon="isHidden ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'"
                                :type="isHidden ? 'password' : 'text'"
                                @click:append="isHidden = !isHidden"
                                :label="$t('labels.password')"
                                :error-messages="messageFieldError('password')"
                            ></v-text-field>
                        </v-flex>

                        <v-flex class="xs12 sm6 px-0 px-sm-2">
                            <v-text-field
                                outlined
                                dense
                                v-model="passwordConfirmation"
                                :readonly="isLoading"
                                :append-icon="isHidden ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'"
                                :type="isHidden ? 'password' : 'text'"
                                @click:append="isHidden = !isHidden"
                                :label="$t('labels.passwordConfirm')"
                            ></v-text-field>
                        </v-flex>
                    </template>
                </v-layout>
            </v-card-text>

            <v-divider />

            <v-card-actions>
                <v-btn
                    color="primary"
                    text
                    @click="saveUser"
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

export default {
    name: "EditUserComponent",
    mixins: [
        validation
    ],
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
            isHidden: true,
            password: '',
            passwordConfirmation: '',
            withChangePassword: false
        }
    },
    computed: {
        ...mapState({
            isLoading: state => state.userStore.isLoading,
            user: state => state.userStore.user
        }),
        title() {
            return this.id > 0 ? 'titles.editUser' : 'titles.newUser';
        }
    },
    watch: {
        '$props.isActive': function (value) {
            if (value) {
                if (this.id > 0) {
                    this.loadUserData();
                } else {
                    this.$store.commit('userStore/resetUser');
                }
            }

            this.isHidden = true;
            this.password = '';
            this.passwordConfirmation = '';
            this.withChangePassword = false;
        }
    },
    methods: {
        loadUserData() {
            this.$store.dispatch('userStore/loadUser', this.id);
        },
        saveUser() {
            if (this.id === 0 || this.withChangePassword) {
                this.user.password = this.password;
                this.user.password_confirmation = this.passwordConfirmation;
            }

            if (this.id > 0) {
                this.$store.dispatch('userStore/updateUser', this.user).then(response => {
                    this.successSaveAction();
                });
            } else  {
                this.$store.dispatch('userStore/saveUser', this.user).then(response => {
                    this.successSaveAction();
                });
            }
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
