<template>
  <div class="jumbotron bg-jumbotron">
    <div class="container">
      <div class="row">
        <div class="col-xs-6 col-md-6 col-lg-6">
          <h1 class="headline">Playing the mood</h1>

          <div class="my-2">
            <p class="platinum">Cerca un musicista scegliendo il genere che preferisci!</p>
          </div>

          <div class="form-group">
            <select
              @change="searchMusicians(slug)"
              v-model="slug"
              class="form-control mb-2"
              autocomplete="on"
            >
              <option value="" selected="selected" disabled>Scegli un genere</option>
              <option :value="genre.slug" v-for="genre in genres" :key="genre.id">
                {{ genre.name }}
              </option>
            </select>

          </div>
        </div>
        
        <div class="col-xs-6 col-md-6 col-lg-6">
          <img class="img-fluid" src="images/jumboimg.png" alt="Jumbtron" />
        </div>

      </div>
    </div>
  </div>
</template>

<script>
// import FilteredMusicians from './FilteredMusicians';

export default {
  name: "Jumbotron",

  data() {
    return {
      genres: [],
      musicians: [],
      slug: "",
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

    searchMusicians(slug) {
      axios
        .get(`http://127.0.0.1:8000/api/musicians/${slug}`)
        .then((res) => {
          res.data.forEach((el) => {
            this.musicians = el.musicians;
            this.$router.push({ name: 'musicians', params: { slug: this.slug }})
          });
        //   console.log(this.musicians);
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