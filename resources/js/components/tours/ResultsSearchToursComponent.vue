<template>
  <section class="section-tours">
    <div class="container slider-container">

      <div class="row card-list">
        <div v-for="tour in showedTours" class="col-md-4 col-sm-6 col-xs-12 card">
          <div class="wrap-news onStep animated fadeInLeft" data-animation="fadeInLeft" data-time="300">
            <img
              alt="LUXURY SINGLE ROOM"
              class="card__image"
              :src="tour.image ? tour.image : 'http://polechu.pandateam.net.ua/images/540/media/tours/img-news.jpg'"
            >
            <div class="title-h3 title-h">
              {{ tour.name }} {{ tour.star }}
              <!--<span class="glyphicon glyphicon-star" aria-hidden="true"></span>-->
            </div>
            <div class="title-h4 title-h">
              {{ tour.state }} {{ tour.town }}
              <!--<span class="glyphicon glyphicon-star" aria-hidden="true"></span>-->
            </div>

            <div class="card__options">
              <ul class="card__options-list">
                <li v-if="tour.town" class="card__option">
                  <span class="card__option-label">{{ $t('labels.region') }}:</span>
                  {{ tour.town }}
                </li>
                <li v-if="tour.checkin" class="card__option">
                  <span class="card__option-label">{{ $t('labels.checkin') }}:</span>
                  {{ tour.checkin }}
                </li>
                <li v-if="tour.nights" class="card__option">
                  <span class="card__option-label">{{ $t('labels.nights') }}:</span>
                  {{ tour.nights }}
                </li>
              </ul>
            </div>

            <div class="card__options">
              <ul class="card__options-list">
                <li v-if="tour.room" class="card__option">
                  <img class="card__option-img" src="/images/icons/key.svg" alt="Icon" />
                  {{ tour.room }}
                </li>
                <li v-if="tour.meal" class="card__option">
                  <img class="card__option-img" src="/images/icons/spoon_knife.svg" alt="Icon" />
                  {{ tour.meal }}
                </li>
                <li v-if="tour.ht_place" class="card__option">
                  <img class="card__option-img" src="/images/icons/board.svg" alt="Icon" />
                  {{ tour.ht_place }}
                </li>
              </ul>
            </div>

            <div class="card__options">
              <ul class="card__options-list">
                <li v-if="tour.freights" class="card__option card__option_normal">
                  <img class="card__option-img" src="/images/icons/ticket.svg" alt="Icon" />
                  <span class="option_icon __ticket"></span>
                  {{ $t('labels.freights') }}
                  <span class="inout">
                    <span v-if="tour.freights.in" class="inout_wrap"
                          :aria-label="freights(tour.freights.in, 'text') + ' →'"
                          :data-title="freights(tour.freights.in, 'text') + ' →'"
                    >
                       <img class="card__option-img-arrows" src="/images/icons/arrow-right-red.svg" alt="Icon" />
                    </span>

                    <span v-if="tour.freights.out" class="inout_wrap"
                          :aria-label="'←' + freights(tour.freights.out, 'text')"
                          :data-title="'←' + freights(tour.freights.out, 'text')"
                    >
                      <img class="card__option-img-arrows" src="/images/icons/arrow-left-blue.svg" alt="Icon" />
                    </span>
                  </span>
                </li>

                <li v-if="tour.tour" class="card__option card__option_normal">
                  <img class="card__option-img" src="/images/icons/route.svg" alt="Icon" />
                  {{ tour.tour }}
                </li>
              </ul>
            </div>

            <div class="card__tour">
              <div class="card__price">
                <span class="card__price-value">{{ tour.price }} </span>
                <span class="card__price-currency">{{ tour.currency }}</span>
                <div class="card__price-desc">
                  {{ $t('labels.' + ((+tour.moment_confirm === 1) ? 'guaranteedConfirmation' : 'priceEntireTour')) }}
                </div>
              </div>
              <div class="card__action">
                <button class="btn pull-right card__button" @click="makeOrder(tour)">
                  {{ $t('buttons.orderTour') }}
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- PAGINATION -->
      <div v-if="tours.length > itemsPerPage" id="pagination" class="pagination-wrapper">
        <span class="pagina-num">{{ $t('labels.pages', {val1: currentPage, val2: totalPages}) }}</span>
        <button
          v-for="page in pages"
          :key="page"
          :class="{ 'current': page === currentPage, 'inactive': page !== currentPage }"
          class="btn"
          @click="goToPage(page)"
        >
          {{ page }}
        </button>
        <span class="pull-right">
          <button class="btn" @click="goToPreviousPage" href="#">{{ $t('labels.prev') }}</button>
          <button class="btn" @click="goToNextPage" href="#">{{ $t('labels.next') }}</button>
        </span>
      </div>
    </div>

    <!-- MODAL -->
    <simple-modal v-if="showModal">
      <div slot="header" class="modal-order">
        <button class="button close-button" :disabled="isLoading" @click="closeModal">
          <img class="card__option-img" src="/images/icons/cross.svg" alt="Icon" />
        </button>

        <div class="title-h3">{{ order.tour.name }} {{ order.tour.star }}</div>
        <h4  class="title-h4">{{ order.tour.state }}, {{ order.tour.town }} *</h4>
        <p>
          <span class="">{{ $t('labels.checkin') }}</span>
          {{order.tour.checkin}}
        </p>

        <div class="card__price">
          <span class="card__price-value">{{ order.tour.price }} </span>
          <span class="card__price-currency">{{ order.tour.currency }}</span>
          <div class="card__price-desc">
            {{ order.tour.nights }} <span>{{ $t('labels.nights') }}</span>
          </div>
        </div>
        <!-- <ul>-->
          <!-- <li>{{ order.tour.tour_id }}</li>-->
          <!--<li>{{ order.tour.town_from }}</li>-->
        <!-- </ul>-->
        <p>{{ $t('alerts.priceNote') }}</p>
      </div>

      <div slot="body">
        <div class="form-fields-wrapper">
          <input v-model="order.client.name" :placeholder="$t('placeholders.name')" type="text">
          <span>{{ messageFieldError('client.name') }}</span>

          <input v-model="order.client.email" :placeholder="$t('placeholders.email')" type="text">
          <span>{{ messageFieldError('client.email') }}</span>

          <input v-model="order.client.phone" :placeholder="$t('placeholders.phone')" type="text">
          <span>{{ messageFieldError('client.phone') }}</span>

          <input v-model="order.client.time" :placeholder="$t('placeholders.time')" type="text">
          <span>{{ messageFieldError('client.time') }}</span>

          <textarea v-model="order.client.note" :placeholder="$t('placeholders.note')" rows="4"></textarea>

          <div v-if="successSendOrder" class="success show">{{ $t('alerts.successSendOrder') }}</div>
          <div v-if="failSendOrder" class="fail show">{{ $t('alerts.failSendOrder') }}</div>
        </div>
      </div>

      <div slot="footer">
        <button class="btn button" :disabled="isLoading" @click="sendOrder">
          {{ $t('buttons.orderTour') }}
        </button>
        <!--<button class="btn button" :disabled="isLoading" @click="closeModal">-->
        <!--  {{ $t('buttons.cancel') }}-->
        <!--</button>-->
      </div>
    </simple-modal>
  </section>
