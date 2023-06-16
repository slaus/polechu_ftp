<template>
    <v-text-field
        class="mr-6"
        hide-details
        ref="search_projects"
        append-icon="fas fa-search"
        v-model="search"
        :placeholder="placeholder"
        @click:append="applySearch"
        @keyup="applySearch($event)"
        clearable
        @click:clear="clearSearch($event)"
    ></v-text-field>
</template>

<script>
export default {
    name: "SearchInput",
    props: {
        value: {
            type: String,
            default: null
        },
        label: {
            type: String,
            default: ''
        },
        placeholder: {
            type: String,
            default: ''
        }
    },
    data() {
        return {
            search: this.value
        }
    },
    methods: {
        applySearch(event) {
            if ((event.keyCode === 13 || event.type === 'click') && this.search !== '') {
                this.$emit('update:value', this.search);
            } else if (this.search === '') {
                this.$emit('update:value', this.search);
            }
        },
        clearSearch(event) {
            this.search = '';

            this.applySearch(event);
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
