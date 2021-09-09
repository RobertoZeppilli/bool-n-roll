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
            <div v-for="review in reviews" :key="review.id">
              <!-- <div v-if="musician.id == review.musician_id"> -->
              {{ review }}
              <!-- </div> -->
            </div>
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
            console.log( this.musicians )
            
          });

          this.filteredReviews = this.musicians.filter( data => data.reviews.length > 0)

          console.log( this.reviews )

          this.reviews.forEach( x => {
            this.reviews = x.reviews
          })

          
          
          // this.musicians = res.data.musicians
          // this.musicians.forEach( el => {
          //   // this.musicians = el;
          //   this.reviews = el.reviews

          // })
          // console.log(res.data.musicians)
        })
        .catch((err) => {
          console.log(err);
        });
    },

    // setVotes(prova) {
    //   console.log(prova)
    //   return this.reviews = prova
    // }

    // getVotes() {
    //   axios
    //     .get("http://127.0.0.1:8000/api/vote")
    //     .then((res) => {
    //       // console.log( res.data.reviews )
    //       console.log(res.data.musicians)
    //       res.data.musicians.forEach((el) => {
    //         this.newReviews = el.reviews;
    //       });
    //       console.log(this.newReviews);
    //       //this.reviews = res.data
    //     })
    //     .catch((err) => {
    //       console.log(err);
    //     });
    // },
  },

  created() {
    this.getMusicians(this.$route.params.slug);
    // this.getVotes();
  },
};
</script>

<style>
</style>