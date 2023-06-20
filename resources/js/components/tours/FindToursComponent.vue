<template>
<!--    <div id="reservation" class="imgbgres" style="background-image:url(/web/img/bg-res.jpg)">-->
    <div id="reservation" class="imgbgres">
        <div class="row">
            <div class="col-sm-6 form-group">
                <select v-model="payload.country" class="form-control">
                    <option value="0">{{ $t('labels.selectCountry') }}</option>
                    <option
                        v-for="country in countries"
                        :value="country.id"
                    >{{ country.name }}</option>
                </select>
            </div>

            <div class="col-sm-6 form-group">
                <select v-model="payload.town" class="form-control">
                    <option value="0">{{ $t('labels.selectTownFrom') }}</option>
                    <option
                        v-for="town in towns"
                        :value="town.id"
                    >{{ town.name }}</option>
                </select>
            </div>

            <div v-show="canShowOptions">
                <div class="col-md-3 form-group">
                    <label class="field-label">{{ $t('labels.checkinFrom') }}</label>
                    <div class="input-group">
                        <input type="text" v-model="filter.checkin_beg" ref="checkinBeg" id="checkinBeg" class="form-control">
                        <div class="input-group-btn">
                            <span class="icon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 form-group">
                    <label class="field-label">{{ $t('labels.checkinTo') }}</label>
                    <div class="input-group">
                        <input type="text" v-model="filter.checkin_end" ref="checkinEnd" id="checkinEnd" class="form-control">
                        <div class="input-group-btn">
                            <span class="icon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 form-group">
                    <label class="field-label">{{ $t('labels.nightsFrom') }}</label>
                    <select v-model="filter.nights_from" class="form-control">
                        <option
                            v-for="nights in options.nights"
                            :value="nights"
                            :key="nights"
                        >{{ nights }}</option>
                    </select>
                </div>
                <div class="col-md-3 form-group">
                    <label class="field-label">{{ $t('labels.nightsTill') }}</label>
                    <select v-model="filter.nights_till" class="form-control">
                        <option
                            v-for="nights in options.nights"
                            :value="nights"
                            :key="nights"
                        >{{ nights }}</option>
                    </select>
                </div>

                <div class="col-md-2 form-group">
                    <label class="field-label">{{ $t('labels.adult') }}</label>
                    <select v-model="filter.adult" class="form-control">
                        <option
                            v-for="item in adult"
                            :value="item"
                            :key="item"
                        >{{ item }}</option>
                    </select>
                </div>
                <div class="col-md-2 form-group">
                    <label class="field-label">{{ $t('labels.child') }}</label>
                    <select v-model="filter.child" class="form-control">
                        <option
                            v-for="item in children"
                            :value="item"
                            :key="item"
                        >{{ item }}</option>
                    </select>
                </div>

                <div class="col-md-2 form-group">
                    <label v-if="filter.child > 0" class="field-label">{{ $t('labels.' + (filter.child > 1 ? 'childrenAge' : 'childAge')) }}</label>
                    <div style="display: flex;">
                        <div v-for="i in filter.child" :style="i > 0 ? 'margin-left: 2px;' : ''" style="max-width: 50px;" class="input-group">
                            <input type="number" min="0" step="1" v-model="filter.child_ages[i]" class="form-control input-number">
                        </div>
                    </div>
                </div>

                <div class="col-md-2 form-group">
                    <label class="field-label">{{ $t('labels.currency') }}</label>
                    <select v-model="filter.currency_id" class="form-control">
                        <option
                            v-for="currency in options.currencies"
                            :value="currency.id"
                            :key="currency.id"
                        >{{ currency.alias }}</option>
                    </select>
                </div>
                <div class="col-md-2 form-group">
                    <label class="field-label">{{ $t('labels.costMin') }}</label>
                    <div class="input-group">
                        <input type="number" min="0" v-model="filter.cost_min" class="form-control input-number">
                    </div>
                </div>
                <div class="col-md-2 form-group">
                    <label class="field-label">{{ $t('labels.costMax') }}</label>
                    <div class="input-group">
                        <input type="number" min="0" v-model="filter.cost_max" class="form-control input-number">
                    </div>
                </div>

                <div class="col-md-3 form-group">
                    <label class="field-label">{{ $t('labels.city') }}</label>
                    <div class="box-container">
                        <label class="box-checkbox">
                            <input class="bft-checkbox_checkbox" type="checkbox" v-model="filter.towns" :value="0" @change="changeCity">
                            <span class="bft-checkbox_text any">{{ $t('labels.anyCity') }}</span>
                        </label>
                        <label v-for="town in options.towns" class="box-checkbox" :key="town.id">
                            <input class="bft-checkbox_checkbox" type="checkbox" v-model="filter.towns" :value="town.id" @change="changeCity">
                            <span class="bft-checkbox_text">{{ town.name }}</span>

                            <label v-if="town.child && town.showChildren" v-for="townChild in town.child" class="box-checkbox child" :key="townChild.id">
                                <input class="bft-checkbox_checkbox" type="checkbox" v-model="filter.towns" :value="townChild.id" @change="changeCity">
                                <span class="bft-checkbox_text">{{ townChild.name }}</span>
                            </label>
                        </label>
                    </div>
                </div>
                <div class="col-md-2 form-group">
                    <label class="field-label">&nbsp;</label>
                    <div class="box-container">
                        <label class="box-checkbox">
                            <input class="bft-checkbox_checkbox" type="checkbox" v-model="filter.stars" :value="0" @change="changeStar">
                            <span class="bft-checkbox_text any">{{ $t('labels.anyStar') }}</span>
                        </label>
                        <label v-for="star in options.stars" class="box-checkbox" :key="star.id">
                            <input class="bft-checkbox_checkbox" type="checkbox" v-model="filter.stars" :value="star.id" @change="changeStar">
                            <span class="bft-checkbox_text">{{ star.name }}</span>
                        </label>
                    </div>
                </div>
                <div class="col-md-4 form-group">
                    <div>
                        <input type="text" v-model="searchHotel" class="form-control input-search">
                    </div>
                    <div class="box-container">
                        <label class="box-checkbox">
                            <input class="bft-checkbox_checkbox" type="checkbox" v-model="filter.hotels" :value="0" @change="changeHotel">
                            <span class="bft-checkbox_text any">{{ $t('labels.anyHotel') }}</span>
                        </label>
                        <label v-for="hotel in hotels" class="box-checkbox" :key="hotel.id">
                            <input class="bft-checkbox_checkbox" type="checkbox" v-model="filter.hotels" :value="hotel.id" @change="changeHotel">
                            <span class="bft-checkbox_text">{{ hotel.name }} {{ hotel.star }}</span>
                        </label>
                    </div>
                </div>
                <div class="col-md-3 form-group">
                    <label class="field-label">&nbsp;</label>
                    <div class="box-container">
                        <label class="box-checkbox">
                            <input class="bft-checkbox_checkbox" type="checkbox" v-model="filter.meals" :value="0" @change="changeMeal">
                            <span class="bft-checkbox_text any">{{ $t('labels.anyMeal') }}</span>
                        </label>
                        <label v-for="meal in options.meals" class="box-checkbox" :key="meal.id">
                            <input class="bft-checkbox_checkbox" type="checkbox" v-model="filter.meals" :value="meal.id" @change="changeMeal">
                            <span class="bft-checkbox_text">{{ meal.name }}</span>
                        </label>
                    </div>
                </div>

                <div class="col-md-12 form-group checkboxes d-flex">
                    <label class="box-checkbox">
                        <input class="bft-checkbox_checkbox" type="checkbox" v-model="filter.child_in_bed" :value="true">
                        <span class="bft-checkbox_text any">{{ $t('labels.childInBed') }}</span>
                    </label>

                    <label class="box-checkbox">
                        <input class="bft-checkbox_checkbox" type="checkbox" v-model="filter.freight" :value="true">
                        <span class="bft-checkbox_text any">{{ $t('labels.freight') }}</span>
                    </label>

                    <label class="box-checkbox">
                        <input class="bft-checkbox_checkbox" type="checkbox" v-model="filter.filter" :value="true">
                        <span class="bft-checkbox_text any">{{ $t('labels.filter') }}</span>
                    </label>

                    <label class="box-checkbox">
                        <input class="bft-checkbox_checkbox" type="checkbox" v-model="filter.moment_confirm" :value="true">
                        <span class="bft-checkbox_text any">{{ $t('labels.momentConfirm') }}</span>
                    </label>
                </div>
            </div>

            <div class="col-sm-12 form-group">
                <button
                    class="btn-content"
                    :class="{ 'btn-disabled': !canMakeRequest }"
                    :disabled="!canMakeRequest"
                    @click="loadTours"
                >{{ $t('buttons.searchTour') }}</button>
            </div>
        </div>
    </div>
