<template>
  <div class="jumbotron bg-jumbotron">
    <div class="container">
      <div class="row">
        <div class="col-xs-6 col-md-6 col-lg-6">
          <h1 class="headline">Playing the mood</h1>

          <div class="form-group">
            <select
              @change="filter(genre_id)"
              v-model="genre_id"
              class="form-control mb-2"
              autocomplete="on"
            >
              <option :value="genre.id" v-for="genre in genres" :key="genre.id">
                {{ genre.name }}
              </option>
            </select>

            <!-- <router-link
              :to="{ name: 'musicians', params: { id: genre_id } }"
              class="btn btn-primary text-white"
              >Cerca</router-link
            > -->

            <!-- <router-link
              :to="{ name: 'tag', params: { slug: tag.slug } }"
              class="badge badge-warning mr-2"
              v-for="tag in post.tags"
              :key="`tag-${tag.id}`"
              >{{ tag.name }}</router-link
            > -->
          </div>
        </div>
        <!-- <div v-for="musician in musicians" :key="musician.id">
                        {{ musician.stagename }}
                    </div> -->
        <div class="col-xs-6 col-md-6 col-lg-6">
          <img class="img-fluid" src="images/jumboimg.png" alt="Jumbtron" />
        </div>

        <!-- <FilteredMusicians :musicians="musicians"/> -->
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
            this.$router.push({ name: 'musicians', params: { id: this.genre_id }})
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