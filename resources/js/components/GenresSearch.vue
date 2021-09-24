<template>
  <div class="py-5">
    <div class="container">
      <div class="d-flex flex-column align-items-center justify-content-center">
        <h2 class="numbers-title mb-5">Scegli un genere!</h2>
        <!-- <p class="platinum">Verrai portato alla pagina musicisti</p> -->
      </div>
      <div class="row">
        <div
          v-for="(genre, index) in genres"
          :key="index"
          class="col-xs-12 col-md-4 col-lg-2 mb-3"
          data-aos="zoom-in"
        >
          <label class="btn-grad w-100 text-center p-3" :for="genre.slug">{{
            genre.name
          }}</label>
          <input
            @change="searchMusicians(slug)"
            v-model="slug"
            type="radio"
            :value="genre.slug"
            :name="genre.name"
            :id="genre.slug"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "GenreSearch",

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
            this.searchedMusicians = el.musicians;
            this.$router.push({
              name: "musicians",
              params: { slug: this.slug },
            });
          });
          //   console.log(this.musicians);
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },

  data() {
      return {
          genres: [],
          searchedMusicians: [],
          slug: "",
      }
  },

  mounted() {
      this.getGenres();
  }
};
</script>

<style>
</style>