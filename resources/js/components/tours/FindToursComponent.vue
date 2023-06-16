<template>
    <div id="reservation" class="imgbgres" style="background-image:url(/web/img/bg-res.jpg)">
        <div class="row">
            <div class="col-sm-6 form-group">
                <select class="form-control" id="selectroom">
                    <optgroup label="SELECT ROOM">
                        <option value="LUXURY SINGLE">LUXURY SINGLE ROOM</option>
                        <option value="LUXURY DOUBLE">LUXURY DOUBLE ROOM</option>
                        <option value="PREMIUM LUXURY">PREMIUM LUXURY ROOM</option>
                        <option value="PREMIUM SUITE">PREMIUM SUITE ROOM</option>
                    </optgroup>
                </select>
            </div>

            <div class="col-md-3 form-group">
                <div class="input-group">
                    <input type="text" name="date1" id="date1" class="form-control fox1" placeholder="CHECK IN DATE">
                    <div class="input-group-btn">
                        <span class="icon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 form-group">
                <div class="input-group">
                    <input type="text" name="date2" id="date2" class="form-control fox2" placeholder="CHECK OUT DATE">
                    <div class="input-group-btn">
                        <span class="icon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
            </div>

            <div class="col-sm-2 form-group">
                <input id="personbook" name="personbook" placeholder="PERSON" type="text">
            </div>

            <div class="col-sm-4 form-group">
                <input id="namebook" name="namebook" placeholder="NAME" type="text">
            </div>

            <div class="col-sm-3 form-group">
                <input id="emailbook" name="emailbook" placeholder="EMAIL" type="text">
            </div>

            <div class="col-sm-3 form-group">
                <input id="phonebook" name="phonebook" placeholder="PHONE" type="text">
            </div>

            <div class="col-sm-12 form-group">
                <textarea cols="50" id="messagebook" name="message" placeholder="YOUR MESSAGE" rows="2"></textarea>
            </div>

            <div class="success-white" id="mail_success">Thank you. Your reservation has been sent.</div>
            <div class="error-white" id="mail_failed">Error, email not sent</div>
            <button class="btn-content">{{ $t('buttons.searchTour') }}</button>
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

        }
    },
    methods: {

    }
}
</script>

<style scoped>

</style>
