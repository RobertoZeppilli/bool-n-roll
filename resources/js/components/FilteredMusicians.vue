<template>
  <div class="container">
    <div class="row py-4">
      <div
        v-for="musician in musicians"
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
                :class="index <= getAverageVotes(musician.reviews) ? 'fas' : 'far'"
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
      <router-link class="btn btn-orange text-white mb-3" :to="{ name: 'home' }"
        >Indietro</router-link
      >
    </div>
  </div>
</template>

<script>
export default {
  name: "FilteredMusicians",

  data() {
    return {
      musicians: [],
    };
  },

  methods: {
    getMusicians(slug) {
      axios
        .get(`http://127.0.0.1:8000/api/musicians/${slug}`)
        .then((res) => {
          res.data.forEach((el) => {
            this.musicians = el.musicians;
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
  },

  created() {
    this.getMusicians(this.$route.params.slug);
  },
};
</script>

<style>
</style>