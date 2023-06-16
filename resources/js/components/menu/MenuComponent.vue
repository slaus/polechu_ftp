<template>
    <v-card flat outlined>
        <v-card-title flat class="rounded-t-lg">
            <v-btn
                depressed
                color="primary"
                @click="editMenu(0)"
            >
                <v-icon small left>fa-solid fa-plus</v-icon>
                <span class="no-upper">{{ $t('buttons.add') }}</span>
            </v-btn>
        </v-card-title>

        <v-card-text class="text-h5 font-weight-bold">
            <div v-for="group in menus" :key="group.layout" class="mt-6">
                <v-system-bar dark color="primary" height="35" class="px-4 mb-3">
                    <v-icon
                        small
                        class="mr-2"
                        color="white"
                    >
                        fa-solid fa-bars
                    </v-icon>
                    <span>{{ layoutName(group.layout) }}</span>
                </v-system-bar>

                <vue-nestable v-model="group.items" @change="rebuild">
                    <vue-nestable-handle
                        slot-scope="{ item }"
                        :item="item"
                    >
                        <div class="d-flex justify-space-between item-container px-4">
                            <div>{{ translation(item.name) }}</div>

                            <div class="control-block d-flex">
                                <div class="visibility-block">
                                    <v-icon
                                        v-if="item.visibility"
                                        small
                                        class="mr-2"
                                        color="black"
                                    >
                                        fa-solid fa-eye
                                    </v-icon>

                                    <v-icon
                                        v-if="!item.visibility"
                                        small
                                        class="mr-2"
                                        color="grey"
                                    >
                                        fa-solid fa-eye-slash
                                    </v-icon>
                                </div>
                                <div class="action-block">
                                    <v-btn icon @click="editMenu(item.id)" color="green">
                                        <v-icon small>far fa-edit</v-icon>
                                    </v-btn>
                                </div>
                                <div class="action-block">
                                    <v-btn icon @click="confirmDeleteMenu(item.id)" color="error">
                                        <v-icon small>fa-solid fa-trash-can</v-icon>
                                    </v-btn>
                                </div>
                            </div>
                        </div>
                    </vue-nestable-handle>
                </vue-nestable>
            </div>
        </v-card-text>

        <EditMenuComponent v-bind.sync="menuEdit" v-on:reload="loadMenu" />
    </v-card>
</template>

<script>
import { VueNestable, VueNestableHandle } from 'vue-nestable';
import { mapState } from "vuex";
import confirm from "../../mixins/confirm";
import localization from "../../mixins/localization";
import EditMenuComponent from "./EditMenuComponent.vue";
import EditPostComponent from "../posts/EditPostComponent.vue";

export default {
    name: "PagesTableComponent",
    mixins: [
        confirm,
        localization
    ],
    components: {
        EditPostComponent,
        VueNestable,
        VueNestableHandle,
        EditMenuComponent
    },
    computed: {
        ...mapState({
            isLoading: state => state.menuStore.isLoading,
            menus: state => state.menuStore.treeList
        })
    },
    data() {
        return {
            menuLayouts: [
                { id: 1, name: 'mainMenu', icon: '' },
                { id: 2, name: 'footerMenu', icon: '' },
            ],
            menuEdit: {
                isActive: false,
                id: 0
            }
        }
    },
    watch: {
        '$store.state.confirmStore.isConfirmed': function (value) {
            if (value && this.confirmPayload.action && this.confirmPayload.action === 'deleteMenu') {
                this.deleteMenu();
            }
        }
    },
    mounted() {
        this.loadMenu();
    },
    methods: {
        loadMenu() {
            this.$store.dispatch('menuStore/treeList', {});
        },
        layoutName(id) {
            const layout = this.menuLayouts.find(layout => layout.id === id);
            return layout ? this.$t('titles.' + layout.name) : '';
        },
        rebuild(value, options) {
            this.$store.dispatch('menuStore/rebuildMenu', options);
        },
        editMenu(id) {
            this.menuEdit.id = id;
            this.menuEdit.isActive = true;
        },
        confirmDeleteMenu(id) {
            this.setConfirm({
                title: 'confirm.deleteTitle',
                message: 'confirm.deleteMessage',
                payload: { action: 'deleteMenu', id: id }
            });
        },
        deleteMenu() {
            this.$store.dispatch('menuStore/deleteMenu', this.confirmPayload?.id ?? 0).finally(() => {
                this.loadMenu();
                this.clearConfirm();
            });
        },
    }
}
</script>

<style>
.item-container {
    border: 1px solid #c9c9c9;
}
.public-block, .visibility-block {
    width: fit-content;
    text-align: center;
    margin: 0 5px;
}
.action-block {
    width: fit-content;
    text-align: center;
    margin: 0 5px;
}
.nestable {
    position: relative;
}
.nestable-rtl {
    direction: rtl;
}
.nestable .nestable-list {
    margin: 0;
    padding: 0 0 0 40px;
    list-style-type: none;
}
.nestable-rtl .nestable-list {
    padding: 0 40px 0 0;
}
.nestable > .nestable-list {
    padding: 0;
}
.nestable-item,
.nestable-item-copy {
    margin: 4px 0 0;
    font-size: 1rem;
}
.nestable-item:first-child,
.nestable-item-copy:first-child {
    margin-top: 0;
}
.nestable-item .nestable-list,
.nestable-item-copy .nestable-list {
    margin-top: 4px;
}
.nestable-item {
    position: relative;
}
.nestable-item.is-dragging .nestable-list {
    pointer-events: none;
}
.nestable-item.is-dragging * {
    opacity: 0;
    filter: alpha(opacity=0);
}
.nestable-item.is-dragging:before {
    content: ' ';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(106, 127, 233, 0.274);
    border: 1px dashed rgb(73, 100, 241);
    -webkit-border-radius: 5px;
    border-radius: 5px;
}
.nestable-drag-layer {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 100;
    pointer-events: none;
}
.nestable-rtl .nestable-drag-layer {
    left: auto;
    right: 0;
}
.nestable-drag-layer > .nestable-list {
    position: absolute;
    top: 0;
    left: 0;
    padding: 0;
    background-color: rgba(106, 127, 233, 0.274);
}
.nestable-rtl .nestable-drag-layer > .nestable-list {
    padding: 0;
}
.nestable [draggable="true"] {
    cursor: move;
}
.nestable-handle {
    display: inline;
}
</style>
