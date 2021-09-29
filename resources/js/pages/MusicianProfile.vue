<template>
  <div>
    <div v-if="loaded">
      <div class="pattern"></div>
      <div class="container-xl main_page d-flex">
        <div class="container myContainer">
          <div
            class="
              position
              d-flex
              align-items-center
              justify-content-center
              flex-column
            "
          >
            <img
              class="profile-img"
              :src="'/storage/' + musician.cover"
              alt=""
            />
            <h1>{{ musician.stagename }}</h1>
            <!-- <span
              v-for="(genre, index) in musician.genres"
              :key="index"
              class="badge_profile badge badge-purple text-white mr-2"
              >{{ genre.name }}
            </span> -->
            <!-- <img  class="profile-img" src="images/avatar.png" alt="" /> -->
          </div>
          <!-- <div  class="position d-flex align-items-center justify-content-center">
        </div> -->
          <div class="pt-100">
            <!-- <h1 class="my-5">{{ musician.stagename }}</h1>
            <span
              v-for="(genre, index) in musician.genres"
              :key="index"
              class="badge_profile badge badge-purple text-white mr-2"
              >{{ genre.name }}
            </span>
            <div class="my-5">
              <h4
                class="text-center title-petrol text-uppercase font-weight-bold"
              >
                Bio
              </h4>
              <p>{{ musician.bio }}</p>
            </div>
            <div class="my-5">
              <h4 class="title-wine text-uppercase font-weight-bold">
                I nostri servizi
              </h4>
              <p>{{ musician.services }}</p>
            </div>
            <div class="my-5">
              <h4 class="title-pink text-uppercase font-weight-bold">
                Tipologia
              </h4>
              <p>{{ musician.typology }}</p>
            </div> -->
            <!-- <div>
              <span class="prova2">Bio</span>
            </div> -->
            <div>
              <div class="prova text-center">
                <span class="window-badge" :class="{ active: bio }" @click="getPage('bio')">Bio</span>
                <span class="window-badge" :class="{ active: servizi }" @click="getPage('servizi')">
                  Servizi
                </span>
                <span
                class="window-badge"
                  :class="{ active: tipologia }"
                  @click="getPage('tipologia')"
                >
                  Tipologia
                </span>
                <span class="window-badge" :class="{ active: generi }" @click="getPage('generi')">
                  Generi
                </span>
              </div>
              <div :class="{ 'center' : generi || tipologia || servizi }" class="window">
                <div class="pt-3" v-show="bio">
                  <p>{{ musician.bio }}</p>
                </div>
                <div v-show="tipologia">
                  <p class="typology">{{ musician.typology }}</p>
                </div>
                <div v-show="servizi">
                  <p class="services">{{ musician.services }}</p>
                </div>
                <div v-show="generi">
                  <span
                    v-for="(genre, index) in musician.genres"
                    :key="index"
                    class="badge_profile badge badge-purple text-white mr-2"
                    >{{ genre.name }}
                  </span>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-xs-12 col-md-6 col-lg-6 text-center">
              <button
                class="btn btn-orange text-white my-5 p-3"
                @click="show = !show"
              >
                Manda un messaggio
              </button>
              <MessageForm :musicianId="musician.id" v-if="show" />
            </div>
            <div class="col-xs-12 col-md-6 col-lg-6 text-center">
              <button
                class="btn btn-orange text-white my-5 p-3"
                @click="review = !review"
              >
                Scrivi una recensione
              </button>
              <ReviewForm :musicianId="musician.id" v-if="review" />
            </div>
          </div>

          <div v-if="musician.reviews.length > 0" class="mt-5">
            <h3 data-aos="fade-right" class="pb-1">
              Recensioni {{ musician.typology == "Band" ? "sui " : "su " }}
              {{ musician.stagename }}
            </h3>
            <div
              v-for="review in sortedReviews"
              :key="review.id"
              class="card w-100 card_review shadow mb-3 bg-body rounded"
              data-aos="fade-right"
            >
              <div class="card-body">
                <h5 class="title-wine">
                  {{ review.name }}
                  {{
                    review.surname ? getSurnameFirstLetter(review.surname) : ""
                  }}
                </h5>
                <div class="rating my-2">
                  <i
                    class="fa-star"
                    v-for="index in 5"
                    :key="index"
                    :class="index <= review.vote ? 'fas' : 'far'"
                  ></i>
                </div>
                <p class="font-italic">{{ review.review }}</p>
                <p class="m-0 p-0 text-right">
                  <small
                    >Ricevuta il {{ getSendDate(review.created_at) }}</small
                  >
                </p>
              </div>
            </div>
          </div>

          <!-- <div v-else>No recensioni</div> -->

          <a class="btn btn-yellow text-white my-5" @click="$router.go(-1)">
            Indietro
          </a>
        </div>
      </div>
    </div>
    <Loader class="vh-100" v-else />
  </div>
