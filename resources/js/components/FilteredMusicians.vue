<template>
  <div class="container">
    <!-- {{musicians}} -->
    <!-- <div class="row  text-center">
      <div v-for="(musician, index) in musicians" :key="index" class="card mb-2 col-xs-12 col-md-4 col-lg-4">
        <img class="w-100" :src="'/storage/' + musician.cover" />
        <div class="card-body">
          <h5 class="card-title">{{ musician.stagename }}</h5>
          
          <router-link class="btn btn-orange text-white" :to="{ name: 'musician', params: { slug: musician.slug }}">Vedi profilo</router-link>
        </div>    
      </div>
    </div> -->
    <!-- <button @click="prova">
      prova
    </button> -->
    <!-- <div v-for="review in reviews" :key="review.id">
    {{ review }}
  </div> -->
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
            <div v-for="review in musician.reviews" :key="review.id">
              {{ review.vote }}
            </div>
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
      reviews: [],
      filteredReviews: []
      // newReviews: [],
    };
  },

  methods: {
    getMusicians(slug) {
      axios
        .get(`http://127.0.0.1:8000/api/musicians/${slug}`)
        .then((res) => {
          // console.log("data", res.data);
          res.data.forEach((el) => {
            // console.log(el)
            this.musicians = el.musicians;
            // console.log( this.musicians )
            
          });
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },

  created() {
    this.getMusicians(this.$route.params.slug);
  },

  
};
</script>

<style>
</style>