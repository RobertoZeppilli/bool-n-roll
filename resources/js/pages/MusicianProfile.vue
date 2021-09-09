<template>
  <div>
    <div class="pattern"></div>
    <div class="container myContainer">
      <div class="position d-flex align-items-center justify-content-center">
        <img class="profile-img" :src="'/storage/' + musician.cover" alt="" />
      </div>
      <div class="pt-300 text-center">
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
      <button class="btn btn-primary" @click="hide()">
        Manda un messaggio o scrivi una recensione
      </button>
      <!-- <button class="btn btn-primary" @click="hide()">
        Lascia una recensione
      </button> -->
      <div>
        <small class="text-danger" v-for="review in reviews" :key="review.id">
          {{ review.vote }}
        </small>
      </div>
      <div class="row">
        <div class="col-xs-12 col-md-6 col-lg-6">
          <MessageForm :musicianId="musician.id" v-if="show" />
        </div>
        <div class="col-xs-12 col-md-6 col-lg-6">
          <ReviewForm :musicianId="musician.id" v-if="review" />
        </div>
      </div>

      <a class="btn btn-primary text-white" @click="$router.go(-1)">
        Indietro
      </a>
    </div>
  </div>
</template>

<script>
import MessageForm from "../components/MessageForm";
import ReviewForm from "../components/ReviewForm";

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
      show: true,
      review: false,
      reviews: []
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

    hide() {
      if (!this.show && this.review) {
        this.show = true;
        this.review = false;
      } else {
        this.show = false;
        this.review = true;
      }
    },
  },

  created() {
    this.getMusician(this.$route.params.slug);
    this.$emit('prova', this.reviews);
  },
};
</script>