</template>

<script>
import MessageForm from "../components/MessageForm";
import ReviewForm from "../components/ReviewForm";
import dayjs from "dayjs";

import Loader from "../components/Loader";

export default {
  name: "MusicianProfile",

  components: {
    MessageForm,
    ReviewForm,
    Loader,
  },

  data() {
    return {
      musician: {},
      genres: [],
      show: false,
      review: false,
      reviews: [],
      loaded: false,

      bio: true,
      servizi: false,
      tipologia: false,
      generi: false
    };
  },

  methods: {
    getMusician(slug) {
      axios
        .get(`http://127.0.0.1:8000/api/musician/${slug}`)
        .then((res) => {
          this.musician = res.data;

          this.genres = this.musician.genres;
          // this.reviews = this.musician.reviews;
          // console.log(this.genres, this.reviews);
        })
        .catch((err) => {
          console.log(err);
        });
    },

    getSendDate(date) {
      return dayjs(date).format("DD-MM-YYYY");
    },

    getSurnameFirstLetter(surname) {
      let firstLetter = surname[0] + ".";
      return firstLetter;
    },

    getPage(name) {
      if (name == "bio") {
        this.bio = true;
        this.servizi = false;
        this.tipologia = false;
        this.generi = false;
      } else if (name == "servizi") {
        this.servizi = true;
        this.bio = false;
        this.tipologia = false;
        this.generi = false;
      } else if (name == "tipologia") {
        this.tipologia = true;
        this.bio = false;
        this.servizi = false;
        this.generi = false;
      } else if (name == 'generi') {
        this.generi = true;
        this.tipologia = false;
        this.bio = false;
        this.servizi = false;
      }
    },
  },

  computed: {
    sortedReviews() {
      return _.orderBy(this.musician.reviews, "created_at", "desc");
    },
  },

  created() {
    this.getMusician(this.$route.params.slug);
    // this.$emit('prova', this.reviews);
    $(document).ready(function () {
      $(this).scrollTop(0);
    });
  },
  mounted() {
    setTimeout(() => (this.loaded = true), 2000);
  },
};
</script>


<style lang="scss" scoped>
// .prova {
//   margin-top: 100px;
//   width: max-content;
//   // background-color: rgba(0,0,0,0.5);
//   // color: #fff;
//   background-color: #fff;
//   border-radius: 10px 10px 0 0;
//   display: flex;
//   // justify-content: space-between;
//   align-items: center;

//   h5 {
//     padding: 10px;

//     cursor: pointer;
//     margin-bottom: 0;
//   }
// }

// .window {
//   padding: 10px;
//   min-height: 400px;
//   background-color: #fff;
//   border-radius: 0 20px 20px 20px;
//   box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.4);
// }
// .center {
//   height: 100%;
//   display: flex;
//   justify-content: center;
//   align-items: center;

//   .typology {
//     font-size: 3rem;
//   }
  
// }
// .active {
//   color: #ec5e25;
  
// }
</style>