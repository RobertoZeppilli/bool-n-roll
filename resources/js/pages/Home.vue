<template>
  <Jumbotron />
</template>

<script>
import Jumbotron from '../components/Jumbotron';

export default {
  name: "Home",

  components: {
    Jumbotron
  },

  data() {
    return {
      genres: [],
      musicians: [],
      genre_id: "",
    };
  },

  methods: {
    getGenres() {
      axios
        .get("http://127.0.0.1:8000/api/genres")
        .then((res) => {
          this.genres = res.data;
          // console.log( this.genres )
        })
        .catch((err) => {
          console.log(err);
        });
    },

    filter(id) {
      axios
        .get(`http://127.0.0.1:8000/api/filter/${id}`)
        .then((res) => {
          res.data.forEach((el) => {
            this.musicians = el.musicians;
          });
          console.log(this.musicians);
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },

  created() {
    this.getGenres();
    // this.filter(this.$routes.params.id)
  },
};
</script>

<style>
</style>