</template>

<script>
import {mapState} from "vuex";
import validation from "../../mixins/validation";

export default {
  name: "ResultsSearchToursComponent",
  mixins: [
    validation
  ],
  computed: {
    ...mapState({
      tours: state => state.tourStore.resultSearchTours
    }),

    showedTours() {
      if (this.tours.length <= this.itemsPerPage) return this.tours

      const startIndex = (this.currentPage - 1) * this.itemsPerPage;
      const endIndex = startIndex + this.itemsPerPage;
      return this.tours.slice(startIndex, endIndex);
    },
    totalPages() {
      return Math.ceil(this.tours.length / this.itemsPerPage);
    },
    pages() {
      return Array.from({ length: this.totalPages }, (_, index) => index + 1);
    },
  },
  data() {
    return {
      isLoading: false,
      showModal: false,
      successSendOrder: false,
      failSendOrder: false,
      order: {
        tour: {
          tour_id: 0,
          hotel_id: 0,
          name: '',
          state: '',
          town: '',
          price: '',
          currency: '',
          checkin: '',
          nights: 0,
          town_from: ''
        },
        client: {
          name: '',
          phone: '',
          email: '',
          time: '',
          note: ''
        }
      },
      currentPage: 1,
      itemsPerPage: 6,
    }
  },
  methods: {
    makeOrder(tour) {
      this.showModal = true;
      this.order.tour = {
        tour_id: tour.tour_id,
        hotel_id: tour.hotel_id,
        name: tour.name,
        state: tour.state,
        town: tour.town,
        price: tour.price,
        currency: tour.currency,
        checkin: tour.checkin,
        nights: tour.nights,
        town_from: tour.town_from
      }
    },
    sendOrder() {
      this.isLoading = true;
      this.$api.post('v1/tours/order', this.order).then(response => {
        if (response.data.status === 'success') {
          this.successSendOrder = true;

          setTimeout(() => {
            this.closeModal();
          }, 3000);
        }

        if (response.data.status === 'error') {
          this.failSendOrder = true;
        }
      }).finally(() => {
        this.isLoading = false;
      });
    },
    freights(code, key) {
      let output = {prefix: '', text: ''};

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
    },
    closeModal() {
      this.cleanErrors();
      this.successSendOrder = false;
      this.failSendOrder = false;
      this.showModal = false;
      this.order = {
        tour: {
          tour_id: 0,
          hotel_id: 0,
          name: '',
          state: '',
          town: '',
          price: '',
          currency: '',
          checkin: '',
          nights: 0,
          town_from: ''
        },
        client: {
          name: '',
          phone: '',
          email: '',
          time: '',
          note: ''
        }
      }
    },
    goToPage(page) {
      this.currentPage = page;
    },
    goToPreviousPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
      }
    },
    goToNextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
      }
    },
  },
}
</script>

