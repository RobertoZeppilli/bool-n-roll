<template>
  <div class="container">
    <!-- {{musicians}} -->
    <div v-for="(musician, index) in musicians" :key="index" class="card mb-2">
      <img class="img-fluid" :src="'/storage/' + musician.cover" />
      <div class="card-body">
        <h5 class="card-title">{{ musician.stagename }}</h5>
        <!-- <p class="card-text">
         {{musician.bio}}
        </p> -->
        <!-- <a href="#" class="btn btn-primary">Vedi profilo</a> -->
        <router-link :to="{ name: 'musician', params: { id: musician.id}}">Vedi profilo</router-link>
      </div>
    </div>

    <router-link :to="{ name: 'home' }">Indietro</router-link>
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
    getMusicians(id) {
      axios
        .get(`http://127.0.0.1:8000/api/filter/${id}`)
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
    this.getMusicians(this.$route.params.id);
  },
};
</script>

<style>
</style>