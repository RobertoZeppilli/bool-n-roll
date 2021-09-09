<template>
  <div>
    <div class="pattern"></div>
    <div class="container-xl main_page d-flex">
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

        <div>
          <h3>Recensioni su {{musician.stagename}}</h3>
          <div class="row">
            <div v-for="review in musician.reviews" :key="review.id" class="card w-100 my-2 card_review shadow p-3 mb-2 bg-body rounded">
              <div class="card-body">
                <h5 class="title-wine">{{review.name}}</h5>
                <div class="rating my-2">
                  <i class="fa-star"
                  v-for="index in 5"
                  :key="index"
                  :class="(index <= review.vote) ? 'fas' : 'far'"
                  ></i>
                </div>
                <p>{{review.review}}</p>
                <p class="text-right"><small>Inviato il {{dateFormat}}</small></p>
              </div>
            </div>
          </div>
        </div>

        <a class="btn btn-primary text-white my-2" @click="$router.go(-1)">
          Indietro
        </a>
      </div>
    </div>
  </div>
</template>

<script>
import MessageForm from "../components/MessageForm";
import ReviewForm from "../components/ReviewForm"; 
import dayjs from 'dayjs'; 

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

  computed: {
  dateFormat() {
    return dayjs(this.created_at).format('DD-MM-YYYY');
  }
}
};
</script>
