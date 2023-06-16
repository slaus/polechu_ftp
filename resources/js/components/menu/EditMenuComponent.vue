<template>
    <v-dialog v-model="isActive" width="600" scrollable persistent :retain-focus="false">
        <v-card tile>
            <v-toolbar flat dark color="primary" max-height="64">
                <v-toolbar-title>{{ $t(title, { menu: translation(menu.name) }) }}</v-toolbar-title>

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
                    <v-flex class="xs12 sm8 px-0 px-sm-2">
                        <MultiLangTextField
                            :value.sync="menu.name"
                            :label="$t('labels.menuName')"
                            :readonly="isLoading"
                            :error-messages="messageFieldError('name')"
                        />
                    </v-flex>

                    <v-flex class="xs12 sm4 px-0 px-sm-2">
                        <v-switch
                            v-model="menu.visibility"
                            inset
                            :readonly="isLoading"
                            :label="$t('labels.visibility')"
                            :error-messages="messageFieldError('visibility')"
                            class="mt-0"
                        ></v-switch>
                    </v-flex>

                    <v-flex class="xs12 sm12 px-0 px-sm-2">
                        <v-combobox
                            :items="pages"
                            v-model="targetSelected"
                            outlined
                            dense
                            :loading="isLoading"
                            :readonly="isLoading"
                            @input="selectTarget"
                            @focus.out="selectTarget"
                            hide-details
                        >
                            <template v-slot:item="{ parent, item, on }">
                                {{ translation(item.name) }}
                            </template>

                            <template v-slot:selection="{ item }">
                                {{ translation(item.name) }}
                            </template>
                        </v-combobox>
                    </v-flex>
                </v-layout>
            </v-card-text>

            <v-divider />

            <v-card-actions>
                <v-btn
                    color="primary"
                    text
                    @click="saveMenu"
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

export default {
    name: "EditMenuComponent",
    mixins: [
        validation,
        localization
    ],
    components: {
        MultiLangTextField
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
            targetSelected: null
        }
    },
    computed: {
        ...mapState({
            isLoading: state => state.menuStore.isLoading,
            menu: state => state.menuStore.menu,
            pages: state => state.pageStore.list
        }),
        title() {
            return this.id > 0 ? 'titles.editMenu' : 'titles.newMenu';
        }
    },
    watch: {
        '$props.isActive': function (value) {
            if (value) {
                if (this.id > 0) {
                    this.loadMenuData();
                }

                this.loadPages();
            } else {
                this.$store.commit('menuStore/resetMenu');
            }
        }
    },
    methods: {
        loadMenuData() {
            this.$store.dispatch('menuStore/loadMenu', this.id).then(() => {
                this.targetSelected = this.menu.properties?.target;
            });
        },
        loadPages() {
            this.$store.dispatch('pageStore/list', {});
        },
        saveMenu() {
            this.menu.properties = { target: this.targetSelected };

            if (this.id > 0) {
                this.$store.dispatch('menuStore/updateMenu', this.menu).then(response => {
                    this.successSaveAction();
                });
            } else  {
                this.$store.dispatch('menuStore/saveMenu', this.menu).then(response => {
                    this.successSaveAction();
                });
            }
        },
        successSaveAction() {
            this.$emit('reload');
            this.close();
        },
        close() {
            this.targetSelected = null;
            this.cleanErrors();
            this.$emit('update:isActive', false);
        },
        selectTarget(item) {
            const selection = {};

            if (typeof item === 'string') {
                selection.id = 0;
                selection.type = 'link';
                selection.name = item;
            } else if (item) {
                selection.id = item.id;
                selection.type = 'page';
                selection.name = item.name;
            }

            this.targetSelected = selection;
        }
    }
}
</script>

<style scoped>

</style>
