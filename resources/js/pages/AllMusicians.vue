<template>
  <div class="container">
    <h2 class="text-center numbers-title py-5">Tutti i musicisti iscritti!</h2>
    <div v-if="loaded" class="row">
      <div
        v-for="musician in musicians"
        :key="musician.id"
        class="d-flex justify-content-between width flex-wrap"
      >
        <div class="flip-card" data-aos="zoom-in">
          <div class="flip-card-inner">
            <div class="flip-card-front">
              <img
                :src="'/storage/' + musician.cover"
                :alt="musician.stagename"
                class="profile-pic"
              />
            </div>
            <div class="flip-card-back">
              <div>
                <small class="text-white p-2">{{
                  musician.reviews.length == 1
                    ? musician.reviews.length + " recensione"
                    : musician.reviews.length + " recensioni"
                }}</small>
              </div>
              <router-link
                class="btn btn-orange text-white"
                :to="{ name: 'musician', params: { slug: musician.slug } }"
                >Vai al profilo</router-link
              >
              <span class="d-block py-2">
                <i
                  class="fa-star"
                  v-for="index in 5"
                  :key="index"
                  :class="
                    index <= getAverageVotes(musician.reviews) ? 'fas' : 'far'
                  "
                ></i>
              </span>
            </div>
          </div>
        </div>
        <div class="text-center w-100 py-2">
          <h4>{{ musician.stagename }}</h4>
        </div>
      </div>
    </div>
    <Loader class="vh-100" v-else />
    <div class="text-center mb-5">
      <router-link class="btn btn-yellow text-white" :to="{ name: 'home' }"
        >Indietro</router-link
      >
    </div>
  </div>
</template>

<script>
import Loader from "../components/Loader";

export default {
  name: "AllMusicians",

  data() {
    return {
      musicians: [],
      loaded: false,
    };
  },

  methods: {
    allMusicians() {
      axios
        .get("http://127.0.0.1:8000/api/musicians")
        .then((res) => {
          this.musicians = res.data;
          this.loaded = true;
        })
        .catch((err) => {
          console.log(err);
        });
    },

    getAverageVotes(reviews) {
      const sum = reviews.reduce((acc, review) => (acc += review.vote), 0);
      return Math.ceil(sum / reviews.length);
    },
  },

  components: {
    Loader,
  },

  created() {
    //   setTimeout(() => (this.loaded = true), 1000);
    this.allMusicians();

    $(document).ready(function(){
            $(this).scrollTop(0);
    });
  },
  mounted() {
    $(document).ready(function(){
            $(this).scrollTop(0);
    });

  }
};
</script>

<style>
</style>