<style scoped>
.modal-order {
  font-family: Montserrat, sans-serif;
  position: relative;
}

.close-button {
  width: 40px;
  height: 40px;
  display: flex;
  justify-content: center;
  align-items: center;
  position: absolute;
  top: -20px;
  right: -15px;
  padding: 0;
}

.close-button img {
  width: 20px;
  height: 20px;
  margin-right: 0;
}

.form-fields-wrapper {
  display: flex;
  flex-direction: column;
  gap: 4px;
  margin-bottom: 8px;
}
</style>

<style scoped>
.section-tours {
  padding: 0;
}

.tour-block {
  border: 1px solid grey;
  margin: 30px 0;
  padding: 15px;
}


/*card styles*/
.card-list {
  display: flex;
  flex-wrap: wrap;
}

.wrap-news {
  position: relative;
  padding: 20px 0 0 0;
  text-align: left;
  overflow: hidden;
  height: 100%;
  display: flex;
  flex-direction: column;
}

.title-h3 {
  display: block;
  font-size: 13pt;
  font-weight: 500;
  text-transform: uppercase;
  margin: 15px 0 10px 0;
}

.title-h4 {
  color: #337ab7;
  font-weight: bold;
  font-size: 16px;
}

p {
  font-size: 13px;
  margin: 0 0 10px;
}

.img-responsive {
  display: block;
  max-width: 100%;
  height: auto;
}

.card {
  margin: 10px 0 20px;
  padding: 0px 20px;
}

.card__options {

}

.card__image {
  width: 100%;
  min-height: 190px;
  background: lightgray;
  display: inline-block;
}

.card__options-list {
  margin: 12px 0;
  padding: 0;
}

.card__option {
  padding: 2px 0;
  font-weight: 600;
}

.card__option_normal {
  font-weight: 400;
}

.card__option-label {
  min-width: 80px;
  width: 25%;
  display: inline-block;
  font-weight: 400;
}

.card__option-img {
  width: 16px;
  height: 16px;
  margin-right: 10px;
}

.card__option-img-arrows {
  margin: 0 0 0 4px;
  width: 14px;
  height: 14px;
}

.card__tour {
  display: flex;
  justify-content: space-between;
  margin-top: auto;
}

.card__tour > div {
  width: 48%;
}

.card__price-value {
  color: #3bb0ff;
  font-size: 20px;
  font-weight: 600;
}

.card__price-currency {
  color: #3bb0ff;
  font-size: 16px;
  font-weight: 600;
}

.card__price-desc {
  font-size: 12px;
}

.card__button {
  padding: 0 14px;
  line-height: 40px;
  font-size: 16px;
  height: 40px;
  margin: 4px auto;
}

.inout_wrap {
  position: relative;
}

.inout_wrap:hover::after {
  content: attr(data-title);
  visibility: visible;
  background-color: #3bb0ff;
  white-space: nowrap;
  line-height: 1;
  color: #fff;
  text-align: center;
  padding: 5px 8px;
  border-radius: 6px;
  position: absolute;
  z-index: 1;
  bottom: 110%;
  left: 50%;
  transform: translateX(-50%);
}

.pagination-wrapper {
  text-align: start;
  margin: 30px 0 20px;
}

#pagination .pagina-num {
  font-size: 9pt;
  margin-right: 15px;
  margin-bottom: 60px;
}

#pagination .btn.current {
  background: #3ab0ff;
  color: #fff;
  font-weight: 500;
}

#pagination .btn {
  background: transparent;
  color: #2c3e50;
  font-size: 9pt;
  /*padding: 5px 10px;*/
}

#pagination .btn:hover {
  background: #ccc;
}

#pagination span {
  margin-top: 0px;
}

.pull-right {
  float: right!important;
}

.btn {
  display: inline-block;
  height: 35px;
  margin: 15px auto;
  padding: 6px 12px;
  line-height: 18px;

  background: #3bb0ff;
  border: 1px solid transparent;
  border-radius: 0px;
  cursor: pointer;
  font-size: 14px;
  font-weight: 400;
  color: #fff;
  outline: none;
  text-align: center;
  user-select: none;
  transition: all 0.3s ease;
  white-space: nowrap;

  padding: 0 14px;
  line-height: 40px;
  font-size: 16px;
  height: 40px;
  margin: 4px auto;
}

.btn:hover {
  background: #ccc;
}

.btn.active,
.btn:active {
  background-image: none;
  outline: 0;
  -webkit-box-shadow: inset 0 3px 5px rgba(0,0,0,.125);
  box-shadow: inset 0 3px 5px rgba(0,0,0,.125);
}
</style>