</template>

<script>
import localization from "../../mixins/localization";
import AirDatepicker from 'air-datepicker';
import uk from "air-datepicker/locale/uk";
import 'air-datepicker/air-datepicker.css';
import { stringToDate } from "../../helpers/functions";

document.addEventListener('filterMounted', (e) => {
    window.datePikerFrom = new AirDatepicker('#checkinBeg', {
        locale: uk,
        minView: "days"
    });

    window.datePikerEnd = new AirDatepicker('#checkinEnd', {
        locale: uk,
        minView: "days"
    });
});

window.dateEnabled = [];

export default {
    name: "FindToursComponent",
    mixins: [
        localization
    ],
    data() {
        return {
            isLoading: false,
            disabledSearchButton: false,
            searchHotel: '',
            countries: [],
            towns: [],
            hotels: [],
            options: {
                checkin: [],
                currencies: [],
                hotels: [],
                meals: [],
                nights: [],
                stars: [],
                towns: []
            },
            adult: [1, 2, 3, 4, 5, 6, 7, 8, 9],
            children: [0, 1, 2, 3],
            datePickerFrom: null,
            datePickerTo: null,
            payload: {
                country: 0,
                town: 0
            },
            filter: {
                country_id: 0,
                town_from_id: 0,
                adult: 2,
                child: 0,
                child_ages: [],
                checkin_beg: '',
                checkin_end: '',
                nights_from: 0,
                nights_till: 0,
                currency_id: 0,
                cost_min: null,
                cost_max: null,
                towns: [0],
                hotels: [0],
                stars: [0],
                meals: [0],
                child_in_bed: false,
                freight: false,
                filter: true,
                moment_confirm: false
            }
        }
    },
    computed: {
        canShowOptions() {
            return this.payload.town > 0;
        },
        canMakeRequest() {
            return !this.disabledSearchButton && !this.isLoading && this.payload.town > 0;
        }
    },
    watch: {
        'payload.country'(value) {
            this.towns = [];
            this.payload.town = 0;

            if (value > 0) {
                this.loadTowns();
            }
        },
        'payload.town'(value) {
            this.clearSearchResults();
            this.resetFilter();

            if (value > 0) {
                this.loadOptions();
            }
        },
        searchHotel() {
            this.refreshHotels();
        },
        filter: {
            handler() {
                this.disabledSearchButton = false;
            },
            deep: true
        }
    },
    mounted() {
        document.dispatchEvent(new Event('filterMounted'));

        this.loadCountries();

        // TEMP
        //this.loadOptions();
    },
    methods: {
        loadCountries() {
            this.isLoading = true;
            this.$api.get('v1/tours/countries').then(response => {
                if (response.data) {
                    this.countries = response.data;
                }
            }).finally(() => {
                this.isLoading = false;
            });
        },
        loadTowns() {
            this.isLoading = true;
            this.$api.get('v1/tours/towns', { params: { country_id: this.payload.country } }).then(response => {
                if (response.data) {
                    this.towns = response.data;
                }
            }).finally(() => {
                this.isLoading = false;
            });
        },
        loadOptions() {
            this.isLoading = true;
            this.$api.get('v1/tours/options', { params: this.payload }).then(response => {
                if (response.data) {
                    this.options = response.data;

                    this.options.towns = this.options.towns.filter(town => town.name === town.region).map(town => {
                        town.child = this.options.towns.filter(item => item.region === town.name);
                        town.showChildren = true;
                        return town;
                    });

                    this.hotels = this.options.hotels;
                }
            }).finally(() => {
                this.setDefaultFilterValues();
                this.isLoading = false;
            });
        },
        loadTours() {
            this.isLoading = true;
            this.clearSearchResults();
            this.filter.country_id = this.payload.country;
            this.filter.town_from_id = this.payload.town;
            this.$api.get('v1/tours/tours', { params: this.filter }).then(response => {
                if (response.data) {
                    this.$store.commit('tourStore/resultSearchTours', response.data);
                }
            }).finally(() => {
                this.isLoading = false;
                this.disabledSearchButton = true;
            });
        },
        changeCity(event) {
            const selectedValue = +event.target.value;
            this.filter.towns = selectedValue === 0 || this.filter.towns.length === 0
                ? [0]
                : this.filter.towns.filter(i => +i !== 0);
            this.refreshHotels();
        },
        changeHotel(event) {
            const selectedValue = +event.target.value;
            this.filter.hotels = selectedValue === 0 || this.filter.hotels.length === 0
                ? [0]
                : this.filter.hotels.filter(i => +i !== 0);
            this.refreshHotels();
        },
        changeStar(event) {
            const selectedValue = +event.target.value;
            this.filter.stars = selectedValue === 0 || this.filter.stars.length === 0
                ? [0]
                : this.filter.stars = this.filter.stars.filter(i => +i !== 0);
            this.refreshHotels();
        },
        changeMeal(event) {
            const selectedValue = +event.target.value;
            this.filter.meals = selectedValue === 0 || this.filter.meals.length === 0
                ? [0]
                : this.filter.meals.filter(i => +i !== 0);
        },
        refreshHotels() {
            this.hotels = this.options.hotels;
            if (this.filter.towns.length > 1 || (this.filter.towns.length === 1 && this.filter.towns[0] !== 0)) {
                this.hotels = this.options.hotels.filter(hotel => this.filter.towns.includes(+hotel.townKey));
            }
            if (this.filter.stars.length > 1 || (this.filter.stars.length === 1 && this.filter.stars[0] !== 0)) {
                this.hotels = this.hotels.filter(hotel => this.filter.stars.includes(+hotel.starGroupList));
            }
            this.hotels = this.hotels.filter(hotel => hotel.name.toLowerCase().match(this.searchHotel.toLowerCase()) || hotel.star.toLowerCase().match(this.searchHotel.toLowerCase()));
        },
        setDefaultFilterValues() {
            this.filter.nights_from = this.options.nights.length > 0 ? this.options.nights[0] : 0;
            this.filter.nights_till = this.options.nights.length > 0 ? this.options.nights[this.options.nights.length - 1] : 0;
            this.filter.currency_id = this.options.currencies.length > 0 ? this.options.currencies[0].id : 0;
            this.filter.checkin_beg = this.options.checkin.length > 0 ? this.options.checkin[0] : '';
            this.filter.checkin_end = this.options.checkin.length > 1 ? this.options.checkin[1] : '';

            window.dateEnabled = this.options.checkin.map((x) => {
                let date = stringToDate(x);
                if (date) {
                    return date.toString();
                }
            });

            window.datePikerFrom.update({
                startDate: stringToDate(this.filter.checkin_beg),
                selectedDates: [stringToDate(this.filter.checkin_beg)],
                onSelect({ date }) {
                    const checkinEnd = document.getElementById('checkinEnd') ? document.getElementById('checkinEnd').value : '';
                    if (stringToDate(checkinEnd) < date) {
                        window.datePikerEnd.selectDate(date);
                    }
                },
                onRenderCell({ date, cellType }) {
                    let status = !window.dateEnabled.includes(date.toString());
                    return {
                        disabled: status,
                        html: undefined,
                        classes: !status ? '-active-cell-' : undefined,
                        attrs: {
                            title: ''
                        }
                    };
                }
            });

            window.datePikerEnd.update({
                startDate: stringToDate(this.filter.checkin_end),
                selectedDates: [stringToDate(this.filter.checkin_end)],
                onSelect({ date }) {
                    const checkinBeg = document.getElementById('checkinBeg') ? document.getElementById('checkinBeg').value : '';
                    if (stringToDate(checkinBeg) > date) {
                        window.datePikerFrom.selectDate(date);
                    }
                },
                onRenderCell({ date, cellType }) {
                    let status = !window.dateEnabled.includes(date.toString());
                    return {
                        disabled: status,
                        html: undefined,
                        classes: !status ? '-active-cell-' : undefined,
                        attrs: {
                            title: ''
                        }
                    };
                }
            });
        },
        resetFilter() {
            this.filter = {
                country_id: 0,
                town_from_id: 0,
                adult: 2,
                child: 0,
                child_ages: [],
                checkin_beg: '',
                checkin_end: '',
                nights_from: 0,
                nights_till: 0,
                currency_id: 0,
                cost_min: null,
                cost_max: null,
                towns: [0],
                hotels: [0],
                stars: [0],
                meals: [0],
                child_in_bed: false,
                freight: false,
                filter: false,
                moment_confirm: false
            }
        },
        clearSearchResults() {
            this.$store.commit('tourStore/resultSearchTours', []);
        }
    }
}
</script>

