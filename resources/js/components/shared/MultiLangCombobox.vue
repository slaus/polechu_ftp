<template>
    <div class="d-flex multi-lang">
        <div class="input-field">
            <v-combobox
                v-model="content[selectedLocale]"
                :filter="filter"
                :hide-no-data="!itemSearch"
                :items="elements"
                :search-input.sync="itemSearch"
                hide-selected
                :label="label"
                multiple
                small-chips
                dense
                outlined
                @change="input"
            >
                <template v-slot:no-data>
                    <v-list-item>
                        <span class="subheading mr-2">Create</span>
                        <v-chip
                            label
                            small
                        >
                            {{ itemSearch }}
                        </v-chip>
                    </v-list-item>
                </template>

                <template v-slot:selection="{ attrs, item, parent, selected }">
                    <v-chip
                        v-if="item === Object(item)"
                        v-bind="attrs"
                        :input-value="selected"
                        label
                        small
                    >
                        <span class="pr-2">
                            {{ item.text }}
                        </span>
                        <v-icon
                            small
                            @click="parent.selectItem(item)"
                        >
                            $delete
                        </v-icon>
                    </v-chip>
                </template>

                <template v-slot:item="{ index, item }">
                    <v-text-field
                        v-if="itemEditing === item"
                        v-model="itemEditing.text"
                        autofocus
                        flat
                        background-color="transparent"
                        hide-details
                        solo
                        @keyup.enter="editItem(index, item)"
                    ></v-text-field>
                    <v-chip
                        v-else
                        dark
                        label
                        small
                    >
                        {{ item.text }}
                    </v-chip>
                    <v-spacer></v-spacer>
                    <v-list-item-action @click.stop>
                        <v-btn
                            icon
                            @click.stop.prevent="editItem(index, item)"
                        >
                            <v-icon>{{ itemEditing !== item ? 'fa-solid fa-pencil' : 'fa-solid fa-check' }}</v-icon>
                        </v-btn>
                    </v-list-item-action>
                </template>
            </v-combobox>
        </div>
        <div class="select-locale">
            <v-select
                :items="localizations"
                item-value="code"
                item-text="name"
                dense
                outlined
                menu-props="offsetY"
                hide-details="auto"
                v-model="selectedLocale"
            ></v-select>
        </div>
    </div>
</template>

<script>
import { mapState } from "vuex";

export default {
    name: "MultiLangCombobox",
    props: {
        value: {
            type: Array,
            default: []
        },
        label: {
            type: String,
            default: ''
        },
        errorMessages: {
            type: String,
            default: ''
        },
        readonly: {
            type: Boolean,
            default: false
        },
        disabled: {
            type: Boolean,
            default: false
        },
        items: {
            type: Array,
            default: []
        }
    },
    data() {
        return {
            selectedLocale: '',
            elements: [],
            itemEditing: null,
            itemEditingIndex: -1,
            nonce: 1,
            itemSearch: null
        }
    },
    computed: {
        ...mapState({
            locale: state => state.localizationStore.locale,
            localizations: state => state.localizationStore.localizations,
        }),
        content() {
            const content = {};

            for (const key in this.localizations) {
                const locale = this.localizations[key].code;
                content[locale] = [];

                for (const index in this.value) {
                    if (this.value[index][locale]) {
                        content[locale].push({ text: this.value[index][locale] });
                    }
                }
            }

            return content;
        }
    },
    watch: {
        'content': function (value, prev) {
            if (value[this.selectedLocale].length === prev[this.selectedLocale].length) {
                return;
            }

            this.elements = prev[this.selectedLocale].map(v => {
                if (typeof v === 'string') {
                    const origin = v;
                    v = {};
                    v[this.selectedLocale] = origin;

                    this.value.push(v)

                    this.nonce++
                }

                return v;
            })
        },
        'items': function () {
            this.actualizationElements();
        },
        'selectedLocale': function () {
            this.actualizationElements();
        }
    },
    mounted() {
        this.selectedLocale = this.locale;
    },
    methods: {
        input() {
            const items = [];

            for (const locale in this.content) {
                for (const index in this.content[locale]) {
                    const item = {};
                    if (this.content[locale][index].text) {
                        item[locale] = this.content[locale][index].text;
                        items.push(item);
                    }
                }
            }

            this.$emit('update:value', items);
        },
        actualizationElements() {
            this.elements = this.items.filter(item => item[this.selectedLocale]).map(item => {
                return { text: item[this.selectedLocale] };
            });
        },
        editItem(index, item) {
            if (!this.itemEditing) {
                this.itemEditing = item
                this.itemEditingIndex = index
            } else {
                this.itemEditing = null
                this.itemEditingIndex = -1
            }
        },
        filter(item, queryText, itemText) {
            if (item.header) {
                return false;
            }

            const hasValue = val => val != null ? val : '';

            const text = hasValue(itemText);
            const query = hasValue(queryText);

            return text.toString()
                .toLowerCase()
                .indexOf(query.toString().toLowerCase()) > -1;
        }
    }
}
</script>

<style scoped lang="scss">
.input-field {
    width: 100%;
}
.select-locale {
    width: 80px;
}
</style>
