<template>
  <div>
    <div class="pattern position-relative layover-pattern">
      <div class="container h-100">
        <div class="d-flex h-100 align-items-center justify-content-between">
          <div
            class="form-group form-group-resp z-index"
            data-aos="fade-right"
            data-aos-duration="1000"
          >
            <label for="voteAverage" class="text-white label-font"
              >Filtra per media voto</label
            >
            <select
              v-model="starVote"
              name="voteAverage"
              id="voteAverage"
              class="myForm form-control mySelect"
            >
              <option value="">Tutti</option>
              <option class="title-yellow" value="1">★</option>
              <option class="title-yellow" value="2">★★</option>
              <option class="title-yellow" value="3">★★★</option>
              <option class="title-yellow" value="4">★★★★</option>
              <option class="title-yellow" value="5">★★★★★</option>
            </select>
          </div>
          <div
            class="form-group form-group-resp z-index"
            data-aos="fade-left"
            data-aos-duration="1000"
          >
            <label for="reviewAmount" class="text-white label-font"
              >Filtra per numero di recensioni</label
            >
            <select
              v-model="reviewAmount"
              @change="sortedArray(reviewAmount)"
              name="reviewAmount"
              id="reviewAmount"
              class="mySelect form-control myForm"
            >
              <option value="" disabled>Nessun filtro selezionato</option>
              <option value="desc">Più recensioni</option>
              <option value="asc">Meno recensioni</option>
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="container py-5">
      
      <h2>
        Risultati per:
        <span class="badge_profile badge badge-purple text-white">{{
          this.$route.params.slug
        }}</span>
      </h2>
      <div v-if="loaded" class="row py-4">
        <div
          v-for="musician in filterMusicians"
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
      <Loader v-else />
      <div class="text-center">
        <router-link class="btn btn-yellow text-white" :to="{ name: 'home' }"
          >Indietro</router-link
        >
      </div>
    </div>
  </div>
</template>

<script>
import Loader from "./Loader";

export default {
  name: "FilteredMusicians",
  components: {
    Loader,
  },
  data() {
    return {
      musicians: [],
      starVote: "",
      reviewAmount: "",
      loaded: false,
      
    };
  },

  computed: {
    filterMusicians() {
      if (this.starVote == "") {
        return this.musicians;
      } else {
        const newArray = this.musicians.filter((el) => {
          return this.getAverageVotes(el.reviews) == this.starVote;
        });
        return newArray;
      }
    },
  },

  methods: {
    getMusicians(slug) {
      axios
        .get(`http://127.0.0.1:8000/api/musicians/${slug}`)
        .then((res) => {
          if (JSON.stringify(res.data) == "{}") {
            this.$router.push({ name: "not-found" });
          } else {
            res.data.forEach((el) => {
              this.musicians = el.musicians;
              // console.log(this.musicians);
            });
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },

    

    getAverageVotes(reviews) {
      const sum = reviews.reduce((acc, review) => (acc += review.vote), 0);
      return Math.ceil(sum / reviews.length);
    },

    sortedArray(amount) {
      if (amount == "") {
        return this.musicians;
      } else if (amount == "desc") {
        this.musicians.sort((a, b) => a.reviews.length < b.reviews.length);
        // console.log("desc");
      } else {
        // console.log("asc");
        this.musicians.sort((a, b) => a.reviews.length > b.reviews.length);
      }
    },
  },

  created() {
    this.getMusicians(this.$route.params.slug);
    
    $(document).ready(function () {
      $(this).scrollTop(0);
    });
  },
  mounted() {
    setTimeout(() => (this.loaded = true), 2000);
  },
};
</script>

<style lang="scss" scoped>
</style>