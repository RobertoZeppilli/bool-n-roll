<template>
  <div>
    <div class="pattern position-relative layover-pattern">
      <div class="container h-100">
        <div class="d-flex h-100 align-items-center justify-content-between">
          <div class="form-group z-index">
            <label for="voteAverage" class="text-white label-font">Filtra per media voto</label>
            <select v-model="starVote" name="voteAverage" id="voteAverage">
              <option value="">Scegli un voto</option>
              <option value="1">★</option>
              <option value="2">★★</option>
              <option value="3">★★★</option>
              <option value="4">★★★★</option>
              <option value="5">★★★★★</option>
            </select>
          </div>
          <div class="form-group z-index">
            <label for="reviewAmount" class="text-white label-font">Filtra per numero di recensioni</label>
            <select
              v-model="reviewAmount"
              @change="sortedArray(reviewAmount)"
              name="reviewAmount"
              id="reviewAmount"
            >
              <option value="" disabled>Nessun filtro selezionato</option>
              <option value="desc">Più recensioni</option>
              <option value="asc">Meno recensioni</option>
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row py-4">
        <div
          v-for="musician in filterMusicians"
          :key="musician.id"
          class="col-xs-12 col-md-4 col-lg-4 my-4"
        >
          <div class="card">
            <div class="musician-img">
              <img
                :src="'/storage/' + musician.cover"
                :alt="musician.stagename"
              />
            </div>
            <div class="card-body text-center">
              <h5 class="card-title py-2">{{ musician.stagename }}</h5>
              <!-- reviews -->

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

              <!-- /reviews -->
              <router-link
                class="btn btn-orange text-white"
                :to="{ name: 'musician', params: { slug: musician.slug } }"
                >Vedi profilo</router-link
              >
            </div>
          </div>
        </div>
      </div>
      <div class="text-center">
        <router-link
          class="btn btn-orange text-white mb-3"
          :to="{ name: 'home' }"
          >Indietro</router-link
        >
      </div>
    </div>
  </div>
</template>

<script>
import vSelect from "vue-select";

export default {
  name: "FilteredMusicians",

  data() {
    return {
      musicians: [],
      starVote: "",
      reviewAmount: "",
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
          res.data.forEach((el) => {
            this.musicians = el.musicians;
            console.log(this.musicians);
          });
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
        console.log("desc");
      } else {
        console.log("asc");
        this.musicians.sort((a, b) => a.reviews.length > b.reviews.length);
      }
    },
  },

  created() {
    this.getMusicians(this.$route.params.slug);
  },
};
</script>

<style>
</style>