<style scoped>
.field-label {
    text-align: initial !important;
    font-weight: 900;
    display: block;
    height: 34px;
}
.input-number {
    border: 0 solid rgba(0,0,0,.1);
    height: 40px;
    background: #fbfbfb;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0) inset, 0 0 8px rgba(126, 239, 104, 0);
    outline: 0 none;
    text-align: left;
    width: 100%;
    font-size: 9pt;
    font-weight: 400;
    letter-spacing: 0;
    color: #555;
    padding: 8px;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px!important;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    -moz-transition: none;
    -webkit-transition: none;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.2s ease;
}
.box-container {
    background: #ffffff;
    max-height: 200px;
    min-height: 200px;
    height: 100%;
    overflow-y: auto;
    padding: 5px 15px;
    border-radius: 4px;
}
.box-container label {
    text-align: initial;
    display: block;
}
.box-container label .any {
    font-weight: bold;
}
.box-container label.child {
    padding-left: 10px;
}
#reservation {
    width: 100%;
    height: auto;
    background: rgba(255,255,255,1);
    box-shadow: 5px 5px 2px rgba(23, 36, 52, .1);
    padding: 45px 35px 45px 35px;
}
.checkboxes {
    text-align: initial;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin: 30px 0;
}
.checkboxes label {
    display: block;
}
.input-search {
    border: 0 solid rgba(0,0,0,.1);
    padding: 2px;
    margin-bottom: 4px;
    height: 30px!important;
    background: #fbfbfb;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0) inset, 0 0 8px rgba(126, 239, 104, 0);
    outline: 0 none;
    text-align: left;
    width: 100%;
    font-size: 9pt;
    font-weight: 400;
    letter-spacing: 0;
    color: #555;
    border-radius: 4px;
}
.btn-disabled {
    background: gray;
}
</style>
