<template>
    <div id="reservation" class="imgbgres" style="background-image:url(/web/img/bg-res.jpg)">
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

<!--            <div class="col-md-3 form-group">-->
<!--                <div class="input-group">-->
<!--                    <input type="text" name="date1" id="date1" class="form-control fox1" placeholder="CHECK IN DATE">-->
<!--                    <div class="input-group-btn">-->
<!--                        <span class="icon"><i class="fa fa-calendar"></i></span>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->

<!--            <div class="col-md-3 form-group">-->
<!--                <div class="input-group">-->
<!--                    <input type="text" name="date2" id="date2" class="form-control fox2" placeholder="CHECK OUT DATE">-->
<!--                    <div class="input-group-btn">-->
<!--                        <span class="icon"><i class="fa fa-calendar"></i></span>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->

<!--            <div class="col-sm-2 form-group">-->
<!--                <input id="personbook" name="personbook" placeholder="PERSON" type="text">-->
<!--            </div>-->

<!--            <div class="col-sm-4 form-group">-->
<!--                <input id="namebook" name="namebook" placeholder="NAME" type="text">-->
<!--            </div>-->

<!--            <div class="col-sm-3 form-group">-->
<!--                <input id="emailbook" name="emailbook" placeholder="EMAIL" type="text">-->
<!--            </div>-->

<!--            <div class="col-sm-3 form-group">-->
<!--                <input id="phonebook" name="phonebook" placeholder="PHONE" type="text">-->
<!--            </div>-->

<!--            <div class="col-sm-12 form-group">-->
<!--                <textarea cols="50" id="messagebook" name="message" placeholder="YOUR MESSAGE" rows="2"></textarea>-->
<!--            </div>-->

            <div class="col-sm-12 form-group">
                <button class="btn-content" :disabled="isLoading">{{ $t('buttons.searchTour') }}</button>
            </div>

<!--            <div class="success-white" id="mail_success">Thank you. Your reservation has been sent.</div>-->
<!--            <div class="error-white" id="mail_failed">Error, email not sent</div>-->
        </div>
    </div>
</template>

<script>
import localization from "../../mixins/localization";

export default {
    name: "FindToursComponent",
    mixins: [
        localization
    ],
    data() {
        return {
            isLoading: false,
            countries: [],
            towns: [],
            payload: {
                country: 0,
                town: 0
            }
        }
    },
    watch: {
        'payload.country'(value) {
            if (value > 0) {
                this.loadTowns();
            } else {
                this.towns = [];
            }
        }
    },
    mounted() {
        this.loadCountries();
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
        }
    }
}
</script>

<style scoped>

</style>
