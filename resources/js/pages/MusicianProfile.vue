<template>
  <div>
    <div class="pattern"></div>
    <div class="container-xl main_page d-flex">
      <div class="container myContainer">
        <div  class="position d-flex align-items-center justify-content-center">
          <img class="profile-img" :src="'/storage/' + musician.cover" alt="" />
          <!-- <img  class="profile-img" src="images/avatar.png" alt="" /> -->
        </div>
        <!-- <div  class="position d-flex align-items-center justify-content-center">
        </div> -->
        <div class="pt-100 text-center">
          <h1 class="my-5">{{ musician.stagename }}</h1>
          <span
            v-for="(genre, index) in musician.genres"
            :key="index"
            class="badge_profile badge badge-purple text-white mr-2"
            >{{ genre.name }}
          </span>
          <p class="my-5">{{ musician.bio }}</p>

          <h4 class="title-purple text-uppercase font-weight-bold">
            I nostri servizi
          </h4>
          <p>{{ musician.services }}</p>
        </div>

        <div class="row">
          <div class="col-xs-12 col-md-6 col-lg-6 text-center">
            <button
              class="btn btn-orange text-white my-5 p-3"
              @click="show = !show"
            >
              Manda un messaggio
            </button>
            <MessageForm :musicianId="musician.id" v-if="show" />
          </div>
          <div class="col-xs-12 col-md-6 col-lg-6 text-center">
            <button
              class="btn btn-orange text-white my-5 p-3"
              @click="review = !review"
            >
              Scrivi una recensione
            </button>
            <ReviewForm :musicianId="musician.id" v-if="review" />
          </div>
        </div>

        <div>
          <h3 class="my-3 mt-3">Recensioni su {{ musician.stagename }}</h3>
          <div v-if="musician.reviews">
            <div
              v-for="review in sortedReviews"
              :key="review.id"
              class="
                card
                w-100
                my-2
                card_review
                shadow
                p-3
                mb-2
                bg-body
                rounded
              "
              data-aos="fade-right"
            >
              <div class="card-body">
                <h5 class="title-wine">
                  {{ review.name }}
                  {{
                    review.surname ? getSurnameFirstLetter(review.surname) : ""
                  }}
                </h5>
                <div class="rating my-2">
                  <i
                    class="fa-star"
                    v-for="index in 5"
                    :key="index"
                    :class="index <= review.vote ? 'fas' : 'far'"
                  ></i>
                </div>
                <p class="font-italic">{{ review.review }}</p>
                <p class="text-right">
                  <small>Inviato il {{ getSendDate(review.created_at) }}</small>
                </p>
              </div>
            </div>
          </div>

          <!-- <div v-else>No recensioni</div> -->
        </div>

        <a class="btn btn-yellow text-white my-5" @click="$router.go(-1)">
          Indietro
        </a>
      </div>
    </div>
  </div>
</template>

<script>
import MessageForm from "../components/MessageForm";
import ReviewForm from "../components/ReviewForm";
import dayjs from "dayjs";

export default {
  name: "MusicianProfile",

  components: {
    MessageForm,
    ReviewForm,
  },

  data() {
    return {
      musician: {},
      genres: [],
      show: false,
      review: false,
      reviews: [],
    };
  },

  methods: {
    getMusician(slug) {
      axios
        .get(`http://127.0.0.1:8000/api/musician/${slug}`)
        .then((res) => {
          this.musician = res.data;

          this.genres = this.musician.genres;
          // this.reviews = this.musician.reviews;
          // console.log(this.genres, this.reviews);
        })
        .catch((err) => {
          console.log(err);
        });
    },

    getSendDate(date) {
      return dayjs(date).format("DD-MM-YYYY");
    },

    getSurnameFirstLetter(surname) {
      let firstLetter = surname[0] + ".";
      return firstLetter;
    },
  },

  computed: {
    sortedReviews() {
      
        return _.orderBy(this.musician.reviews, 'created_at', 'desc')
    
    }
  },

  created() {
    this.getMusician(this.$route.params.slug);
    // this.$emit('prova', this.reviews);
  },
};
</script>
