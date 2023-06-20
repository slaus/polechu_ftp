<template>
    <section class="section-tours">
        <div class="container-fluid">
            <div class="row">
                <div v-for="tour in tours" class="tour-block">
                    <div class="outer">
                        <div class="inner">
                            <div class="data">
                                <div class="wrap">
                                    <div class="info">
                                        <div class="title">
                                            {{ tour.name }} {{ tour.star }}
                                        </div>
                                        <div class="location">
                                            {{ tour.state }} {{ tour.town }}
                                        </div>

                                        <div class="options">
                                            <ul class="list">
                                                <li v-if="tour.town" class="option">
                                                    <span class="option-label">
                                                        {{ $t('labels.region') }}
                                                    </span>
                                                    {{ tour.town }}
                                                </li>
                                                <li v-if="tour.checkin" class="option">
                                                    <span class="option-label">
                                                        {{ $t('labels.checkin') }}
                                                    </span>
                                                    {{ tour.checkin }}
                                                </li>
                                                <li v-if="tour.nights" class="option">
                                                    <span class="option-label">
                                                        {{ $t('labels.nights') }}
                                                    </span>
                                                    {{ tour.nights }}
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="meals">
                                            <ul class="list">
                                                <li v-if="tour.room" class="option">
                                                    <span class="option_icon __key"></span>
                                                    {{ tour.room }}
                                                </li>

                                                <li v-if="tour.meal" class="option">
                                                    <span class="option_icon __spoon"></span>
                                                    {{ tour.meal }}
                                                </li>

                                                <li v-if="tour.ht_place" class="bftr_option">
                                                    <span class="option_icon __board"></span>
                                                    {{ tour.ht_place }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="tour">
                                        <div class="price">
                                            {{ tour.price }} <span class="price_currency">{{ tour.currency }}</span>
                                            <div class="price_desc">
                                                {{ $t('labels.' + (+tour.moment_confirm === 1) ? 'guaranteedConfirmation' : 'priceEntireTour') }}
                                            </div>
                                        </div>
                                        <div class="bftr_action">
                                            <button class="button">
                                                {{ $t('buttons.orderTour') }}
                                            </button>
                                        </div>
                                    </div>

                                    <div class="fly">
                                        <ul class="list">
                                            <li v-if="tour.freights" class="option">
                                                <span class="option_icon __ticket"></span>
                                                {{ $t('labels.freights') }}
                                                <div class="inout">
                                                    <span v-if="tour.freights.in" class="inout_wrap" :aria-label="freights(tour.freights.in, 'text') + ' →'" :data-title="freights(tour.freights.in, 'text') + ' →'">
                                                        <svg class="inout_icon" :class="freights(tour.freights.in, 'prefix')" xmlns="http://www.w3.org/2000/svg" width="12" height="12">
                                                            <path d="m6.7 11.5 5-5.1c.2 0 .2-.2.3-.3v-.5l-.2-.3-5.1-5a.8.8 0 0 0-.5-.3c-.2 0-.4 0-.6.2l-.2.6c0 .2 0 .3.2.5l3.8 3.8H.8c-.2 0-.4 0-.6.2l-.2.5c0 .3 0 .4.2.6l.6.2h8.6l-3.8 3.8-.2.5c0 .3 0 .4.2.6l.5.2c.3 0 .4 0 .6-.2Z" />
                                                        </svg>
                                                    </span>

                                                    <span v-if="tour.freights.out" class="inout_wrap" :aria-label="'←' + freights(tour.freights.out, 'text')" :data-title="'←' + freights(tour.freights.out, 'text')">
                                                        <svg class="inout_icon" :class="freights(tour.freights.out, 'prefix')" xmlns="http://www.w3.org/2000/svg" width="12" height="12" aria-label="<?php esc_attr_e($freights_out['text']); ?>" title="<?php esc_attr_e($freights_out['text']); ?>">
                                                            <path d="m5.3 11.5-5-5.1C0 6.4 0 6.2 0 6v-.5l.2-.3 5.1-5c.1-.2.3-.3.5-.3s.4 0 .6.2l.2.6c0 .2 0 .3-.2.5L2.6 5.1h8.6c.2 0 .4 0 .6.2l.2.5c0 .3 0 .4-.2.6l-.6.2H2.6l3.8 3.8.2.5c0 .3 0 .4-.2.6l-.5.2c-.3 0-.4 0-.6-.2Z" />
                                                        </svg>
                                                    </span>
                                                </div>
                                            </li>

                                            <li v-if="tour.tour" class="option">
                                                <span class="option_icon __route"></span>
                                                {{ tour.tour }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
    methods: {
        freights(code, key) {
            let output = { prefix: '', text: '' };

            switch (code.toLowerCase()) {
                case 'y':
                    output = {
                        prefix: '__y',
                        text: this.$t('labels.areSeats')
                    }
                    break;
                case 'f':
                    output = {
                        prefix: '__f',
                        text: this.$t('labels.fewSeats')
                    }
                    break;
                case 'n':
                    output = {
                        prefix: '__n',
                        text: this.$t('labels.noSeats')
                    }
                    break;
                case 'r':
                    output = {
                        prefix: '__r',
                        text: this.$t('labels.uponRequest')
                    }
                    break;
            }

            return output[key] ?? '';
        }
    }
}
</script>

<style scoped>
.section-tours {
    padding: 0;
}
.tour-block {
    border: 1px solid grey;
    margin: 30px 0;
}
</style>
