<template>
  <div class="container">
    <!-- {{musicians}} -->
    <div class="row my-5 text-center">
      <div v-for="(musician, index) in musicians" :key="index" class="card mb-2 col-xs-12 col-md-4 col-lg-4">
        <img class="w-100" :src="'/storage/' + musician.cover" />
        <div class="card-body">
          <h5 class="card-title">{{ musician.stagename }}</h5>
          
          <router-link class="btn btn-orange text-white" :to="{ name: 'musician', params: { slug: musician.slug }}">Vedi profilo</router-link>
        </div>    
      </div>
    </div>

    <router-link class="btn btn-orange text-white" :to="{ name: 'home' }">Indietro</router-link>
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
  },

  created() {
    this.getMusicians(this.$route.params.slug);
  },
};
</script>

<style>
</style>