<template>
    <v-card flat>
        <v-card-title>
            {{ $t('titles.posts') }}
        </v-card-title>
        <v-card-text>
            <PostsTableComponent />
        </v-card-text>
    </v-card>
</template>

<script>
import PostsTableComponent from "../../components/posts/PostsTableComponent";

export default {
    name: "PostsPage",
    components: {
        PostsTableComponent
    },
    data() {
        return {

        }
    }
}
</script>

<style scoped>

</style>
