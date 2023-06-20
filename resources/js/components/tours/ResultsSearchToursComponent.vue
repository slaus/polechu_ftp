<template>
    <section>
        <div class="container-fluid">
            <div class="row">
                {{ tours }}
            </div>
        </div>
    </section>
</template>

<script>
import { mapState } from "vuex";

export default {
    name: "ResultsSearchToursComponent",
    computed: {
        ...mapState({
            tours: state => state.tourStore.resultSearchTours
        })
    },
}
</script>

<style scoped>

</style>
